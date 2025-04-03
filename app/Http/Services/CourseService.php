<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Major;
use App\Models\CourseMajor;
use App\Models\Prerequisite;

class CourseService
{
    /**
     * Lấy danh sách môn học kèm lọc theo chuyên ngành và từ khóa.
     */
    public function index(Request $request)
    {
        $query = Course::query();

        if ($request->filled('major_id')) {
            $majorId = $request->input('major_id');
            $query->whereHas('majors', function ($q) use ($majorId) {
                $q->where('majors.major_id', $majorId);
            });
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('course_id', 'like', '%' . $search . '%')
                  ->orWhere('course_name', 'like', '%' . $search . '%');
            });
        }

        $courses = $query->with(['lecturer', 'course_major', 'prerequisite'])->paginate(10);
        $majors = Major::all();

        return ['courses' => $courses, 'majors' => $majors];
    }

    /**
     * Chuẩn bị dữ liệu cần thiết cho form tạo môn học.
     */
    public function prepareCreateData()
    {
        $lecturers = Lecturer::all();
        $majors = Major::all();
        $coursesList = Course::all();
        return compact('lecturers', 'majors', 'coursesList');
    }

    /**
     * Lưu môn học mới và các thông tin liên quan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id'           => 'required|unique:courses,course_id',
            'course_name'         => 'required',
            'course_description'  => 'nullable',
            'credits'             => 'required|integer|min:1',
            'day_of_week'         => 'required|integer|min:1|max:7',
            'start_time'          => 'required',
            'end_time'            => 'required',
            'majors'              => 'required|array',
            'majors.*'            => 'exists:majors,major_id',
        ]);

        $course = new Course();
        $course->course_id          = $request->input('course_id');
        $course->course_name        = $request->input('course_name');
        $course->course_description = $request->input('course_description');
        $course->credits            = $request->input('credits');
        if ($request->filled('lecturer_id')) {
            $course->lecturer_id = $request->input('lecturer_id');
        }
        $course->save();

        // Tạo lịch học cho môn học
        $course->schedules()->create([
            'day_of_week' => $request->input('day_of_week'),
            'start_time'  => $request->input('start_time'),
            'end_time'    => $request->input('end_time'),
        ]);

        // Xử lý chuyên ngành
        foreach ($request->input('majors', []) as $majorId) {
            CourseMajor::create([
                'course_id'           => $course->course_id,
                'major_id'            => $majorId,
                'is_elective'         => $request->input('is_elective', 0),
                'recommended_semester'=> $request->input('recommended_semester'),
            ]);
        }

        // Xử lý prerequisites nếu có
        if (
            !$request->has('no_prerequisites') &&
            $request->filled('prerequisite_major_id') &&
            $request->filled('prerequisite_course_id') &&
            $request->filled('prerequisite_type')
        ) {
            Prerequisite::create([
                'course_id'              => $course->course_id,
                'major_id'               => $request->input('prerequisite_major_id'),
                'prerequisite_course_id' => $request->input('prerequisite_course_id'),
                'prerequisite_type'      => $request->input('prerequisite_type'),
            ]);
        }

        return $course;
    }

    /**
     * Lấy dữ liệu cần thiết để chỉnh sửa môn học.
     */
    public function edit($course_id)
    {
        $course = Course::findOrFail($course_id);
        $lecturers = Lecturer::all();
        $majors = Major::all();
        $coursesList = Course::all();

        $courseMajor   = $course->course_major ?? CourseMajor::where('course_id', $course->course_id)->first();
        $prerequisite  = $course->prerequisite ?? Prerequisite::where('course_id', $course->course_id)->first();
        $selectedMajors = $course->majors->keyBy('major_id');
        $course->load('majors', 'prerequisites');

        return compact('course', 'lecturers', 'majors', 'coursesList', 'courseMajor', 'prerequisite', 'selectedMajors');
    }

    /**
     * Cập nhật thông tin môn học.
     */
    public function update(Request $request, $course_id)
    {
        $request->validate([
            'course_id'           => 'required|unique:courses,course_id,' . $course_id . ',course_id',
            'course_name'         => 'required',
            'course_description'  => 'nullable',
            'credits'             => 'required|integer|min:1',
            'day_of_week'         => 'required|integer|min:1|max:7',
            'start_time'          => 'required',
            'end_time'            => 'required',
            'majors'              => 'required|array',
            'majors.*.major_id'   => 'required|exists:majors,major_id',
            'majors.*.is_elective'=> 'required|in:0,1',
            'majors.*.recommended_semester' => 'nullable|integer|min:1',
            'prerequisites'       => 'nullable|array',
            'prerequisites.*.major_id' => 'required_with:prerequisites|exists:majors,major_id',
            'prerequisites.*.prerequisite_course_id' => 'required_with:prerequisites|exists:courses,course_id',
            'prerequisites.*.prerequisite_type'      => 'required_with:prerequisites|in:Required,Optional,Previous',
        ]);

        $course = Course::findOrFail($course_id);
        $oldCourseId = $course->course_id;
        $newCourseId = $request->input('course_id');

        $course->course_id = $newCourseId;
        $course->course_name = $request->input('course_name');
        $course->course_description = $request->input('course_description');
        $course->credits = $request->input('credits');
        if ($request->filled('lecturer_id')) {
            $course->lecturer_id = $request->input('lecturer_id');
        }
        $course->save();

        // Cập nhật lịch học
        if ($course->schedules()->exists()) {
            $course->schedules()->update([
                'day_of_week' => $request->input('day_of_week'),
                'start_time'  => $request->input('start_time'),
                'end_time'    => $request->input('end_time'),
            ]);
        } else {
            $course->schedules()->create([
                'day_of_week' => $request->input('day_of_week'),
                'start_time'  => $request->input('start_time'),
                'end_time'    => $request->input('end_time'),
            ]);
        }

        // Xử lý chuyên ngành
        $syncData = [];
        foreach ($request->input('majors') as $majorData) {
            if (isset($majorData['active'])) {
                $syncData[$majorData['major_id']] = [
                    'is_elective' => $majorData['is_elective'],
                    'recommended_semester' => $majorData['recommended_semester']
                ];
            }
        }
        $course->majors()->sync($syncData);

        // Xử lý prerequisites
        if ($request->has('delete_prerequisites')) {
            Prerequisite::where('course_id', $course->course_id)->delete();
        } else {
            Prerequisite::where('course_id', $course->course_id)->delete();
            foreach ($request->input('prerequisites', []) as $prerequisiteData) {
                if (!empty($prerequisiteData['major_id']) && !empty($prerequisiteData['prerequisite_course_id'])) {
                    Prerequisite::create([
                        'course_id'              => $course->course_id,
                        'major_id'               => $prerequisiteData['major_id'],
                        'prerequisite_course_id' => $prerequisiteData['prerequisite_course_id'],
                        'prerequisite_type'      => $prerequisiteData['prerequisite_type'],
                    ]);
                }
            }
        }

        return $course;
    }

    /**
     * Xóa môn học.
     */
    public function destroy($course_id)
    {
        $course = Course::findOrFail($course_id);
        $course->delete();
        return $course;
    }
}

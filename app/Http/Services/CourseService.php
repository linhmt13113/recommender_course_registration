<?php

namespace App\Services;

use App\Models\Course;
use App\Models\CourseMajor;
use App\Models\Prerequisite;
use Illuminate\Http\Request;

class CourseService
{
    /**
     * Lấy danh sách môn học theo điều kiện lọc từ request.
     */
    public function getCourses(Request $request)
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

        return $query->with(['lecturer', 'course_major', 'prerequisite'])->paginate(10);
    }

    /**
     * Lưu môn học mới và xử lý các logic liên quan.
     */
    public function createCourse(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'course_id' => 'required|unique:courses,course_id',
            'course_name' => 'required',
            'course_description' => 'nullable',
            'credits' => 'required|integer|min:1',
            'day_of_week' => 'required|integer|min:1|max:7',
            'start_time' => 'required',
            'end_time' => 'required',
            'majors' => 'required|array',
            'majors.*' => 'exists:majors,major_id',
        ]);

        // Tạo môn học mới
        $course = new Course();
        $course->course_id = $request->input('course_id');
        $course->course_name = $request->input('course_name');
        $course->course_description = $request->input('course_description');
        $course->credits = $request->input('credits');

        if ($request->filled('lecturer_id')) {
            $course->lecturer_id = $request->input('lecturer_id');
        }
        $course->save();

        // Tạo lịch học cho môn học vừa thêm
        $course->schedules()->create([
            'day_of_week' => $request->input('day_of_week'),
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
        ]);

        // Xử lý chuyên ngành
        $majors = $request->input('majors', []);
        foreach ($majors as $majorId) {
            CourseMajor::create([
                'course_id' => $course->course_id,
                'major_id' => $majorId,
                'is_elective' => $request->input('is_elective', 0),
                'recommended_semester' => $request->input('recommended_semester'),
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
                'course_id' => $course->course_id,
                'major_id' => $request->input('prerequisite_major_id'),
                'prerequisite_course_id' => $request->input('prerequisite_course_id'),
                'prerequisite_type' => $request->input('prerequisite_type'),
            ]);
        }

        return $course;
    }

    // Bạn có thể thêm các phương thức khác như updateCourse, deleteCourse, vv.
}

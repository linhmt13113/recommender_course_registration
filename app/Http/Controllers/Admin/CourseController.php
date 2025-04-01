<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lecturer;
use App\Models\Major;
use App\Models\CourseMajor;
use App\Models\Prerequisite;

class CourseController extends Controller
{
    /**
     * Hiển thị danh sách môn học.
     */
    public function index(Request $request)
    {
        $query = Course::query();

        if ($request->filled('major_id')) {
            $majorId = $request->input('major_id');
            $query->whereHas('majors', function ($q) use ($majorId) {
                // Chỉ định rõ bảng là "majors"
                $q->where('majors.major_id', $majorId);
            });
        }

        // Lọc theo từ khóa (course_id hoặc course_name)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('course_id', 'like', '%' . $search . '%')
                    ->orWhere('course_name', 'like', '%' . $search . '%');
            });
        }

        // Eager load các quan hệ cần thiết
        $courses = $query->with(['lecturer', 'course_major', 'prerequisite'])->paginate(10);

        // Lấy danh sách các chuyên ngành để tạo dropdown lọc
        $majors = Major::all();

        return view('admin.courses.index', compact('courses', 'majors'));
    }


    /**
     * Hiển thị form thêm môn học.
     */
    public function create()
    {
        // Lấy danh sách giảng viên, chuyên ngành và các môn học (cho mục tiên quyết)
        $lecturers = Lecturer::all();
        $majors = Major::all();
        $coursesList = Course::all();
        return view('admin.courses.create', compact('lecturers', 'majors', 'coursesList'));
    }

    /**
     * Lưu môn học mới.
     */
    public function store(Request $request)
    {
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
        // Tạo bản ghi cho bảng course_major nếu có nhập
        // if ($request->filled('course_major_major_id')) {
        //     CourseMajor::create([
        //         'course_id' => $course->course_id,
        //         'major_id' => $request->input('course_major_major_id'),
        //         // Giả sử 0: bắt buộc, 1: tự chọn
        //         'is_elective' => $request->input('is_elective', 0),
        //         'recommended_semester' => $request->input('recommended_semester'),
        //     ]);
        // }

        // Tạo bản ghi cho bảng prerequisites nếu có nhập
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

        return redirect()->route('monhoc.index')
            ->with('success', 'Thêm môn học thành công.');
    }

    /**
     * Hiển thị form chỉnh sửa môn học.
     */
    public function edit($course_id)
    {
        // Sử dụng khóa chính course_id
        $course = Course::findOrFail($course_id);
        $lecturers = Lecturer::all();
        $majors = Major::all();
        $coursesList = Course::all();

        // Lấy thông tin course_major và prerequisite (giả sử mỗi môn học có 1 bản ghi)
        $courseMajor = $course->course_major ?? CourseMajor::where('course_id', $course->course_id)->first();
        $prerequisite = $course->prerequisite ?? Prerequisite::where('course_id', $course->course_id)->first();
        $selectedMajors = $course->majors->keyBy('major_id');

        return view('admin.courses.edit', compact('course', 'lecturers', 'majors', 'coursesList', 'courseMajor', 'prerequisite', 'selectedMajors'));
    }

    /**
     * Cập nhật thông tin môn học.
     */
    public function update(Request $request, $course_id)
    {
        $request->validate([
            // Nếu course_id được thay đổi, validate phải đảm bảo là duy nhất (trừ bản ghi hiện tại)
            'course_id' => 'required|unique:courses,course_id,' . $course_id . ',course_id',
            'course_name' => 'required',
            'course_description' => 'nullable',
            'credits' => 'required|integer|min:1',
            'day_of_week' => 'required|integer|min:1|max:7',
            'start_time' => 'required',
            'end_time' => 'required',
            'majors' => 'required|array',
            'majors.*.major_id' => 'required|exists:majors,major_id',
            'majors.*.is_elective' => 'required|in:0,1',
            'majors.*.recommended_semester' => 'nullable|integer|min:1',
        ]);

        // Lấy bản ghi course theo khóa cũ
        $course = Course::findOrFail($course_id);
        $oldCourseId = $course->course_id;
        $newCourseId = $request->input('course_id');

        // Cập nhật các trường của course
        $course->course_id = $newCourseId; // cập nhật mã mới
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
                'start_time' => $request->input('start_time'),
                'end_time' => $request->input('end_time'),
            ]);
        } else {
            $course->schedules()->create([
                'day_of_week' => $request->input('day_of_week'),
                'start_time' => $request->input('start_time'),
                'end_time' => $request->input('end_time'),
            ]);
        }

        // Cập nhật hoặc tạo mới bản ghi cho course_major
        // $courseMajor = CourseMajor::where('course_id', $oldCourseId)->first();
        // if ($request->filled('course_major_major_id')) {
        //     $dataCourseMajor = [
        //         'major_id' => $request->input('course_major_major_id'),
        //         'is_elective' => $request->input('is_elective', 0),
        //         'recommended_semester' => $request->input('recommended_semester'),
        //     ];
        //     if ($courseMajor) {
        //         $courseMajor->update($dataCourseMajor);
        //         // Nếu mã môn học thay đổi, cập nhật luôn course_id trong bảng course_major
        //         if ($oldCourseId !== $newCourseId) {
        //             $courseMajor->course_id = $newCourseId;
        //             $courseMajor->save();
        //         }
        //     } else {
        //         $dataCourseMajor['course_id'] = $newCourseId;
        //         CourseMajor::create($dataCourseMajor);
        //     }
        // }

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


        // Cập nhật hoặc tạo mới bản ghi cho prerequisites

        // Xử lý thông tin prerequisites
        if ($request->has('delete_prerequisites')) {
            // Nếu checkbox "delete_prerequisites" được chọn, xóa hết bản ghi prerequisites của môn học cũ
            Prerequisite::where('course_id', $oldCourseId)->delete();
        } else {
            // Nếu không, kiểm tra và cập nhật (hoặc tạo mới) bản ghi prerequisites nếu đủ thông tin
            if (
                $request->filled('prerequisite_major_id') &&
                $request->filled('prerequisite_course_id') &&
                $request->filled('prerequisite_type')
            ) {

                $dataPrerequisite = [
                    'major_id' => $request->input('prerequisite_major_id'),
                    'prerequisite_course_id' => $request->input('prerequisite_course_id'),
                    'prerequisite_type' => $request->input('prerequisite_type'),
                ];

                $prerequisite = Prerequisite::where('course_id', $oldCourseId)->first();
                if ($prerequisite) {
                    $prerequisite->update($dataPrerequisite);
                    if ($oldCourseId !== $newCourseId) {
                        $prerequisite->course_id = $newCourseId;
                        $prerequisite->save();
                    }
                } else {
                    $dataPrerequisite['course_id'] = $newCourseId;
                    Prerequisite::create($dataPrerequisite);
                }
            }
        }

        return redirect()->route('monhoc.index')
            ->with('success', 'Cập nhật môn học thành công.');
    }


    /**
     * Xóa môn học.
     */
    public function destroy($course_id)
    {
        $course = Course::findOrFail($course_id);
        $course->delete();
        return redirect()->route('monhoc.index')
            ->with('success', 'Xóa môn học thành công.');
    }
}

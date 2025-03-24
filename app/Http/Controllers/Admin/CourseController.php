<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lecturer;

class CourseController extends Controller
{
    /**
     * Hiển thị danh sách môn học.
     */
    public function index()
    {
        // Lấy luôn thông tin giảng viên nếu có (eager loading)
        $courses = Course::with('lecturer')->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Hiển thị form thêm môn học.
     */
    public function create()
    {
        // Lấy danh sách giảng viên để gán môn học nếu cần
        $lecturers = Lecturer::all();
        return view('admin.courses.create', compact('lecturers'));
    }

    /**
     * Lưu môn học mới.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_name'        => 'required',
            'course_description' => 'nullable',
        ]);

        $course = new Course();
        // Sinh mã môn học tự tạo: 'MH' + thời gian hiện tại
        $course->course_id           = 'MH' . time();
        $course->course_name         = $request->input('course_name');
        $course->course_description  = $request->input('course_description');
        if ($request->filled('lecturer_id')) {
            $course->lecturer_id = $request->input('lecturer_id');
        }
        $course->save();

        return redirect()->route('monhoc.index')
                         ->with('success', 'Thêm môn học thành công.');
    }

    /**
     * Hiển thị form chỉnh sửa môn học.
     */
    public function edit($course_id)
    {
        // Sử dụng khóa chính course_id
        $course    = Course::findOrFail($course_id);
        $lecturers = Lecturer::all();
        return view('admin.courses.edit', compact('course', 'lecturers'));
    }

    /**
     * Cập nhật thông tin môn học.
     */
    public function update(Request $request, $course_id)
    {
        $request->validate([
            'course_name'        => 'required',
            'course_description' => 'nullable',
        ]);

        $course = Course::findOrFail($course_id);
        $course->course_name        = $request->input('course_name');
        $course->course_description = $request->input('course_description');
        if ($request->filled('lecturer_id')) {
            $course->lecturer_id = $request->input('lecturer_id');
        }
        $course->save();

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

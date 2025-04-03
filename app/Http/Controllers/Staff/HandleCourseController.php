<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\CourseService;

class HandleCourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        // Có thể áp dụng middleware nếu cần (ví dụ: kiểm tra role staff)
        $this->courseService = $courseService;
    }

    /**
     * Hiển thị danh sách môn học.
     */
    public function index(Request $request)
    {
        $data = $this->courseService->index($request);
        // Giả sử view dành cho staff nằm trong staff/courses
        return view('academic_staff.courses.index', $data);
    }

    /**
     * Hiển thị form tạo môn học.
     */
    public function create()
    {
        $data = $this->courseService->prepareCreateData();
        return view('academic_staff.courses.create', $data);
    }

    /**
     * Lưu môn học mới.
     */
    public function store(Request $request)
    {
        $course = $this->courseService->store($request);
        return redirect()->route('monhoc.index')
            ->with('success', 'Thêm môn học thành công.');
    }

    /**
     * Hiển thị form chỉnh sửa môn học.
     */
    public function edit($course_id)
    {
        $data = $this->courseService->edit($course_id);
        return view('academic_staff.courses.edit', $data);
    }

    /**
     * Cập nhật môn học.
     */
    public function update(Request $request, $course_id)
    {
        $course = $this->courseService->update($request, $course_id);
        return redirect()->route('monhoc.index')
            ->with('success', 'Cập nhật môn học thành công.');
    }

    /**
     * Xóa môn học.
     */
    public function destroy($course_id)
    {
        $this->courseService->destroy($course_id);
        return redirect()->route('monhoc.index')
            ->with('success', 'Xóa môn học thành công.');
    }
}

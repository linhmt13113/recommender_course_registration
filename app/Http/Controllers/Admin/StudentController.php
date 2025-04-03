<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\StudentService;

class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    /**
     * Hiển thị danh sách sinh viên.
     */
    public function index(Request $request)
    {
        $students = $this->studentService->index($request);
        return view('admin.students.index', compact('students'));
    }

    /**
     * Hiển thị form tạo sinh viên.
     */
    public function create()
    {
        $data = $this->studentService->prepareCreateData();
        return view('admin.students.create', $data);
    }

    /**
     * Lưu sinh viên mới.
     */
    public function store(Request $request)
    {
        $this->studentService->store($request);
        return redirect()->route('sinhvien.index')
                         ->with('success', 'Thêm sinh viên thành công.');
    }

    /**
     * Hiển thị form chỉnh sửa sinh viên.
     */
    public function edit($student_id)
    {
        $data = $this->studentService->prepareEditData($student_id);
        return view('admin.students.edit', $data);
    }

    /**
     * Cập nhật sinh viên.
     */
    public function update(Request $request, $student_id)
    {
        $this->studentService->update($request, $student_id);
        return redirect()->route('sinhvien.index')
                         ->with('success', 'Cập nhật sinh viên thành công.');
    }

    /**
     * Xóa sinh viên.
     */
    public function destroy($student_id)
    {
        $this->studentService->destroy($student_id);
        return redirect()->route('sinhvien.index')
                         ->with('success', 'Xóa sinh viên thành công.');
    }
}

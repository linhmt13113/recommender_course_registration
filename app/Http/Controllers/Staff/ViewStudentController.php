<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\StudentService;

class ViewStudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function index(Request $request)
    {
        $students = $this->studentService->index($request);
        return view('academic_staff.students.index', compact('students'));
    }
    /**
     * Hiển thị chi tiết các môn học mà sinh viên đã học.
     */
    public function showCourses($student_id)
    {
        $student = $this->studentService->showCourses($student_id);
        return view('academic_staff.students.courses', compact('student'));
    }

    /**
     * Hiển thị đăng ký môn học của sinh viên.
     */
    public function showRegistrations($student_id)
    {
        $data = $this->studentService->showRegistrations($student_id);
        return view('academic_staff.students.registrations', $data);
    }

    /**
     * Xóa một đăng ký môn học của sinh viên.
     */
    public function destroyRegistration($registrationId)
    {
        $this->studentService->destroyRegistration($registrationId);
        return redirect()->back()->with('success', 'Xóa đăng ký môn học thành công.');
    }
}

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
     * Display the details of the courses the student has taken.
     */
    public function showCourses($student_id)
    {
        $student = $this->studentService->showCourses($student_id);
        return view('academic_staff.students.courses', compact('student'));
    }

    /**
     * Display the course registrations of the student.
     */
    public function showRegistrations($student_id)
    {
        $data = $this->studentService->showRegistrations($student_id);
        return view('academic_staff.students.registrations', $data);
    }

    /**
     * Delete a course registration of the student.
     */
    public function destroyRegistration($registrationId)
    {
        $this->studentService->destroyRegistration($registrationId);
        return redirect()->back()->with('success', 'Course registration deleted successfully.');
    }
}

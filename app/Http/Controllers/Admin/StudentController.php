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
     * Display the list of students.
     */
    public function index(Request $request)
    {
        $students = $this->studentService->index($request);
        return view('admin.students.index', compact('students'));
    }

    /**
     * Display the student creation form.
     */
    public function create()
    {
        $data = $this->studentService->prepareCreateData();
        return view('admin.students.create', $data);
    }

    /**
     * Store a new student.
     */
    public function store(Request $request)
    {
        $this->studentService->store($request);
        return redirect()->route('ad_student.index')
                         ->with('success', 'Student added successfully.');
    }

    /**
     * Display the student edit form.
     */
    public function edit($student_id)
    {
        $data = $this->studentService->prepareEditData($student_id);
        return view('admin.students.edit', $data);
    }

    /**
     * Update a student.
     */
    public function update(Request $request, $student_id)
    {
        $this->studentService->update($request, $student_id);
        return redirect()->route('ad_student.index')
                         ->with('success', 'Student updated successfully.');
    }

    /**
     * Delete a student.
     */
    public function destroy($student_id)
    {
        $this->studentService->destroy($student_id);
        return redirect()->route('ad_student.index')
                         ->with('success', 'Student deleted successfully.');
    }
}

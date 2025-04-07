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
        // checking staff role
        $this->courseService = $courseService;
    }

    /**
     * Display the list of courses.
     */
    public function index(Request $request)
    {
        $data = $this->courseService->index($request);
        return view('academic_staff.courses.index', $data);
    }

    /**
     * Display the course creation form.
     */
    public function create()
    {
        $data = $this->courseService->prepareCreateData();
        return view('academic_staff.courses.create', $data);
    }

    /**
     * Store a new course.
     */
    public function store(Request $request)
    {
        $course = $this->courseService->store($request);
        return redirect()->route('staff_courses.index')
            ->with('success', 'Course added successfully.');
    }

    /**
     * Display the course edit form.
     */
    public function edit($course_id)
    {
        $data = $this->courseService->edit($course_id);
        return view('academic_staff.courses.edit', $data);
    }

    /**
     * Update the course.
     */
    public function update(Request $request, $course_id)
    {
        $course = $this->courseService->update($request, $course_id);
        return redirect()->route('staff_courses.index')
            ->with('success', 'Course updated successfully.');
    }

    /**
     * Delete the course.
     */
    public function destroy($course_id)
    {
        $this->courseService->destroy($course_id);
        return redirect()->route('staff_courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}

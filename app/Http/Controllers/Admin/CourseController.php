<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\CourseService;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        // If you need to check admin privileges, you can add middleware here
        $this->courseService = $courseService;
    }

    /**
     * Display the list of courses.
     */
    public function index(Request $request)
    {
        $data = $this->courseService->index($request);
        // Assuming the view for the admin is located in admin/courses
        return view('admin.courses.index', $data);
    }

    /**
     * Delete a course.
     */
    public function destroy($course_id)
    {
        $this->courseService->destroy($course_id);
        return redirect()->route('viewcourses.index')
            ->with('success', 'Course deleted successfully.');
    }
}

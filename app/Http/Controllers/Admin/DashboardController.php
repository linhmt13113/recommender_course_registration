<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\StudentService;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Course;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $totalStudents = Student::count();
        $totalLecturers = Lecturer::count();
        $totalCourses = Course::count();
        $recentRegistrations = Student::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalStudents',
            'totalLecturers',
            'totalCourses',
            'recentRegistrations'
        ));
    }
}

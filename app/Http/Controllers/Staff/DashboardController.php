<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use App\Models\Course;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSemesters = Semester::count();
        $openSemesters = Semester::where('registration_status', 'open')->count();
        $recentSemesters = Semester::orderBy('created_at', 'desc')->take(5)->get();

        // Lấy tổng số môn đang mở ở kỳ mới nhất (nếu có)
        $latestSemester = Semester::orderBy('start_date', 'desc')->first();
        $totalCoursesInLatest = $latestSemester ? $latestSemester->courses()->count() : 0;

        return view('academic_staff.dashboard', compact(
            'totalSemesters',
            'openSemesters',
            'recentSemesters',
            'totalCoursesInLatest'
        ));
    }
}

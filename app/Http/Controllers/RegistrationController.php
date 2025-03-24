<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semester;

class RegistrationController extends Controller
{
    public function index()
    {
        $semesters = Semester::all();
        return view('admin.registration.index', compact('semesters'));
    }

    public function openRegistration($id)
    {
        $semester = Semester::findOrFail($id);

        // Kiểm tra nếu học kỳ chưa bắt đầu (ngày hiện tại nhỏ hơn start_date)
        if (now()->lt($semester->start_date)) {
            $semester->registration_status = 'open';
            $semester->save();
            return redirect()->back()->with('success', 'Mở đợt đăng ký thành công cho học kỳ: ' . $semester->semester_id);
        } else {
            return redirect()->back()->with('error', 'Học kỳ này đã bắt đầu, không thể mở đăng ký.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\AcademicStaff;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Hiển thị trang đăng nhập.
     * Display the login page.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Xử lý đăng nhập.
     * Handle the login process.
     */
    public function login(Request $request)
    {
        // Validate dữ liệu đầu vào
        // Validate the input data
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->input('username');
        $password = $request->input('password');
        // dd(session()->all());

        // Kiểm tra trong bảng Admin (dùng email làm username)
        // Check in the Admin table (use email as username)
        $admin = Admin::where('email', $username)->first();
        if ($admin && Hash::check($password, $admin->password)) {
            // Lưu thông tin vào session để xác định role admin
            // Store information in session to identify the admin role
            session([
                'user_role' => 'admin',
                'user' => $admin
            ]);
            return redirect('/admin/dashboard');
        }

        // Kiểm tra trong bảng Lecturer (dùng email làm username)
        // Check in the Lecturer table (use email as username)
        $lecturer = Lecturer::where('lecturer_id', $username)->first();
        if ($lecturer && Hash::check($password, $lecturer->password)) {
            session([
                'user_role' => 'lecturer',
                'user' => $lecturer
            ]);
            return redirect('/gvien/lichday');
        }

        // Kiểm tra Nhân viên giáo vụ
        // Check in the Academic Staff table
        $staff = AcademicStaff::where('staff_id', $username)->first();
        if ($staff && Hash::check($password, $staff->password)) {
            session([
                'user_role' => 'staff',  // Role mới
                // New role
                'user' => $staff
            ]);
            return redirect('/academicstaff/dashboard');
        }

        // Kiểm tra trong bảng Student (sử dụng student_id làm username)
        // Check in the Student table (use student_id as username)
        $student = Student::where('student_id', $username)->first();
        if ($student && Hash::check($password, $student->password)) {
            // Lưu thêm thông tin chuyên ngành của sinh viên vào session
            // Store additional student major information in session
            session([
                'user_role' => 'student',
                'user' => $student,
                'major_id' => $student->major_id
            ]);
            return redirect('/svien/dashboard')->with('student', $student);
        }

        // Nếu không tìm thấy hoặc mật khẩu không đúng, trả về lỗi
        // If no user is found or the password is incorrect, return an error
        return back()->withErrors(['username' => 'Incorrect account or password!']);
        // Account or password is incorrect!
    }

    /**
     * Xử lý đăng xuất.
     * Handle the logout process.
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/login');
    }

    /**
     * Thay đổi mật khẩu (Ví dụ).
     * Change password (Example).
     */
    public function changePassword(Request $request)
    {
        // Validate dữ liệu nhập vào
        // Validate the input data
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = session('user');
        // Kiểm tra mật khẩu hiện tại
        // Check the current password
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect!']);
            // The current password is incorrect!
        }

        // Cập nhật mật khẩu mới (băm lại mật khẩu)
        // Update the new password (hash the password)
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return back()->with('success', 'Password updated successfully.');
        // Password has been successfully updated.
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Lecturer;

class AuthController extends Controller
{
    /**
     * Hiển thị trang đăng nhập.
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Tạo file view resources/views/auth/login.blade.php sau
    }

    /**
     * Xử lý đăng nhập.
     */
    public function login(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        // Kiểm tra trong bảng Admin (dùng email làm username)
        $admin = Admin::where('email', $username)->first();
        if ($admin && Hash::check($password, $admin->password)) {
            // Lưu thông tin vào session để xác định role admin
            session([
                'user_role' => 'admin',
                'user'      => $admin
            ]);
            return redirect('/qly/dashboard');
        }

        // Kiểm tra trong bảng Lecturer (dùng email làm username)
        $lecturer = Lecturer::where('lecturer_id', $username)->first();
        if ($lecturer && Hash::check($password, $lecturer->password)) {
            session([
                'user_role' => 'lecturer',
                'user'      => $lecturer
            ]);
            return redirect('/gvien/lichday');
        }

        // Kiểm tra trong bảng Student (sử dụng student_id làm username)
        $student = Student::where('student_id', $username)->first();
        if ($student && Hash::check($password, $student->password)) {
            // Lưu thêm thông tin chuyên ngành của sinh viên vào session
            session([
                'user_role' => 'student',
                'user'      => $student,
                'major_id'  => $student->major_id
            ]);
            return redirect('/svien/dashboard');
        }

        // Nếu không tìm thấy hoặc mật khẩu không đúng, trả về lỗi
        return back()->withErrors(['username' => 'Tài khoản hoặc mật khẩu không đúng!']);
    }

    /**
     * Xử lý đăng xuất.
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login');
    }

    /**
     * Thay đổi mật khẩu (Ví dụ).
     */
    public function changePassword(Request $request)
    {
        // Validate dữ liệu nhập vào
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|min:6|confirmed',
        ]);

        $user = session('user');
        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng!']);
        }

        // Cập nhật mật khẩu mới (băm lại mật khẩu)
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return back()->with('success', 'Mật khẩu đã được cập nhật thành công.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Major;
use App\Models\StudentRegistration;

class StudentController extends Controller
{
    /**
     * Hiển thị danh sách sinh viên cùng các môn học đã đăng ký.
     */
    public function index(Request $request)
    {
        $students = Student::with('courses')->paginate(10);
        return view('admin.students.index', compact('students'));
    }

    /**
     * Hiển thị form thêm sinh viên.
     */
    public function create()
    {
        $majors = Major::all();
        return view('admin.students.create', compact('majors'));
    }

    /**
     * Lưu sinh viên mới.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|unique:students,student_id',
            'student_name' => 'required',
            'major_id' => 'required',
        ]);

        $student = new Student();
        $student->student_id = $request->input('student_id');
        $student->student_name = $request->input('student_name');
        $student->major_id = $request->input('major_id');
        $student->password = bcrypt('student123');
        $student->save();

        return redirect()->route('sinhvien.index')
            ->with('success', 'Thêm sinh viên thành công.');
    }

    /**
     * Hiển thị form chỉnh sửa sinh viên.
     */
    public function edit($student_id)
    {
        $student = Student::findOrFail($student_id);
        $majors = Major::all();
        return view('admin.students.edit', compact('student', 'majors'));
    }

    /**
     * Cập nhật thông tin sinh viên.
     */
    public function update(Request $request, $student_id)
    {
        $request->validate([
            'student_id' => 'required|unique:students,student_id,' . $student_id,
            'student_name' => 'required',
            'major_id' => 'required',
        ]);

        $student = Student::findOrFail($student_id);
        $student->student_id = $request->input('student_id');
        $student->student_name = $request->input('student_name');
        $student->major_id = $request->input('major_id');
        $student->save();

        return redirect()->route('sinhvien.index')
            ->with('success', 'Cập nhật sinh viên thành công.');
    }

    /**
     * Xóa sinh viên.
     */
    public function destroy($student_id)
    {
        $student = Student::findOrFail($student_id);
        $student->delete();

        return redirect()->route('sinhvien.index')
            ->with('success', 'Xóa sinh viên thành công.');
    }

    /**
     * Xem chi tiết các môn học mà sinh viên đã hoc.
     */
    public function showCourses($student_id)
    {
        $student = Student::with('courses', 'major')->findOrFail($student_id);
        return view('admin.students.courses', compact('student'));
    }

    public function showRegistrations($student_id)
    {
        $student = Student::with('major')->findOrFail($student_id);
        // Lấy đăng ký từ bảng student_registrations, eager load quan hệ course
        $registrations = StudentRegistration::with('course')
            ->where('student_id', $student_id)
            ->get();

        return view('admin.students.registrations', compact('student', 'registrations'));
    }

    public function destroyRegistration($registrationId)
    {
        $registration = StudentRegistration::findOrFail($registrationId);
        $registration->delete();
        return redirect()->back()->with('success', 'Xóa đăng ký môn học thành công.');
    }
}

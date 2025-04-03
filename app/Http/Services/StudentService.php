<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Major;
use App\Models\StudentRegistration;

class StudentService
{
    /**
     * Lấy danh sách sinh viên kèm các môn học đã đăng ký (với eager load).
     */
    public function index(Request $request)
    {
        // Nếu cần thêm filter, có thể bổ sung vào đây
        return Student::with('courses')->paginate(10);
    }

    /**
     * Lấy dữ liệu cần thiết cho form tạo sinh viên.
     */
    public function prepareCreateData()
    {
        $majors = Major::all();
        return compact('majors');
    }

    /**
     * Lưu sinh viên mới.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id'   => 'required|unique:students,student_id',
            'student_name' => 'required',
            'major_id'     => 'required'
        ]);

        $student = new Student();
        $student->student_id   = $request->input('student_id');
        $student->student_name = $request->input('student_name');
        $student->major_id     = $request->input('major_id');
        $student->password     = bcrypt('student123');
        $student->save();

        return $student;
    }

    /**
     * Lấy dữ liệu cho form chỉnh sửa sinh viên.
     */
    public function prepareEditData($student_id)
    {
        $student = Student::findOrFail($student_id);
        $majors  = Major::all();
        return compact('student', 'majors');
    }

    /**
     * Cập nhật thông tin sinh viên.
     */
    public function update(Request $request, $student_id)
    {
        $request->validate([
            'student_name' => 'nullable|string|max:255',
            'major_id'     => 'sometimes|nullable|exists:majors,id',
            'password'     => 'nullable|string|min:6'
        ]);

        $student = Student::findOrFail($student_id);

        if ($request->filled('student_name')) {
            $student->student_name = $request->input('student_name');
        }

        if ($request->has('major_id') && $request->input('major_id') != '') {
            $student->major_id = $request->input('major_id');
        }

        if ($request->filled('password')) {
            $student->password = bcrypt($request->input('password'));
        }

        $student->save();

        return $student;
    }

    /**
     * Xóa sinh viên.
     */
    public function destroy($student_id)
    {
        $student = Student::findOrFail($student_id);
        $student->delete();
        return $student;
    }

    /**
     * Lấy chi tiết sinh viên kèm các môn học đã học.
     */
    public function showCourses($student_id)
    {
        return Student::with('courses', 'major')->findOrFail($student_id);
    }

    /**
     * Lấy thông tin đăng ký của sinh viên.
     */
    public function showRegistrations($student_id)
    {
        $student = Student::with('major')->findOrFail($student_id);
        $registrations = StudentRegistration::with('course')
            ->where('student_id', $student_id)
            ->get();
        return compact('student', 'registrations');
    }

    /**
     * Xóa một đăng ký môn học của sinh viên.
     */
    public function destroyRegistration($registrationId)
    {
        $registration = StudentRegistration::findOrFail($registrationId);
        $registration->delete();
        return $registration;
    }
}

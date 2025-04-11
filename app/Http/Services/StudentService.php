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
     *
     * Get the list of students with the courses they have registered for (using eager load).
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        // Eager load quan hệ 'major' và 'courses'
        $query = Student::with('major', 'courses');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('student_id', 'LIKE', "%{$search}%")
                    ->orWhere('student_name', 'LIKE', "%{$search}%");
            });
        }
        return $query->paginate(10);
    }

    /**
     * Lấy dữ liệu cần thiết cho form tạo sinh viên.
     *
     * Get the necessary data for the student creation form.
     */
    public function prepareCreateData()
    {
        $majors = Major::all();
        return compact('majors');
    }

    /**
     * Lưu sinh viên mới.
     *
     * Store a new student.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|unique:students,student_id',
            'student_name' => 'required',
            'major_id' => 'required'
        ]);

        $student = new Student();
        $student->student_id = $request->input('student_id');
        $student->student_name = $request->input('student_name');
        $student->major_id = $request->input('major_id');
        $student->password = bcrypt('student123');
        $student->save();

        return $student;
    }

    /**
     * Lấy dữ liệu cho form chỉnh sửa sinh viên.
     *
     * Get the necessary data for the student edit form.
     */
    public function prepareEditData($student_id)
    {
        $student = Student::findOrFail($student_id);
        $majors = Major::all();
        return compact('student', 'majors');
    }

    /**
     * Cập nhật thông tin sinh viên.
     *
     * Update student information.
     */
    public function update(Request $request, $student_id)
    {
        $request->validate([
            'student_name' => 'nullable|string|max:255',
            'major_id' => 'sometimes|nullable|exists:majors,id',
            'password' => 'nullable|string|min:6'
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
     *
     * Delete a student.
     */
    public function destroy($student_id)
    {
        $student = Student::findOrFail($student_id);
        $student->delete();
        return $student;
    }

    /**
     * Lấy chi tiết sinh viên kèm các môn học đã học.
     *
     * Get the details of a student along with the courses they have taken.
     */
    public function showCourses($student_id)
    {
        return Student::with('courses', 'major')->findOrFail($student_id);
    }

    /**
     * Lấy thông tin đăng ký của sinh viên.
     *
     * Get the student's registration information.
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
     *
     * Delete a course registration for a student.
     */
    public function destroyRegistration($registrationId)
    {
        $registration = StudentRegistration::findOrFail($registrationId);
        $registration->delete();
        return $registration;
    }
}

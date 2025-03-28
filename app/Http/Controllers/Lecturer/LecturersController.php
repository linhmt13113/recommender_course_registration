<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semester;
use App\Models\Course;
use App\Models\StudentRegistration;

class LecturersController extends Controller
{
    //
    /**
     * Hiển thị thời khóa biểu của giảng viên cho kỳ học hiện hành.
     */
    public function schedule(Request $request)
    {
        // Lấy thông tin giảng viên từ session (hoặc auth()->user() nếu dùng hệ thống auth)
        $lecturer = session('user');
        if (!$lecturer) {
            abort(403, 'Bạn cần đăng nhập.');
        }
        $lecturerId = $lecturer->lecturer_id;

        // Xác định kỳ học hiện hành (bạn cần đảm bảo dữ liệu trong bảng semesters có record bao gồm ngày hiện tại)
        $activeSemester = Semester::whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->first();

        // Nếu không tìm thấy kỳ học hiện hành, bạn có thể lấy record mặc định nếu cần (ví dụ: "SEM_TEST")
        if (!$activeSemester) {
            $activeSemester = Semester::where('semester_id', 'SEM_TEST')->first();
        }

        // Lấy các môn học của giảng viên được gán cho kỳ học hiện hành, kèm theo lịch học
        $courses = Course::where('lecturer_id', $lecturerId)
            ->when($activeSemester, function ($query) use ($activeSemester) {
                $query->whereHas('semesters', function ($q) use ($activeSemester) {
                    $q->where('semesters.semester_id', $activeSemester->semester_id);
                });
            })
            ->with('schedules')
            ->get();

        return view('lecturer.schedule', compact('courses', 'activeSemester', 'lecturer'));
    }


    /**
     * Hiển thị danh sách sinh viên đăng ký cho một môn học cụ thể mà giảng viên dạy.
     */
    public function courseRegistrations($course_id)
    {
        // Lấy giảng viên từ session
        $lecturer = session('user');
        if (!$lecturer) {
            abort(403, 'Bạn cần đăng nhập.');
        }
        $lecturerId = $lecturer->lecturer_id;

        // Lấy thông tin môn học, kèm theo các đăng ký (StudentRegistration) và thông tin sinh viên từ đăng ký đó
        $course = Course::with(['registrations.student'])->findOrFail($course_id);
        // Kiểm tra xem môn học này có thuộc về giảng viên đăng nhập không
        if ($course->lecturer_id != $lecturerId) {
            abort(403, 'Bạn không có quyền xem đăng ký của môn học này.');
        }

        $registrations = $course->registrations;

        return view('lecturer.course_registrations', compact('course', 'registrations'));
    }

}


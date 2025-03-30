<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentCourse;
use App\Models\SemesterCourse;
use App\Models\StudentPreference;
use App\Models\StudentRegistration;
use App\Http\Services\CourseRegistrationService;

class CourseRegistrationController extends Controller
{
    protected $registrationService;

    public function __construct(CourseRegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    /**
     * Hiển thị trang đăng ký môn học với các danh sách:
     * - Môn học mở đăng ký theo chuyên ngành.
     * - Các môn đã đăng ký.
     * - Các môn bắt buộc của học kỳ tiếp theo.
     * - Các môn tự chọn.
     * - Các thông báo ưu tiên nếu có.
     */
    public function index()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors('Vui lòng đăng nhập lại.');
        }
        $student = Student::with('major')->where('student_id', $user['student_id'])->first();

        $availableCourses = $this->registrationService->getAvailableCourses($student);
        $registeredCourses = $this->registrationService->getRegisteredCourses($student);
        $requiredNextSemesterCourses = $this->registrationService->getRequiredCoursesForNextSemester($student);
        $electiveCourses = $this->registrationService->getElectiveCourses($student);
        $priorityMessages = $this->registrationService->getPriorityRequiredCourses($student);
        $currentSemester = $this->registrationService->getCurrentSemester($student);

        return view('student.course_registration.index', compact(
            'availableCourses',
            'registeredCourses',
            'requiredNextSemesterCourses',
            'electiveCourses',
            'priorityMessages',
            'currentSemester'
        ));
    }

    /**
     * Xử lý đăng ký môn học cho sinh viên.
     */
    public function register(Request $request)
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors('Vui lòng đăng nhập lại.');
        }

        $request->validate([
            'course_id' => 'required|string|exists:courses,course_id'
        ]);

        $student = Student::with('major')->where('student_id', $user->student_id)->first();
        $courseId = $request->course_id;

        // Kiểm tra xem môn học có mở đăng ký không
        $semesterCourse = SemesterCourse::where('course_id', $courseId)->first();
        if (!$semesterCourse) {
            return back()->withErrors(['course_id' => 'Môn học không được mở đăng ký.']);
        }

        // Kiểm tra điều kiện prerequisite
        $prereqError = $this->registrationService->checkPrerequisites($student, $courseId);
        if ($prereqError) {
            return back()->withErrors(['prerequisite' => $prereqError]);
        }
        $courseName = $semesterCourse->course->course_name;
        // Kiểm tra xem sinh viên đã đăng ký môn học này chưa
        $existing = StudentRegistration::where('student_id', $student->student_id)
            ->where('course_id', $courseId)
            ->exists();
        if ($existing) {
            return back()->withErrors(['duplicate' => 'Bạn đã đăng ký môn học ' . $courseName . ' rồi.']);
        }

        // Nếu đủ điều kiện, tạo bản ghi đăng ký
        StudentRegistration::create([
            'student_id' => $student->student_id,
            'course_id' => $courseId,
            'semester' => $this->registrationService->getCurrentSemester($student) + 1,
            'status' => '1'
        ]);

        return back()->with('success', 'Đăng ký môn học ' . $courseName . ' thành công.');
    }

    /**
     * Hủy đăng ký môn học.
     */
    public function deleteRegistration($courseId)
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors('Vui lòng đăng nhập lại.');
        }
        $studentId = $user->student_id;
        $registration = StudentRegistration::where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->first();

        $registration->delete();
        $courseName = $registration->course->course_name ?? '';

        return back()->with('success', 'Hủy đăng ký môn học ' . $courseName . ' thành công.');
    }

    /**
     * Hiển thị thời khóa biểu của sinh viên.
     */
    public function showSchedule()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors('Vui lòng đăng nhập lại.');
        }
        $studentId = $user->student_id;
        $student = Student::with('registrations.course.schedules')->find($studentId);
        return view('student.schedule', compact('student'));
    }

    /**
     * Lưu sở thích của sinh viên.
     */
    public function storePreferences(Request $request)
    {
    $user = session('user');
    if (!$user) {
        return redirect()->route('login')->withErrors('Vui lòng đăng nhập lại.');
    }
        $request->validate([
            'preferences' => 'required|string'
        ]);

        StudentPreference::create(
            ['student_id'  => $user['student_id'],
            'preferences' => $request->preferences]
        );

        return back()->with('success', 'Lưu sở thích thành công.');
    }
}

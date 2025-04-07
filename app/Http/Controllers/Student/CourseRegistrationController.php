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
use Illuminate\Support\Facades\Http;

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

        // Lấy sở thích của sinh viên (bản ghi mới nhất)
        $studentPref = StudentPreference::where('student_id', $student->student_id)
            ->latest()->first();
        $electiveRecommendations = [];
        if ($studentPref) {
            $preference = $studentPref->preferences;
            // Tạo mảng các mô tả cho các môn tự chọn
            $courseDescriptions = [];
            foreach ($electiveCourses as $cm) {
                // Dùng course_description nếu có, nếu không dùng course_name
                $desc = $cm->course->course_description ?: $cm->course->course_name;
                $courseDescriptions[] = $desc;
            }
            // Gọi file Python qua shell_exec. Chú ý: đường dẫn là "api/elective_course_recommendation.py"
            $cmd = escapeshellcmd("python3 api/elective_course_recommendation.py " . escapeshellarg($preference) . " " . escapeshellarg(json_encode($courseDescriptions)));
            $output = shell_exec($cmd);
            $result = json_decode($output, true);
            if (isset($result['top3'])) {
                $topCourses = [];
                // Chuyển collection electiveCourses thành mảng với các giá trị liên tiếp.
                $electiveArray = $electiveCourses->values()->all();
                foreach ($result['top3'] as $item) {
                    $index = $item['index'];
                    $score = $item['score'];
                    if (isset($electiveArray[$index])) {
                        $course = $electiveArray[$index]->course;
                        $topCourses[] = [
                            'course_id' => $course->course_id,
                            'course_name' => $course->course_name,
                            'score' => $score,
                        ];
                    }
                }
                $electiveRecommendations = $topCourses;
            }
        }

        return view('student.course_registration.index', compact(
            'availableCourses',
            'registeredCourses',
            'requiredNextSemesterCourses',
            'electiveCourses',
            'priorityMessages',
            'currentSemester',
            'electiveRecommendations'
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

        // Logic đặc biệt cho các môn IT082IU và IT174IU: học kỳ gần nhất phải lớn hơn 4
        if (in_array($courseId, ['IT082IU', 'IT174IU'])) {
            $currentSemester = $this->registrationService->getCurrentSemester($student);
            if (($currentSemester + 1)<= 4) {
                return back()->withErrors(['special' => "Môn $courseName chỉ được đăng ký khi học kỳ gần nhất lớn hơn 4."]);
            }
        }

        // Logic đặc biệt cho các môn IT083IU: học kỳ gần nhất phải lớn hơn 6
        if ($courseId === 'IT083IU') {
            $currentSemester = $this->registrationService->getCurrentSemester($student);
            if (($currentSemester + 1) <= 6) {
                return back()->withErrors(['special' => "Môn $courseName chỉ được đăng ký khi học kỳ gần nhất lớn hơn 6."]);
            }
        }

        // Logic đặc biệt cho môn IT058IU: tổng tín chỉ đã học phải lớn hơn 70
        if ($courseId === 'IT058IU') {
            // Tính tổng số tín chỉ của các môn đã học (trong bảng StudentCourse)
            $totalCredits = StudentCourse::where('student_id', $student->student_id)
                ->with('course')
                ->get()
                ->sum(function ($sc) {
                    return $sc->course->credits;
                });
            if ($totalCredits <= 70) {
                return back()->withErrors(['special' => "Môn $courseName chỉ được đăng ký khi tổng tín chỉ đã học là 90%. (Hiện tại: $totalCredits credit)"]);
            }
        }

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
            'q1_project_description' => 'nullable|string',
            'q2_tools' => 'nullable|array',
            'q2_other_tools' => 'nullable|string',
            'q3_interested_skills' => 'nullable|string',
            'q4_desired_skill' => 'nullable|string',
            'q5_time_activity' => 'nullable|array',
            'q5_other_activity' => 'nullable|string',
            'q6_other_interest' => 'nullable|string',
        ]);

        $q1 = $request->input('q1_project_description');
        $q2 = $request->input('q2_tools', []); // Mảng checkbox
        $q2Other = trim($request->input('q2_other_tools', ''));
        if (!empty($q2Other)) {
            $q2[] = $q2Other;
        }
        $q3 = $request->input('q3_interested_skills');
        $q4 = $request->input('q4_desired_skill');

        $q5 = $request->input('q5_time_activity', []); // Mảng checkbox
        $q5Other = trim($request->input('q5_other_activity', ''));
        if (!empty($q5Other)) {
            $q5[] = $q5Other;
        }

        $q6 = $request->input('q6_other_interest');

        $combinedPreference = '';
        if (!empty($q1)) {
            $combinedPreference .= "$q1. ";
        }
        if (!empty($q2)) {
            $combinedPreference .= implode(', ', $q2) . ". ";
        }
        if (!empty($q3)) {
            $combinedPreference .= "$q3. ";
        }
        if (!empty($q4)) {
            $combinedPreference .= "$q4. ";
        }
        if (!empty($q5)) {
            $combinedPreference .= implode(', ', $q5) . ". ";
        }
        if (!empty($q6)) {
            $combinedPreference .= "$q6. ";
        }

        // dd($preferenceText, $preferenceSelect, $combinedPreference);

        StudentPreference::create(
            [
                'student_id' => $user['student_id'],
                'preferences' => $combinedPreference,
            ]
        );

        // Lấy thông tin sinh viên (bao gồm major) từ DB
        $student = Student::with('major')->where('student_id', $user['student_id'])->first();

        // Lấy danh sách các môn tự chọn chưa hoàn thành từ service
        $electiveCourses = $this->registrationService->getElectiveCourses($student);

        // Xây dựng mảng mô tả cho các môn tự chọn (sử dụng course_description nếu có, nếu không dùng course_name)
        $courseDescriptions = [];
        foreach ($electiveCourses as $cm) {
            $desc = $cm->course->course_description ?: $cm->course->course_name;
            $courseDescriptions[] = $desc;
        }

        // Payload gửi tới API FastAPI (đường dẫn giả sử: http://localhost:8001/recommend)
        $payload = [
            'preference' => $combinedPreference,
            'course_descriptions' => $courseDescriptions,
        ];


        // dd($payload);

        // Gọi API bằng HTTP POST (sử dụng Laravel Http facade)
        $response = Http::post('http://localhost:8001/recommend', $payload);
        // $response = Http::post('http://localhost:8002/retrain_and_recommend', $payload);
        $electiveRecommendations = [];
        if ($response->successful()) {
            $result = $response->json();
            if (isset($result['top3'])) {
                // Chuyển collection electiveCourses thành mảng index liên tục
                $electiveArray = $electiveCourses->values()->all();
                foreach ($result['top3'] as $item) {
                    $index = $item['index'];
                    $score = $item['score'];
                    if (isset($electiveArray[$index])) {
                        $course = $electiveArray[$index]->course;
                        $electiveRecommendations[] = [
                            'course_id' => $course->course_id,
                            'course_name' => $course->course_name,
                            'score' => $score,
                            'course_description' => $course->course_description
                        ];
                    }
                }
            }
        } else {
            // Nếu không thành công, có thể lưu log hoặc đặt mảng rỗng
            $electiveRecommendations = [];
        }

        // Trả về view với flash message và gợi ý các môn tự chọn
        return back()->with([
            'success' => 'Lưu sở thích thành công.',
            'electiveRecommendations' => $electiveRecommendations
        ]);

    }
}

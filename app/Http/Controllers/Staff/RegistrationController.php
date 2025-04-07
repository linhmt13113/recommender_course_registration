<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semester;
use App\Models\CourseMajor;

class RegistrationController extends Controller
{
    //
    public function index()
    {
        $semesters = Semester::all();
        return view('academic_staff.registration.index', compact('semesters'));
    }

    /**
     * Mở đợt đăng ký cho học kỳ (nếu học kỳ chưa bắt đầu).
     * Open the registration period for the semester (if the semester hasn't started).
     */
    public function openRegistration($id)
    {
        $semester = Semester::findOrFail($id);

        // Kiểm tra nếu học kỳ chưa bắt đầu (ngày hiện tại nhỏ hơn start_date)
        // Check if the semester hasn't started (current date is earlier than start_date)
        if (now()->lt($semester->start_date)) {
            // Ở đây, thay vì chỉ cập nhật trạng thái, bạn có thể chuyển sang trang chọn môn (nếu chưa có danh sách)
            // hoặc nếu đã có, admin có thể cập nhật danh sách.
            // Here, instead of just updating the status, you can navigate to the course selection page (if not yet available),
            // or if it's already available, the admin can update the list.
            $semester->registration_status = 'open';
            $semester->save();
            return redirect()->route('academic_staff.registration.courses', $semester->id)
                ->with('success', 'Successfully opened the registration period for semester: ' . $semester->semester_id);
        } else {
            return redirect()->back()->with('error', 'This semester has already started, registration cannot be opened.');
        }
    }

    /**
     * Hiển thị danh sách môn đăng ký cho học kỳ.
     * Show the list of courses available for registration for the semester.
     */
    public function showRegistrationCourses($id)
    {
        $semester = Semester::findOrFail($id);

        // Lấy danh sách các môn đã đăng ký (nếu có) từ bảng pivot.
        // Get the list of registered courses (if any) from the pivot table.
        $selectedCourses = $semester->courses->pluck('course_id')->toArray();

        // Lấy danh sách các môn tự chọn
        // Get the list of elective courses
        $electiveCourses = CourseMajor::where('is_elective', true)
            ->with('course')
            ->get()
            ->unique('course_id');

        // Lấy các môn không tự chọn với recommended_semester là chẵn
        // Get non-elective courses with even recommended semesters
        $evenNonElectiveCourses = CourseMajor::where('is_elective', false)
            ->whereIn('recommended_semester', [2, 4, 6, 8])
            ->with('course')
            ->get()
            ->unique('course_id');

        // Lấy các môn không tự chọn với recommended_semester là lẻ
        // Get non-elective courses with odd recommended semesters
        $oddNonElectiveCourses = CourseMajor::where('is_elective', false)
            ->whereIn('recommended_semester', [1, 3, 5, 7])
            ->with('course')
            ->get()
            ->unique('course_id');


        return view('academic_staff.registration.courses', compact(
            'semester',
            'electiveCourses',
            'evenNonElectiveCourses',
            'oddNonElectiveCourses',
            'selectedCourses'
        ));
    }

    /**
     * Lưu các môn đăng ký cho học kỳ.
     * Store the selected registration courses for the semester.
     */
    public function storeRegistrationCourses(Request $request, $id)
    {
        $semester = Semester::findOrFail($id);
        $selectedCourses = $request->input('selected_courses', []); // mảng course_id
        // array of course_ids

        // Kiểm tra nếu học kỳ chưa bắt đầu
        // Check if the semester hasn't started
        if (now()->lt($semester->start_date)) {
            $semester->registration_status = 'open';
            $semester->save();
        }
        // else {
        //     return redirect()->back()->with('error', 'This semester has already started, registration cannot be opened.');
        // }

        // Cập nhật danh sách các môn được chọn cho học kỳ bằng sync,
        // sync sẽ tự động thêm các môn mới và xóa những môn bị bỏ chọn.
        // Update the list of selected courses for the semester using sync,
        // sync will automatically add new courses and remove the ones that are deselected.
        $semester->courses()->sync($selectedCourses);

        return redirect()->route('academic_staff.registration.index')
            ->with('success', 'Successfully saved and updated the registration courses for semester: ' . $semester->semester_id);
    }

    /**
     * Lấy danh sách các môn đã đăng ký cho học kỳ.
     * Get the list of registered courses for the semester.
     */
    public function getRegistrationCourses($id)
    {
        $semester = Semester::with('courses')->findOrFail($id);
        $registrationCourses = $semester->courses; // Đây là Collection chứa các đối tượng Course
        // This is a Collection containing Course objects

        return view('academic_staff.registration.index', compact('semester', 'registrationCourses'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semester;
use App\Models\CourseMajor;

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
            // Ở đây, thay vì chỉ cập nhật trạng thái, bạn có thể chuyển sang trang chọn môn (nếu chưa có danh sách)
            // hoặc nếu đã có, admin có thể cập nhật danh sách.
            $semester->registration_status = 'open';
            $semester->save();
            return redirect()->route('admin.registration.courses', $semester->id)
                ->with('success', 'Mở đợt đăng ký thành công cho học kỳ: ' . $semester->semester_id);
        } else {
            return redirect()->back()->with('error', 'Học kỳ này đã bắt đầu, không thể mở đăng ký.');
        }
    }

    public function showRegistrationCourses($id)
    {
        $semester = Semester::findOrFail($id);

        // Lấy danh sách các môn đã đăng ký (nếu có) từ bảng pivot.
        $selectedCourses = $semester->courses->pluck('course_id')->toArray();

        // Lấy danh sách các môn tự chọn
        $electiveCourses = CourseMajor::where('is_elective', true)
            ->with('course')
            ->get()
            ->unique('course_id');

        // Lấy các môn không tự chọn với recommended_semester là chẵn
        $evenNonElectiveCourses = CourseMajor::where('is_elective', false)
            ->whereIn('recommended_semester', [2, 4, 6, 8])
            ->with('course')
            ->get()
            ->unique('course_id');

        // Lấy các môn không tự chọn với recommended_semester là lẻ
        $oddNonElectiveCourses = CourseMajor::where('is_elective', false)
            ->whereIn('recommended_semester', [1, 3, 5, 7])
            ->with('course')
            ->get()
            ->unique('course_id');

        return view('admin.registration.courses', compact(
            'semester',
            'electiveCourses',
            'evenNonElectiveCourses',
            'oddNonElectiveCourses',
            'selectedCourses'
        ));
    }

    public function storeRegistrationCourses(Request $request, $id)
    {
        $semester = Semester::findOrFail($id);
        $selectedCourses = $request->input('selected_courses', []); // mảng course_id

        // Kiểm tra nếu học kỳ chưa bắt đầu
        if (now()->lt($semester->start_date)) {
            $semester->registration_status = 'open';
            $semester->save();
        }
        // else {
        //     return redirect()->back()->with('error', 'Học kỳ này đã bắt đầu, không thể mở đăng ký.');
        // }

        // Cập nhật danh sách các môn được chọn cho học kỳ bằng sync,
        // sync sẽ tự động thêm các môn mới và xóa những môn bị bỏ chọn.
        $semester->courses()->sync($selectedCourses);

        return redirect()->route('admin.registration.index')
            ->with('success', 'Đã lưu và cập nhật các môn đăng ký cho học kỳ: ' . $semester->semester_id);
    }

    public function getRegistrationCourses($id)
    {
        $semester = Semester::with('courses')->findOrFail($id);
        $registrationCourses = $semester->courses; // Đây là Collection chứa các đối tượng Course

        return view('admin.registration.index', compact('semester', 'registrationCourses'));
    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckLecturer;
use App\Http\Middleware\CheckStudent;
// use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Staff\RegistrationController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\LecturerController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Staff\SemesterController;
use App\Http\Controllers\Staff\HandleCourseController;
use App\Http\Controllers\Staff\ViewStudentController;
use App\Http\Controllers\Lecturer\LecturersController;
use App\Http\Controllers\Student\MainStudentController;
use App\Http\Controllers\Student\CourseRegistrationController;
use App\Http\Middleware\CheckAcademicStaff;
use App\Http\Controllers\Admin\AcademicStaffController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Trang đăng nhập
// Login page
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Xử lý đăng nhập
// Handle login
Route::post('/login', [AuthController::class, 'login'])->name('post.login');

// Xử lý đăng xuất
// Handle logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route thay đổi mật khẩu (ví dụ)
// Route to change password (example)
Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change.password');

// Route cho Admin (sử dụng middleware trực tiếp)
// Route for Admin (using middleware directly)
// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(CheckAdmin::class);

// Nhóm route cho Admin với middleware (có thể sử dụng trực tiếp nếu chưa đăng ký trong Kernel)
// Group of routes for Admin with middleware (can be used directly if not registered in Kernel)
Route::prefix('admin')->middleware(CheckAdmin::class)->group(function () {
    // Dashboard Admin
    // Admin Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Quản lý Sinh viên
    // Student management
    Route::resource('ad_student', StudentController::class);

    // Quản lý Giảng viên
    // Lecturer management
    Route::resource('ad_lecturer', LecturerController::class);
    Route::get('ad_lecturer/{lecturer}/courses', [LecturerController::class, 'courses'])->name('ad_lecturer.courses');

    // Quản lý Nhân viên Giáo vụ
    // Academic Staff management
    Route::resource('staff_management', AcademicStaffController::class);

    // Quản lý Môn học
    // Course management
    Route::resource('viewcourses', CourseController::class)->only([
        'index',
        'destroy'
    ]);
    ;

    // Thay đổi mật khẩu cho Admin
    // Change password for Admin
    Route::get('/change-password', function () {
        return view('admin.change_password');
    })->name('admin.change_password');
});

Route::prefix('academicstaff')->middleware(CheckAcademicStaff::class)->group(function () {
    // Dashboard Nhân viên Giáo vụ
    // Academic Staff Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\Staff\DashboardController::class, 'index'])
    ->name('academic_staff.dashboard');

    // Quản lý Sinh viên
    // View student management
    Route::resource('staff_viewstudents', ViewStudentController::class)->only([
        'index'
    ]);

    // Xem danh sách các môn học mà sinh viên đã học
    // View the list of courses a student has attended
    Route::get('staff_viewstudents/{id}/courses', [ViewStudentController::class, 'showCourses'])
        ->name('staff.students.courses');

    // Route xem danh sách các môn mới đăng ký (từ bảng student_registrations)
    // Route to view list of newly registered courses (from student_registrations table)
    Route::get('staff_viewstudents/{id}/registrations', [ViewStudentController::class, 'showRegistrations'])
        ->name('staff.students.registrations');

    // Xóa đăng ký môn học của sinh viên
    // Delete student's course registration
    Route::delete('staff_viewstudents/registrations/{registration}', [ViewStudentController::class, 'destroyRegistration'])
        ->name('staff.students.registrations.destroy');

    // Quản lý mở đợt đăng ký
    // Manage opening registration period
    Route::get('/registration', [RegistrationController::class, 'index'])->name('academic_staff.registration.index');
    Route::post('/registration/open/{id}', [RegistrationController::class, 'openRegistration'])->name('academic_staff.registration.open');
    Route::get('/registration/courses/{id}', [RegistrationController::class, 'showRegistrationCourses'])->name('academic_staff.registration.courses');
    Route::post('/registration/courses/{id}', [RegistrationController::class, 'storeRegistrationCourses'])->name('academic_staff.registration.storeCourses');

    // Quản lý Môn học
    // Course management
    Route::resource('staff_courses', HandleCourseController::class);

    // Quản lý Học kỳ
    // Semester management
    Route::resource('semesters', SemesterController::class);

    // Thay đổi mật khẩu cho Nhân viên Giáo vụ
    // Change password for Academic Staff
    Route::get('/change-password', function () {
        return view('academic_staff.change_password');
    })->name('academic_staff.change_password');
});

// Route cho Lecturer
// Route for Lecturer
Route::prefix('lecturer')->middleware(CheckLecturer::class)->group(function () {
    // Hiển thị thời khóa biểu của giảng viên
    // Display the lecturer's schedule
    Route::get('/schedule', [LecturersController::class, 'schedule'])
        ->name('lecturer.schedule');

    // Hiển thị danh sách đăng ký của một môn học
    // Display the list of registrations for a course
    Route::get('/lec_courses/{course_id}/registrations', [LecturersController::class, 'courseRegistrations'])
        ->name('lecturer.courses.registrations');

    // Thay đổi mật khẩu cho giảng viên
    // Change password for Lecturer
    Route::get('/change-password', function () {
        return view('lecturer.change_password');
    })->name('lecturer.change_password');
});

// Route cho Student
// Route for Student
Route::prefix('student')->middleware(CheckStudent::class)->group(function () {
    // Trang Dashboard cho Sinh viên
    // Dashboard page for Student
    Route::get('/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');

    // Trang đổi mật khẩu cho sinh viên
    // Change password page for Student
    Route::get('/change-password', function () {
        return view('student.change_password');
    })->name('student.change_password');

    // Các route khác của sinh viên có thể được thêm vào đây
    // Other routes for student can be added here
    Route::get('/past-courses', [MainStudentController::class, 'showPastCourses'])->name('student.past_courses');

    Route::get('/curriculum', [MainStudentController::class, 'showCurriculum'])->name('student.curriculum');

    // Trang đăng ký môn học
    // Course registration page
    Route::get('/course-registration', [CourseRegistrationController::class, 'index'])->name('student.course_registration.index');
    Route::post('/course-registration/register', [CourseRegistrationController::class, 'register'])->name('student.course_registration.register');
    Route::delete('/course-registration/{courseId}', [CourseRegistrationController::class, 'deleteRegistration'])->name('student.course_registration.delete');

    // Lưu sở thích của sinh viên
    // Save student's preferences
    Route::post('/course-registration/preferences', [CourseRegistrationController::class, 'storePreferences'])->name('student.course_registration.preferences');

    // Xem thời khóa biểu
    // View schedule
    Route::get('/schedule', [CourseRegistrationController::class, 'showSchedule'])->name('student.schedule');
});

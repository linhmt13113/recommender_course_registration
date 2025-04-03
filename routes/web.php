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
use App\Http\Controllers\Lecturer\LecturersController;
use App\Http\Controllers\Student\MainStudentController;
use App\Http\Controllers\Student\CourseRegistrationController;
use App\Http\Middleware\CheckAcademicStaff;
use App\Http\Controllers\Admin\AcademicStaffController;

Route::get('/', function () {
    return view('welcome');
});

// Trang đăng nhập
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Xử lý đăng nhập
Route::post('/login', [AuthController::class, 'login'])->name('post.login');

// Xử lý đăng xuất
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route thay đổi mật khẩu (ví dụ)
Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change.password');

// Route cho Admin (sử dụng middleware trực tiếp)
// Route::get('/qly/dashboard', function () {
//     return view('admin.dashboard');
// })->middleware(CheckAdmin::class);

// Nhóm route cho Admin với middleware (có thể sử dụng trực tiếp nếu chưa đăng ký trong Kernel)
Route::prefix('qly')->middleware(CheckAdmin::class)->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Route quản lý mở đợt đăng ký
    // Route::get('/registration', [RegistrationController::class, 'index'])->name('admin.registration.index');
    // Route::post('/registration/open/{id}', [RegistrationController::class, 'openRegistration'])->name('admin.registration.open');
    // Route::get('/registration/courses/{id}', [RegistrationController::class, 'showRegistrationCourses'])->name('admin.registration.courses');
    // Route::post('/registration/courses/{id}', [RegistrationController::class, 'storeRegistrationCourses'])->name('admin.registration.storeCourses');

    // Quản lý Sinh viên
    Route::resource('sinhvien', StudentController::class);
    // Xem danh sách các môn học mà sinh viên đã học
    Route::get('sinhvien/{id}/courses', [StudentController::class, 'showCourses'])
        ->name('admin.students.courses');
    // Route xem danh sách các môn mới đăng ký (từ bảng student_registrations)
    Route::get('sinhvien/{id}/registrations', [StudentController::class, 'showRegistrations'])
        ->name('admin.students.registrations');

    Route::delete('sinhvien/registrations/{registration}', [StudentController::class, 'destroyRegistration'])
        ->name('admin.students.registrations.destroy');

    // Quản lý Giảng viên
    Route::resource('giangvien', LecturerController::class);
    Route::get('giangvien/{lecturer}/courses', [LecturerController::class, 'courses'])->name('giangvien.courses');


    Route::resource('staff_management', AcademicStaffController::class);
    // Quản lý Môn học
    Route::resource('viewmonhoc', CourseController::class)->only([
        'index', 'destroy'
    ]);;

    // Quản lý Học kỳ
    // Route::resource('hocki', SemesterController::class);

    Route::get('/change-password', function () {
        return view('admin.change_password');
    })->name('admin.change_password');
});

Route::prefix('giaovu')->middleware(CheckAcademicStaff::class)->group(function () {
    // Dashboard Nhân viên Giáo vụ
    Route::get('/dashboard', function () {
        return view('academic_staff.dashboard');
    })->name('academic_staff.dashboard');

    // Quản lý mở đợt đăng ký
    Route::get('/registration', [RegistrationController::class, 'index'])->name('academic_staff.registration.index');
    Route::post('/registration/open/{id}', [RegistrationController::class, 'openRegistration'])->name('academic_staff.registration.open');
    Route::get('/registration/courses/{id}', [RegistrationController::class, 'showRegistrationCourses'])->name('academic_staff.registration.courses');
    Route::post('/registration/courses/{id}', [RegistrationController::class, 'storeRegistrationCourses'])->name('academic_staff.registration.storeCourses');

    // Quản lý Môn học
    Route::resource('monhoc', HandleCourseController::class);

    // Quản lý Học kỳ
    Route::resource('hocki', SemesterController::class);

    Route::get('/change-password', function () {
        return view('academic_staff.change_password');
    })->name('academic_staff.change_password');
});



// Route cho Lecturer
Route::prefix('gvien')->middleware(CheckLecturer::class)->group(function () {
    // Route hiển thị thời khóa biểu của giảng viên
    Route::get('/lichday', [LecturersController::class, 'schedule'])
        ->name('lecturer.schedule');

    // Route hiển thị danh sách đăng ký của một môn học
    Route::get('/monhoc/{course_id}/dangky', [LecturersController::class, 'courseRegistrations'])
        ->name('lecturer.courses.registrations');

    Route::get('/change-password', function () {
        return view('lecturer.change_password');
    })->name('lecturer.change_password');
});

// Route cho Student
Route::prefix('svien')->middleware(CheckStudent::class)->group(function () {
    Route::get('/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');

    // Route hiển thị view đổi mật khẩu cho sinh viên
    Route::get('/change-password', function () {
        return view('student.change_password');
    })->name('student.change_password');

    // Các route khác của sinh viên có thể được thêm vào đây
    Route::get('/past-courses', [MainStudentController::class, 'showPastCourses'])->name('student.past_courses');

    Route::get('/curriculum', [MainStudentController::class, 'showCurriculum'])->name('student.curriculum');


    // Trang đăng ký môn học
    Route::get('/course-registration', [CourseRegistrationController::class, 'index'])->name('student.course_registration.index');
    Route::post('/course-registration/register', [CourseRegistrationController::class, 'register'])->name('student.course_registration.register');
    Route::delete('/course-registration/{courseId}', [CourseRegistrationController::class, 'deleteRegistration'])->name('student.course_registration.delete');

    // Lưu sở thích của sinh viên
    Route::post('/course-registration/preferences', [CourseRegistrationController::class, 'storePreferences'])->name('student.course_registration.preferences');

    // Xem thời khóa biểu
    Route::get('/schedule', [CourseRegistrationController::class, 'showSchedule'])->name('student.schedule');
});

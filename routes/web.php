<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckLecturer;
use App\Http\Middleware\CheckStudent;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\LecturerController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Lecturer\LecturersController;

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
    });

    // Route quản lý mở đợt đăng ký
    Route::get('/registration', [RegistrationController::class, 'index'])->name('admin.registration.index');
    Route::post('/registration/open/{id}', [RegistrationController::class, 'openRegistration'])->name('admin.registration.open');
    Route::get('/registration/courses/{id}', [RegistrationController::class, 'showRegistrationCourses'])->name('admin.registration.courses');
    Route::post('/registration/courses/{id}', [RegistrationController::class, 'storeRegistrationCourses'])->name('admin.registration.storeCourses');

    // Quản lý Sinh viên
    Route::resource('sinhvien', StudentController::class);
    // Xem danh sách các môn học mà sinh viên đã học
    Route::get('sinhvien/{id}/courses', [StudentController::class, 'showCourses'])
        ->name('admin.students.courses');
    // Route xem danh sách các môn mới đăng ký (từ bảng student_registrations)
    Route::get('sinhvien/{id}/registrations', [StudentController::class, 'showRegistrations'])
        ->name('admin.students.registrations');

    // Quản lý Giảng viên
    Route::resource('giangvien', LecturerController::class);
    Route::get('giangvien/{lecturer}/courses', [LecturerController::class, 'courses'])->name('giangvien.courses');


    // Quản lý Môn học
    Route::resource('monhoc', CourseController::class);

    // Quản lý Học kỳ
    Route::resource('hocki', SemesterController::class);
});


// Route cho Lecturer
Route::prefix('gvien')->middleware(CheckLecturer::class)->group(function () {
    // Route hiển thị thời khóa biểu của giảng viên
    Route::get('/lichday', [LecturersController::class, 'schedule'])
         ->name('lecturer.schedule');

    // Route hiển thị danh sách đăng ký của một môn học
    Route::get('/monhoc/{course_id}/dangky', [LecturersController::class, 'courseRegistrations'])
         ->name('lecturer.courses.registrations');
});

// Route cho Student
Route::get('/svien/dashboard', function () {
    return view('student.dashboard');
})->middleware(CheckStudent::class);

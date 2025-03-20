<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckLecturer;
use App\Http\Middleware\CheckStudent;

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
Route::get('/qly/dashboard', function () {
    return view('admin.dashboard');
})->middleware(CheckAdmin::class);

// Route cho Lecturer
Route::get('/gvien/lichday', function () {
    return view('lecturer.schedule');
})->middleware(CheckLecturer::class);

// Route cho Student
Route::get('/svien/dashboard', function () {
    return view('student.dashboard');
})->middleware(CheckStudent::class);

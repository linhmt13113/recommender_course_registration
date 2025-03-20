<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'lecturer_id',    // Mã giảng viên tự tạo
        'lecturer_name',
        'email',
        'phone',
        'password'
    ];

    // Quan hệ: Một giảng viên có thể dạy nhiều môn học
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    // Quan hệ: Một giảng viên có thể dạy nhiều môn học thông qua bảng lecturer_courses (nếu cần thiết)
    public function lecturerCourses()
    {
        return $this->belongsToMany(Course::class, 'lecturer_courses');
    }
}

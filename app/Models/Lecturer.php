<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory;

    protected $primaryKey = 'lecturer_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'lecturer_id',    // Mã giảng viên tự tạo
        'lecturer_name',
        'password'
    ];

    // Quan hệ: Một giảng viên có thể dạy nhiều môn học
    public function courses()
    {

        return $this->hasMany(Course::class, 'lecturer_id', 'lecturer_id');
    }

    // Quan hệ: Một giảng viên có thể dạy nhiều môn học thông qua bảng lecturer_courses (nếu cần thiết)
    public function lecturerCourses()
    {
        return $this->belongsToMany(Course::class, 'lecturer_courses');
        // Chỉ định các cột khóa ngoại nếu cần thiết (ở đây mặc định lecturer_id, course_id)
        // return $this->belongsToMany(Course::class, 'lecturer_courses', 'lecturer_id', 'course_id');
    }
}

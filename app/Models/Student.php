<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'student_id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Các trường có thể gán giá trị mass assignable
    protected $fillable = [
        'student_id',     // Mã sinh viên tự tạo
        'student_name',
        'major_id',
        'password'
    ];

    // Quan hệ: Một sinh viên thuộc về một chuyên ngành
    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id', 'major_id');
    }

    // Quan hệ: Một sinh viên có thể đăng ký nhiều môn học (qua bảng pivot student_courses)
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_courses', 'student_id', 'course_id');
    }

    // Quan hệ: Một sinh viên có thể có nhiều thời khóa biểu (qua bảng pivot student_schedules)
    public function schedules()
    {
        return $this->belongsToMany(Schedule::class, 'student_schedules');
    }
}

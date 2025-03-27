<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'day_of_week',    // 1: Thứ 2, 2: Thứ 3, ...
        'start_time',
        'end_time'
    ];

    // Quan hệ: Lấy môn học của lịch học
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }

    // Quan hệ: Lấy các sinh viên có lịch học này (qua student_schedules)
    // public function students()
    // {
    //     return $this->belongsToMany(Student::class, 'student_schedules');
    // }
}

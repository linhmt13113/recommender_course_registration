<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    //
    protected $table = 'student_courses';

    protected $fillable = [
        'student_id',
        'course_id',
        'semester',
        'status',
    ];

    // Quan hệ với Student (nếu cần)
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    // Quan hệ với Course (nếu cần)
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }
}

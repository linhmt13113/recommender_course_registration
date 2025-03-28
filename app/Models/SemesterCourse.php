<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SemesterCourse extends Model
{
    //
    protected $table = 'semester_courses';

    protected $fillable = [
        'semester_id', // cái này nó là khóa ngoại (foreign key)
                       // dùng để liên kết đến bảng semesters có id(khóa chính) là 1
        'course_id',
    ];

    public function course()
    {
        return $this->belongsTo(\App\Models\Course::class, 'course_id', 'course_id');
    }
}

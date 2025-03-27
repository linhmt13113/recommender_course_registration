<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SemesterCourse extends Model
{
    //
    protected $table = 'semester_courses';

    protected $fillable = [
        'semester_id',
        'course_id',
    ];

    public function course()
    {
        return $this->belongsTo(\App\Models\Course::class, 'course_id', 'course_id');
    }
}

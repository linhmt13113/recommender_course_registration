<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseMajor extends Model
{
    //
    protected $table = 'course_major';

    protected $fillable = [
        'course_id',
        'major_id',
        'is_elective',
        'recommended_semester',
    ];

    protected $casts = [
        'recommended_semester' => 'integer',
    ];

    // Quan hệ với Course (nếu cần)
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }

    // Quan hệ với Major (nếu cần)
    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id', 'major_id');
    }
}

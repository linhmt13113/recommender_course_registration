<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = [
        'semester_id',
        'start_date',
        'end_date',
        'registration_status',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'semester_courses', 'semester_id', 'course_id')->withTimestamps();
    }
}

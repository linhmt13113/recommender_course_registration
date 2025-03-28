<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRegistration extends Model
{
    //
    use HasFactory;

    protected $table = 'student_registrations';

    protected $fillable = [
        'student_id',
        'course_id',
        'status',
        'semester',
    ];

    /**
     * Quan hệ: Một đăng ký thuộc về một sinh viên.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'student_id');
    }

    /**
     * Quan hệ: Một đăng ký thuộc về một môn học.
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }
}

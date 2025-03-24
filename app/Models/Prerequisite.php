<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prerequisite extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',              // Môn học hiện tại
        'prerequisite_course_id', // Môn học yêu cầu trước
        'major_id',               // Chuyên ngành áp dụng
        'prerequisite_type'       // Loại yêu cầu: Required, Optional, Previous
    ];

    // Quan hệ: Lấy môn học hiện tại
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }

    // Quan hệ: Lấy môn học yêu cầu (prerequisite)
    public function prerequisiteCourse()
    {
        return $this->belongsTo(Course::class, 'prerequisite_course_id', 'course_id');
    }

    // Quan hệ: Lấy chuyên ngành áp dụng
    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id', 'major_id');
    }
}

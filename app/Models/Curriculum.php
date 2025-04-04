<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $fillable = [
        'curriculum_id',  // Mã chương trình học tự tạo
        'major_id',
        'semester',
        'course_id',
        'is_mandatory',
    ];

    // Quan hệ: Một curriculum thuộc về một chuyên ngành
    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id', 'major_id');
    }

    // Quan hệ: Một curriculum chứa một môn học
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'course_id');
    }
}

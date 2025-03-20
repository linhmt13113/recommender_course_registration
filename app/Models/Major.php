<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;

    protected $fillable = [
        'major_id',    // Mã chuyên ngành tự tạo
        'major_name',
    ];

    // Quan hệ: Một chuyên ngành có nhiều sinh viên
    public function students()
    {
        return $this->hasMany(Student::class);
    }

    // Quan hệ: Một chuyên ngành có nhiều khóa chương trình đào tạo (curriculum)
    public function curriculums()
    {
        return $this->hasMany(Curriculum::class);
    }

    // Quan hệ: Một chuyên ngành có nhiều môn học thông qua bảng trung gian course_major
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_major')->withPivot('is_elective');
    }
}

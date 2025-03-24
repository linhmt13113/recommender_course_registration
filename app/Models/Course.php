<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $primaryKey = 'course_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'course_id',           // Mã môn học tự tạo
        'course_name',
        'course_description',
        'lecturer_id'          // Giảng viên dạy môn học (có thể null)
    ];

    // Quan hệ: Một môn học thuộc về nhiều chuyên ngành thông qua bảng course_major
    public function majors()
    {
        return $this->belongsToMany(Major::class, 'course_major')->withPivot('is_elective');
    }

    // Quan hệ: Một môn học có thể có nhiều sinh viên đăng ký (qua student_courses)
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_courses');
    }

    // Quan hệ: Một môn học được dạy bởi một giảng viên
    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'lecturer_id', 'lecturer_id');
    }

    // Quan hệ: Một môn học có thể xuất hiện trong nhiều chương trình đào tạo (curriculum)
    public function curriculums()
    {
        return $this->hasMany(Curriculum::class, 'course_id', 'course_id');
    }

    // Quan hệ: Một môn học có thể có nhiều yêu cầu tiên quyết (prerequisites)
    public function prerequisites()
    {
        return $this->hasMany(Prerequisite::class, 'course_id');
    }

    // Quan hệ: Một môn học có thể là prerequisite của nhiều môn học khác
    public function isPrerequisiteFor()
    {
        return $this->hasMany(Prerequisite::class, 'prerequisite_course_id');
    }

    // Quan hệ: Một môn học có thể có nhiều lịch học
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}

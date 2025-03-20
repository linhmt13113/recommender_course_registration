<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\Major;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $major = Major::create([
            'major_id' => 'CS01',
            'major_name' => 'Công Nghệ Thông Tin',
        ]);

        Admin::create([
            'admin_id'   => 'AD' . time(),
            'admin_name' => 'Quản trị viên',
            'email'      => 'admin@example.com',
            'password'   => Hash::make('admin123'), // mật khẩu mặc định
        ]);

        Lecturer::create([
            'lecturer_id'   => 'GV' . time(),
            'lecturer_name' => 'Giảng viên 1',
            'password'      => Hash::make('lecturer123'),
        ]);

        Student::create([
            'student_id'   => 'SV' . time(),
            'student_name' => 'Sinh viên 1',
            'major_id'     => $major->id,
            'password'     => Hash::make('student123'),

        ]);
    }
}

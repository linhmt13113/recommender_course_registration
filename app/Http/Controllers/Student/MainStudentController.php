<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentCourse;
use App\Models\CourseMajor;
use App\Models\Student;
use Illuminate\Support\Collection;

class MainStudentController extends Controller
{
    //
    public function showPastCourses()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors('Vui lòng đăng nhập lại.');
        }
        $studentId = $user->student_id;
        $courses = StudentCourse::with('course')
            ->where('student_id', $studentId)
            ->orderBy('semester', 'asc')
            ->get();

        // Trả về view với dữ liệu các môn học đã học
        return view('student.past_courses', compact('courses'));
    }

    public function showCurriculum()
    {
        $user = session('user');
        if (!$user) {
            return redirect()->route('login')->withErrors('Vui lòng đăng nhập lại.');
        }
        $student = Student::with('major')->find($user->student_id);
        $curriculum = CourseMajor::with('course')
            ->where('major_id', $student->major->major_id)
            ->orderBy('recommended_semester', 'asc')
            ->get();


        // Chuyển $curriculum thành mảng
    $curriculumArr = $curriculum->toArray();

    // Loại bỏ các môn tự chọn (is_elective == 1) từ dữ liệu gốc
    $curriculumArr = array_filter($curriculumArr, function($item) {
        return $item['is_elective'] != 1;
    });

    // Tạo các dòng "Elective mặc định" cho học kỳ 5,6,7,8 dưới dạng mảng
    $defaultElectivesArr = [];
    foreach ([5, 6, 7, 8] as $semester) {
        $defaultElectivesArr[] = [
            'course' => [
                'course_id'   => 'ELEC' ,
                'course_name' => 'Elective  ' ,
            ],
            'is_elective' => 1,
            'recommended_semester' => $semester,
        ];
    }

    // Gộp mảng và sắp xếp theo recommended_semester
    $mergedCurriculum = collect(array_merge($curriculumArr, $defaultElectivesArr))
        ->sortBy('recommended_semester');

        return view('student.curriculum', compact('curriculum', 'mergedCurriculum', 'student'));
    }
}

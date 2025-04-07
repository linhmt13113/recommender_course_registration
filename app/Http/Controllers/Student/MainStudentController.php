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
        $curriculumArr = array_filter($curriculumArr, function ($item) {
            return $item['is_elective'] != 1;
        });

        // Tùy chỉnh default electives dựa trên ngành học
        $defaultElectivesArr = [];
        $majorId = $student->major->major_id;
        switch ($majorId) {
            case 'CS01':
                // CS01: 4 môn tự chọn, học kỳ: 4, 5, 5, 6
                $defaultElectivesArr = [
                    [
                        'course' => [
                            'course_id' => 'ELEC',
                            'course_name' => 'Elective',
                        ],
                        'is_elective' => 1,
                        'recommended_semester' => 4,
                    ],
                    [
                        'course' => [
                            'course_id' => 'ELEC',
                            'course_name' => 'Elective',
                        ],
                        'is_elective' => 1,
                        'recommended_semester' => 5,
                    ],
                    [
                        'course' => [
                            'course_id' => 'ELEC',
                            'course_name' => 'Elective',
                        ],
                        'is_elective' => 1,
                        'recommended_semester' => 5,
                    ],
                    [
                        'course' => [
                            'course_id' => 'ELEC',
                            'course_name' => 'Elective',
                        ],
                        'is_elective' => 1,
                        'recommended_semester' => 6,
                    ],
                ];
                break;
            case 'CE01':
                // CE01: 2 môn tự chọn, học kỳ: 6, 7
                $defaultElectivesArr = [
                    [
                        'course' => [
                            'course_id' => 'ELEC',
                            'course_name' => 'Elective',
                        ],
                        'is_elective' => 1,
                        'recommended_semester' => 6,
                    ],
                    [
                        'course' => [
                            'course_id' => 'ELEC',
                            'course_name' => 'Elective',
                        ],
                        'is_elective' => 1,
                        'recommended_semester' => 7,
                    ],
                ];
                break;
            case 'DS01':
                // DS01: 4 môn tự chọn, học kỳ: 6, 7, 6, 7
                $defaultElectivesArr = [
                    [
                        'course' => [
                            'course_id' => 'ELEC',
                            'course_name' => 'Elective',
                        ],
                        'is_elective' => 1,
                        'recommended_semester' => 6,
                    ],
                    [
                        'course' => [
                            'course_id' => 'ELEC',
                            'course_name' => 'Elective',
                        ],
                        'is_elective' => 1,
                        'recommended_semester' => 7,
                    ],
                    [
                        'course' => [
                            'course_id' => 'ELEC',
                            'course_name' => 'Elective',
                        ],
                        'is_elective' => 1,
                        'recommended_semester' => 6,
                    ],
                    [
                        'course' => [
                            'course_id' => 'ELEC',
                            'course_name' => 'Elective',
                        ],
                        'is_elective' => 1,
                        'recommended_semester' => 7,
                    ],
                ];
                break;
            default:
                // Fallback: nếu không thuộc các ngành đã định, sử dụng học kỳ 8, 9, 10, 11
                foreach ([8, 9, 10, 11] as $semester) {
                    $defaultElectivesArr[] = [
                        'course' => [
                            'course_id' => 'ELEC',
                            'course_name' => 'Elective',
                        ],
                        'is_elective' => 1,
                        'recommended_semester' => $semester,
                    ];
                }
                break;
        }

        // Gộp mảng và sắp xếp theo recommended_semester
        $mergedCurriculum = collect(array_merge($curriculumArr, $defaultElectivesArr))
            ->sortBy('recommended_semester');

        return view('student.curriculum', compact('curriculum', 'mergedCurriculum', 'student'))->with('student', $student);
    }

}

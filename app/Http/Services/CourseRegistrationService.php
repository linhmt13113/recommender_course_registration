<?php

namespace App\Http\Services;

use App\Models\Student;
use App\Models\CourseMajor;
use App\Models\SemesterCourse;
use App\Models\StudentCourse;
use App\Models\Prerequisite;
use App\Models\StudentRegistration;

class CourseRegistrationService
{
    /**
     * Lấy danh sách các môn học mở đăng ký của học kỳ hiện tại theo chuyên ngành của sinh viên.
     *
     * Get the list of available courses for the current semester based on the student's major.
     */
    public function getAvailableCourses(Student $student)
    {
        $majorId = $student->major->major_id;

        // Lấy các semesterCourse mà course thuộc về chuyên ngành của sinh viên.
        // Get the SemesterCourses where the course belongs to the student's major.
        $availableCourses = SemesterCourse::with('course')
            ->whereHas('course', function ($query) use ($majorId) {
                $query->whereHas('course_major', function ($q) use ($majorId) {
                    $q->where('major_id', $majorId);
                });
            })->get();

        return $availableCourses;
    }

    /**
     * Lấy danh sách các môn mà sinh viên đã đăng ký.
     *
     * Get the list of courses that the student has already registered for.
     */
    public function getRegisteredCourses(Student $student)
    {
        return StudentRegistration::with('course')
            ->where('student_id', $student->student_id)
            ->get();
    }

    /**
     * Xác định học kỳ hiện tại của sinh viên dựa trên những môn đã đăng ký.
     * Nếu chưa có môn đăng ký nào thì trả về 1.
     *
     * Determine the student's current semester based on the registered courses.
     * If no courses are registered, return 1.
     */
    public function getCurrentSemester(Student $student)
    {
        $maxSemester = StudentCourse::where('student_id', $student->student_id)->max('semester');
        return $maxSemester ? $maxSemester : 0;
    }

    /**
     * Lấy danh sách các môn bắt buộc của học kỳ tiếp theo (recommended_semester = currentSemester + 1)
     * và chỉ lấy những môn đang mở đăng ký (có trong semesterCourse).
     *
     * Get the list of required courses for the next semester (recommended_semester = currentSemester + 1)
     * and only those that are open for registration (available in SemesterCourse).
     */
    public function getRequiredCoursesForNextSemester(Student $student)
    {
        $majorId = $student->major->major_id;
        $currentSemester = $this->getCurrentSemester($student);
        $nextSemester = $currentSemester + 1;

        $requiredCourses = CourseMajor::with('course')
            ->where('major_id', $majorId)
            ->where('is_elective', 0)
            ->where('recommended_semester', $nextSemester)
            ->whereHas('course', function ($query) {
                $query->whereHas('semesters'); // kiểm tra môn đó có mở đăng ký hay không
                // check if the course is open for registration
            })
            ->get();

        return $requiredCourses;
    }

    /**
     * Lấy danh sách các môn tự chọn mà sinh viên chưa hoàn thành.
     *
     * Get the list of elective courses that the student has not completed yet.
     */
    public function getElectiveCourses(Student $student)
    {
        $majorId = $student->major->major_id;
        $electiveCourses = CourseMajor::with('course')
            ->where('major_id', $majorId)
            ->where('is_elective', 1)
            ->get()
            ->filter(function ($courseMajor) use ($student) {
                $completed = StudentCourse::where('student_id', $student->student_id)
                    ->where('course_id', $courseMajor->course_id)
                    ->where('status', '1')
                    ->exists();
                return !$completed;
            });

        return $electiveCourses;
    }

    /**
     * Kiểm tra điều kiện prerequisite cho một môn học.
     * Nếu có điều kiện chưa thỏa mãn thì trả về thông báo lỗi,
     * ngược lại trả về null.
     *
     * Check the prerequisite conditions for a course.
     * If any conditions are not met, return an error message,
     * otherwise return null.
     */
    public function checkPrerequisites(Student $student, $courseId)
    {
        // Lấy tất cả các prerequisite áp dụng cho chuyên ngành của sinh viên
        // Get all the prerequisites for the course based on the student's major
        $prerequisites = Prerequisite::where('course_id', $courseId)
            ->where('major_id', $student->major->major_id)
            ->get();

        foreach ($prerequisites as $prereq) {
            if ($prereq->prerequisite_type === 'Previous') {
                $hasPrereq = StudentCourse::where('student_id', $student->student_id)
                ->where('course_id', $prereq->prerequisite_course_id)
                ->exists();
            } else {
                $hasPrereq = StudentCourse::where('student_id', $student->student_id)
                ->where('course_id', $prereq->prerequisite_course_id)
                ->where('status', 1)
                ->exists();
            }
            if (!$hasPrereq) {
                return 'You have not completed the course ' . $prereq->prerequisiteCourse->course_name . '. Please register and complete this course first.';
                // Bạn chưa hoàn thành môn ' . $prereq->prerequisiteCourse->course_name . '. Vui lòng đăng ký và hoàn thành môn này trước.
            }
        }
        return null;
    }

    /**
     * Kiểm tra xem trong danh sách các môn bắt buộc (trong student_courses) có môn nào chưa hoàn thành
     * và đang mở đăng ký hay không.
     * Nếu có thì trả về danh sách các thông báo ưu tiên.
     *
     * Check if there are any required courses (in student_courses) that have not been completed
     * and are open for registration.
     * If so, return a list of priority messages.
     */
    public function getPriorityRequiredCourses(Student $student)
    {
        $priorityCourses = [];
        // Lấy các môn đăng ký của sinh viên có trạng thái chưa hoàn thành và là bắt buộc (is_elective = 0)
        // Get the student's registered courses that are not completed and are required (is_elective = 0)
        $registeredRequired = StudentCourse::where('student_id', $student->student_id)
            ->where('status', 0)
            ->get()
            ->filter(function ($sc) use ($student) {
                return CourseMajor::where('course_id', $sc->course_id)
                        ->where('major_id', $student->major->major_id)
                        ->where('is_elective', 0)
                        ->exists();
            });

        foreach ($registeredRequired as $reg) {
            // Kiểm tra nếu môn đó đang mở đăng ký
            // Check if the course is open for registration
            $open = SemesterCourse::where('course_id', $reg->course_id)->exists();
            if ($open) {
                $priorityCourses[] = 'The course ' . $reg->course->course_name . ' has not been completed. Please prioritize registering again if needed.';
                // Môn ' . $reg->course->course_name . ' chưa hoàn thành, vui lòng ưu tiên đăng ký lại nếu cần.
            }
        }
        return $priorityCourses;
    }
}

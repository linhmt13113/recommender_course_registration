@extends('student.dashboard')

@section('content')
    <h1>Thời khóa biểu</h1>
    <h1>Thời khóa biểu của sinh viên: {{ $student->student_name }}</h1>

    @php
        $days = [
            '1' => 'Monday',
            '2' => 'Tuesday',
            '3' => 'Wednesday',
            '4' => 'Thursday',
            '5' => 'Friday',
            '6' => 'Saturday',
            '7' => 'Sunday',
        ];
    @endphp

    @if($student->registrations->isEmpty())
        <p>Chưa có đăng ký môn học nào.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã môn</th>
                    <th>Tên môn</th>
                    <th>Lịch học</th>
                </tr>
            </thead>
            <tbody>
                @foreach($student->registrations as $registration)
                    @php
                        $course = optional($registration->course);
                        // Lấy lịch học đầu tiên của môn, hoặc bạn có thể lặp qua tất cả nếu cần
                        $schedule = $course->schedules->first();
                    @endphp
                    <tr>
                        <td>{{ optional($course)->course_id }}</td>
                        <td>{{ optional($course)->course_name }}</td>
                        <td>
                            @if($schedule)
                            {{ $days[$schedule->day_of_week] ?? $schedule->day_of_week }}: {{ $schedule->start_time }} - {{ $schedule->end_time }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection

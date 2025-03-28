<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thời khóa biểu giảng viên</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container mt-4">
    <h1>Thời khóa biểu giảng viên: {{ session('user')->lecturer_name ?? session('user')->lecturer_id }}</h1>
    @if($activeSemester)
        <h3>Kỳ học hiện hành: {{ $activeSemester->semester_id }}</h3>
    @else
        <p>Không có kỳ học hiện hành.</p>
    @endif

    @if($courses->isNotEmpty())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã môn học</th>
                    <th>Tên môn học</th>
                    <th>Lịch học</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{ $course->course_id }}</td>
                        <td>{{ $course->course_name }}</td>
                        <td>
                            @if($course->schedules->isNotEmpty())
                                @foreach($course->schedules as $schedule)
                                    <div>
                                        <strong>Ngày:</strong>
                                        @switch($schedule->day_of_week)
                                            @case(1) Thứ 2 @break
                                            @case(2) Thứ 3 @break
                                            @case(3) Thứ 4 @break
                                            @case(4) Thứ 5 @break
                                            @case(5) Thứ 6 @break
                                            @case(6) Thứ 7 @break
                                            @case(7) Chủ nhật @break
                                            @default Không xác định
                                        @endswitch
                                        <br>
                                        <strong>Bắt đầu:</strong> {{ $schedule->start_time }}<br>
                                        <strong>Kết thúc:</strong> {{ $schedule->end_time }}
                                    </div>
                                @endforeach
                            @else
                                Chưa có lịch học
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('lecturer.courses.registrations', $course->course_id) }}" class="btn btn-info btn-sm">Xem đăng ký</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Không có môn học nào.</p>
    @endif
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Môn học do Giảng viên {{ $lecturer->lecturer_name }} dạy</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container mt-4">
    <h1>Môn học do Giảng viên {{ $lecturer->lecturer_name }} dạy</h1>
    <a href="{{ route('giangvien.index') }}" class="btn btn-secondary mb-3">Trở về danh sách Giảng viên</a>
    @if($courses->isNotEmpty())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã môn học</th>
                    <th>Tên môn học</th>
                    <th>Số tín chỉ</th>
                    <th>Lịch học</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td>{{ $course->course_id }}</td>
                    <td>{{ $course->course_name }}</td>
                    <td>{{ $course->credits }}</td>
                    <td>
                        @if($course->schedules->isNotEmpty())
                            @php $schedule = $course->schedules->first(); @endphp
                            <div><strong>Ngày:</strong>
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
                            </div>
                            <div><strong>Bắt đầu:</strong> {{ $schedule->start_time }}</div>
                            <div><strong>Kết thúc:</strong> {{ $schedule->end_time }}</div>
                        @else
                            Chưa có lịch học
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Giảng viên này hiện chưa dạy môn học nào.</p>
    @endif
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách Môn học</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container mt-4">
    <h1>Quản lý Môn học</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('monhoc.create') }}" class="btn btn-primary mb-3">Thêm Môn học</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã Môn học</th>
                <th>Tên Môn học</th>
                <th>Mô tả Môn học</th>
                <th>Giảng viên</th>
                <th>Thời gian học</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->course_id }}</td>
                <td>{{ $course->course_name }}</td>
                <td>{{ $course->course_description ?? 'Không có mô tả' }}</td>
                <td>{{ $course->lecturer ? $course->lecturer->lecturer_name : 'N/A' }}</td>
                <td>
                    @if($course->schedules->isNotEmpty())
                        @php
                            // Nếu mỗi môn học chỉ có 1 lịch chính, ta hiển thị lịch đầu tiên
                            $schedule = $course->schedules->first();
                        @endphp
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
                        </div>
                        <div><strong>Bắt đầu:</strong> {{ $schedule->start_time }}</div>
                        <div><strong>Kết thúc:</strong> {{ $schedule->end_time }}</div>
                    @else
                        Chưa có lịch học
                    @endif
                </td>
                <td>
                    <a href="{{ route('monhoc.edit', $course->course_id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('monhoc.destroy', $course->course_id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $courses->links() }}
</div>
</body>
</html>

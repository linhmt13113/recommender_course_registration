<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký của môn học {{ $course->course_name }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container mt-4">
    <h1>Danh sách đăng ký cho môn học: {{ $course->course_name }}</h1>
    <a href="{{ route('lecturer.schedule') }}" class="btn btn-secondary mb-3">Trở về thời khóa biểu</a>

    @if($registrations->isNotEmpty())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã SV</th>
                    <th>Tên SV</th>
                    <th>Số tín chỉ (Môn học)</th>
                    <th>Trạng thái</th>
                    <th>Học kỳ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $registration)
                    <tr>
                        <td>{{ $registration->student->student_id }}</td>
                        <td>{{ $registration->student->student_name }}</td>
                        <td>{{ $registration->course->credits }}</td>
                        <td>{{ $registration->status == 1 ? 'Đã hoàn thành' : 'Chưa hoàn thành' }}</td>
                        <td>{{ $registration->semester ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Chưa có sinh viên đăng ký môn học này.</p>
    @endif
</div>
</body>
</html>

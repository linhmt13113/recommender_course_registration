<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Môn học của Sinh viên</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container mt-4">
    <h1>Môn học của Sinh viên: {{ $student->student_name }}</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã môn học</th>
                <th>Tên môn học</th>
                <th>Semester</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($student->courses as $course)
            <tr>
                <td>{{ $course->course_id }}</td>
                <td>{{ $course->course_name }}</td>
                <td>{{ $course->pivot->semester }}</td>
                <td>{{ $course->pivot->status == 1 ? 'Đã học' : 'Chưa hoàn thành'}}</td>
            </tr>
            @empty
            <tr>
                <td colspan="2">Sinh viên chưa đăng ký môn học nào.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{ route('sinhvien.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
</div>
</body>
</html>

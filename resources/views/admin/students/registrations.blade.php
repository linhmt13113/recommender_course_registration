<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký môn học của sinh viên {{ $student->student_name }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container mt-4">
    <h1>Đăng ký môn học của sinh viên: {{ $student->student_name }}</h1>
    <a href="{{ route('sinhvien.index') }}" class="btn btn-secondary mb-3">Trở về danh sách Sinh viên</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($registrations->isNotEmpty())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID đăng ký</th>
                    <th>Mã môn học</th>
                    <th>Tên môn học</th>
                    <th>Số tín chỉ</th>
                    <th>Trạng thái</th>
                    <th>Học kỳ</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $registration)
                <tr>
                    <td>{{ $registration->id }}</td>
                    <td>{{ $registration->course->course_id }}</td>
                    <td>{{ $registration->course->course_name }}</td>
                    <td>{{ $registration->course->credits }}</td>
                    <td>
                        @if($registration->status == 1)
                            Đã hoàn thành
                        @else
                            Chưa hoàn thành
                        @endif
                    </td>
                    <td>{{ $registration->semester ?? 'N/A' }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Sinh viên này chưa đăng ký môn học mới nào.</p>
    @endif

</div>
</body>
</html>

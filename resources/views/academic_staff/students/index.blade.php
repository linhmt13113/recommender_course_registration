@extends('layouts.apps')

@section('title', 'Danh sách Sinh viên')

@section('content')
<div class="container mt-4">
    <h1>Quản lý Sinh viên</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('sinhvien.create') }}" class="btn btn-primary mb-3">Thêm Sinh viên</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã SV</th>
                <th>Tên</th>
                <th>Chuyên ngành</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->student_id }}</td>
                <td>{{ $student->student_name }}</td>
                <td>{{ $student->major->major_name ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('staff.students.courses', ['id' => $student->student_id]) }}" class="btn btn-info btn-sm">Xem môn học</a>
                    <a href="{{ route('staff.students.registrations', ['id' => $student->student_id]) }}" class="btn btn-success btn-sm">Xem đăng ký mới</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Phân trang -->
    {{ $students->links() }}
</div>
@endsection

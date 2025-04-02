@extends('layouts.app')

@section('title', 'Đăng ký môn học của sinh viên ' . $student->student_name)

@section('content')
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
                                Đã đăng kí thành công
                            @else
                                Không thành công
                            @endif
                        </td>
                        <td>{{ $registration->semester ?? 'N/A' }}</td>
                        <td>
                            <form action="{{ route('admin.students.registrations.destroy', $registration->id) }}"
                                method="POST" onsubmit="return confirm('Bạn có chắc chắn xóa đăng ký này không?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Sinh viên này chưa đăng ký môn học mới nào.</p>
    @endif

</div>
@endsection

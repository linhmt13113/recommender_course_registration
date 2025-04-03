@extends('layouts.apps')

@section('title', 'Quản lý Đăng ký Học kỳ')

@section('content')
<div class="container mt-4">
    <h1>Quản lý Đăng ký Học kỳ</h1>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Semester ID</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Registration Status</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($semesters as $semester)
            <tr>
                <td>{{ $semester->semester_id }}</td>
                <td>{{ $semester->start_date }}</td>
                <td>{{ $semester->end_date }}</td>
                <td>{{ ucfirst($semester->registration_status) }}</td>
                <td>
                    @if($semester->registration_status == 'closed')
                        <a href="{{ route('academic_staff.registration.courses', $semester->id) }}" class="btn btn-success">
                            Chọn môn & Mở đăng ký
                        </a>
                    @elseif($semester->registration_status == 'open')
                        <a href="{{ route('academic_staff.registration.courses', $semester->id) }}" class="btn btn-primary">
                            Xem/Chỉnh sửa môn đăng ký
                        </a>
                    @else
                        <span>Đã kết thúc</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

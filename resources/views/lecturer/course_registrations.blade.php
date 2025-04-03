@extends('layouts.lecturer')

@section('title', 'Danh sách đăng ký')

@push('styles')
<style>
    .registration-table th {
        background-color: #f8f9fa;
    }
</style>
@endpush

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Môn học: {{ $course->course_name }}</h2>
        <a href="{{ route('lecturer.schedule') }}" class="btn btn-secondary">
            ← Quay về
        </a>
    </div>

    @if($registrations->isNotEmpty())
        <div class="card shadow">
            <div class="card-body">
                <table class="table registration-table">
                    <thead>
                        <tr>
                            <th>Mã SV</th>
                            <th>Tên SV</th>
                            <th>Số TC</th>
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
                            <td>
                                <span class="badge {{ $registration->status ? 'bg-success' : 'bg-warning' }}">
                                    {{ $registration->status ? 'Đã đăng ký' : 'Error' }}
                                </span>
                            </td>
                            <td>{{ $registration->semester ?? 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="alert alert-info">Chưa có sinh viên đăng ký môn học này.</div>
    @endif
</div>
@endsection

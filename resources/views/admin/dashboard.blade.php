@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="dashboard-summary mb-4">
        <div class="row">
            <!-- Total Students -->
            <div class="col-md-4">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Students</h5>
                        <p class="card-text">{{ $totalStudents }}</p>
                    </div>
                </div>
            </div>
            <!-- Total Lecturers -->
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Lecturers</h5>
                        <p class="card-text">{{ $totalLecturers }}</p>
                    </div>
                </div>
            </div>
            <!-- Total Courses -->
            <div class="col-md-4">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Courses</h5>
                        <p class="card-text">{{ $totalCourses }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="recent-registrations">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h5 class="mb-0">Recent Student Registrations</h5>
            </div>
            <div class="card-body p-0">
                @if($recentRegistrations->isEmpty())
                    <p class="p-3">No recent registrations found.</p>
                @else
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Registered At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentRegistrations as $student)
                            <tr>
                                <td>{{ $student->student_id }}</td>
                                <td>{{ $student->student_name }}</td>
                                <td>{{ optional($student->created_at)->format('d/m/Y H:i') ?? 'N/A' }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('template/css/admins/admin-dashboard.css') }}">
@endpush

@push('scripts')
    <!-- Bạn có thể thêm JS cho dashboard nếu cần -->
@endpush

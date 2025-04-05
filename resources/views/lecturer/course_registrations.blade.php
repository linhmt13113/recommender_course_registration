@extends('layouts.lecturer')

@section('title', 'Registration List')

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
        <h2>Course: {{ $course->course_name }}</h2>
        <a href="{{ route('lecturer.schedule') }}" class="btn btn-secondary">
            ← Back
        </a>
    </div>

    @if($registrations->isNotEmpty())
        <div class="card shadow">
            <div class="card-body">
                <table class="table registration-table">
                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Credits</th>
                            <th>Status</th>
                            <th>Semester</th>
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
                                    {{ $registration->status ? 'Registered' : 'Error' }}
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
        <div class="alert alert-info">No students have registered for this course yet.</div>
    @endif
</div>
@endsection

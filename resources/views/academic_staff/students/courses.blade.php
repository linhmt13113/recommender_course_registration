@extends('layouts.apps')

@section('title', 'Student Courses')

@section('content')
<div class="container mt-4">
    <h1>Student Courses: {{ $student->student_name }}</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Course ID</th>
                <th>Course Name</th>
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
                <td>{{ $course->pivot->status == 1 ? 'Completed' : 'Not Completed' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">The student has not registered for any courses.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{ route('staff_viewstudents.index') }}" class="btn btn-secondary">Back to Student List</a>
</div>
@endsection

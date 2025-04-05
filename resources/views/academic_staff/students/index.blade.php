@extends('layouts.apps')

@section('title', 'Student List')

@section('content')
<div class="container mt-4">
    <h1>Student Management</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('sinhvien.create') }}" class="btn btn-primary mb-3">Add Student</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Major</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->student_id }}</td>
                <td>{{ $student->student_name }}</td>
                <td>{{ $student->major->major_name ?? 'N/A' }}</td>
                <td>
                    <a href="{{ route('staff.students.courses', ['id' => $student->student_id]) }}" class="btn btn-info btn-sm">View Courses</a>
                    <a href="{{ route('staff.students.registrations', ['id' => $student->student_id]) }}" class="btn btn-success btn-sm">View New Registrations</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    {{ $students->links() }}
</div>
@endsection

@extends('layouts.apps')

@section('title', 'Student List')

@section('content')
    <div class="container mt-4">
        <h1>Student Management</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Form search -->
        <form action="{{ route('staff_viewstudents.index') }}" method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="Search by ID or Name">
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ route('staff_viewstudents.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

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
                            <a href="{{ route('staff.students.courses', ['id' => $student->student_id]) }}"
                                class="btn btn-info btn-sm">View Courses</a>
                            <a href="{{ route('staff.students.registrations', ['id' => $student->student_id]) }}"
                                class="btn btn-success btn-sm">View New Registrations</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        {{ $students->links() }}
    </div>
@endsection

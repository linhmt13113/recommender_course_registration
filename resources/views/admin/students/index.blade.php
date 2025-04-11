@extends('layouts.app')

@section('title', 'Student List')

@section('content')
<div class="container mt-4">
    <h1>Manage Students</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('ad_student.create') }}" class="btn btn-primary mb-3">Add Student</a>

        <!-- Form search -->
        <form action="{{ route('ad_student.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-6">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    class="form-control"
                    placeholder="Search by ID or Name">
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ route('ad_student.index') }}" class="btn btn-secondary">Reset</a>
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
                    <a href="{{ route('ad_student.edit', ['ad_student' => $student->student_id]) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('ad_student.destroy', ['ad_student' => $student->student_id]) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $students->appends(request()->query())->links() }}
</div>
@endsection

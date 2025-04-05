@extends('layouts.app')

@section('title', 'Lecturer List')

@section('content')
<div class="container mt-4">
    <h1>Manage Lecturers</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('giangvien.create') }}" class="btn btn-primary mb-3">Add Lecturer</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Lecturer ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lecturers as $lecturer)
            <tr>
                <td>{{ $lecturer->lecturer_id }}</td>
                <td>{{ $lecturer->lecturer_name }}</td>
                <td>
                    <a href="{{ route('giangvien.edit', ['giangvien' => $lecturer->lecturer_id]) }}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{ route('giangvien.courses', $lecturer->lecturer_id) }}" class="btn btn-info btn-sm">View Subjects</a>
                    <form action="{{ route('giangvien.destroy', ['giangvien' => $lecturer->lecturer_id]) }}" method="POST" style="display:inline-block">
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
    {!! $lecturers->links() !!}
</div>
@endsection

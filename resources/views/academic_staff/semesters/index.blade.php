@extends('layouts.apps')

@section('title', 'Semester List')

@section('content')
<div class="container mt-4">
    <h1>Semester Management</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('hocki.create') }}" class="btn btn-primary mb-3">Add Semester</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Semester ID</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($semesters as $semester)
            <tr>
                <td>{{ $semester->semester_id }}</td>
                <td>{{ $semester->start_date }}</td>
                <td>{{ $semester->end_date }}</td>
                <td>
                    <a href="{{ route('hocki.edit', $semester->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('hocki.destroy', $semester->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $semesters->links() }}
</div>
@endsection

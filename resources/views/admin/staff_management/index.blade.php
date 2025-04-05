@extends('layouts.app')

@section('title', 'Staff List')

@section('content')
<div class="container mt-4">
    <h1>Staff Management</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('staff_management.create') }}" class="btn btn-primary mb-3">Add Staff</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Staff ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($staffs as $staff)
            <tr>
                <td>{{ $staff->staff_id }}</td>
                <td>{{ $staff->staff_name }}</td>
                <td>{{ $staff->email }}</td>
                <td>
                    <a href="{{ route('staff_management.edit', ['staff_management' => $staff->staff_id]) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('staff_management.destroy', ['staff_management' => $staff->staff_id]) }}" method="POST" style="display:inline-block">
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
    {!! $staffs->links() !!}
</div>
@endsection

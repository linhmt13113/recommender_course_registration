@extends('layouts.app')

@section('title', 'Edit Staff')

@section('content')
<div class="container mt-4">
    <h1>Edit Staff</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('staff_management.update', ['staff_management' => $staff->staff_id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="staff_id">Staff ID:</label>
            <input type="text" name="staff_id" id="staff_id" class="form-control" value="{{ $staff->staff_id }}" readonly>
        </div>
        <div class="form-group">
            <label for="staff_name">Staff Name:</label>
            <input type="text" name="staff_name" id="staff_name" class="form-control" value="{{ $staff->staff_name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $staff->email }}" required>
        </div>
        <div class="form-group">
            <label for="password">New Password (if changing):</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter new password">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

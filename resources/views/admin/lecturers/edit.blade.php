@extends('layouts.app')

@section('title', 'Edit Lecturer')

@section('content')
<div class="container mt-4">
    <h1>Edit Lecturer</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('ad_lecturer.update', ['ad_lecturer' => $lecturer->lecturer_id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="lecturer_id">Lecturer ID:</label>
            <input type="text" name="lecturer_id" id="lecturer_id" class="form-control" value="{{ $lecturer->lecturer_id }}" readonly>
        </div>
        <div class="form-group">
            <label for="lecturer_name">Lecturer Name:</label>
            <input type="text" name="lecturer_name" id="lecturer_name" class="form-control" value="{{ $lecturer->lecturer_name }}" required>
        </div>
        <div class="form-group">
            <label for="password">New Password:</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter new password" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

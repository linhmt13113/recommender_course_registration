@extends('layouts.app')

@section('title', 'Add Student')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Add Student</h1>
        <a href="{{ route('ad_student.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('ad_student.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="student_id">Student ID:</label>
            <input type="text" name="student_id" id="student_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="student_name">Student Name:</label>
            <input type="text" name="student_name" id="student_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="major_id">Major:</label>
            <select name="major_id" id="major_id" class="form-control" required>
                @foreach($majors as $major)
                    <option value="{{ $major->major_id }}">{{ $major->major_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary mr-2">
                <i class="fas fa-plus"></i> Add Student
            </button>
            <a href="{{ route('ad_student.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Student</h1>
        <a href="{{ route('sinhvien.index') }}" class="btn btn-secondary">
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

    <form action="{{ route('sinhvien.update', ['sinhvien' => $student->student_id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="student_id">Student ID:</label>
            <input type="text" name="student_id" id="student_id" class="form-control"
                   value="{{ $student->student_id }}" readonly>
        </div>
        <div class="form-group">
            <label for="student_name">Student Name:</label>
            <input type="text" name="student_name" id="student_name" class="form-control"
                   value="{{ old('student_name', $student->student_name) }}" >
        </div>
        <div class="form-group">
            <label for="major_id">Major:</label>
            <select name="major_id" id="major_id" class="form-control" >
                @foreach($majors as $major)
                    <option value="{{ $major->id }}"
                        {{ old('major_id', $student->major_id) == $major->id ? 'selected' : '' }}>
                        {{ $major->major_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="password">New Password:</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Enter new password">
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary mr-2">
                <i class="fas fa-save"></i> Update
            </button>
            <a href="{{ route('sinhvien.index') }}" class="btn btn-secondary">
                <i class="fas fa-times"></i> Cancel
            </a>
        </div>
    </form>
</div>
@endsection

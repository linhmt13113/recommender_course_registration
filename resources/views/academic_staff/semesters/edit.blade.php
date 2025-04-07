@extends('layouts.apps')

@section('title', 'Edit Semester')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Semester</h1>
        <a href="{{ route('semesters.index') }}" class="btn btn-secondary">Back</a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('semesters.update', $semester->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="semester_id">Semester ID:</label>
            <input type="text" name="semester_id" id="semester_id" class="form-control" value="{{ $semester->semester_id }}" required>
        </div>
        <div class="form-group">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $semester->start_date }}" required>
        </div>
        <div class="form-group">
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $semester->end_date }}" required>
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Update Semester</button>
            <a href="{{ route('semesters.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection

@extends('layouts.apps')

@section('title', 'Add Semester')

@section('content')
<div class="container mt-4">
    <h1>Add Semester</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('semesters.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="semester_id">Semester ID:</label>
            <input type="text" name="semester_id" id="semester_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Semester</button>
        <a href="{{ route('semesters.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection

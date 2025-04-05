@extends('layouts.app')

@section('title', 'Add Lecturer')

@section('content')
<div class="container mt-4">
    <h1>Add Lecturer</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('giangvien.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="lecturer_id">Lecturer ID:</label>
            <input type="text" name="lecturer_id" id="lecturer_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="lecturer_name">Lecturer Name:</label>
            <input type="text" name="lecturer_name" id="lecturer_name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Lecturer</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Add Staff')

@section('content')
<div class="container mt-4">
    <h1>Add Staff</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('staff_management.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="staff_id">Staff ID:</label>
            <input type="text" name="staff_id" id="staff_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="staff_name">Staff Name:</label>
            <input type="text" name="staff_name" id="staff_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Staff</button>
    </form>
</div>
@endsection

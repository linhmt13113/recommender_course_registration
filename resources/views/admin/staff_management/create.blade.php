@extends('layouts.app')

@section('title', 'Thêm Nhân viên')

@section('content')
<div class="container mt-4">
    <h1>Thêm Nhân viên</h1>

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
            <label for="staff_id">Mã Nhân viên:</label>
            <input type="text" name="staff_id" id="staff_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="staff_name">Tên Nhân viên:</label>
            <input type="text" name="staff_name" id="staff_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm Nhân viên</button>
    </form>
</div>
@endsection

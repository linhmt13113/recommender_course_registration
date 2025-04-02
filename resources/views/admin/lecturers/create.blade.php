@extends('layouts.app')

@section('title', 'Thêm Giảng viên')

@section('content')
<div class="container mt-4">
    <h1>Thêm Giảng viên</h1>

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
            <label for="lecturer_id">Mã Giảng viên:</label>
            <input type="text" name="lecturer_id" id="lecturer_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="lecturer_name">Tên Giảng viên:</label>
            <input type="text" name="lecturer_name" id="lecturer_name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm Giảng viên</button>
    </form>
</div>
@endsection

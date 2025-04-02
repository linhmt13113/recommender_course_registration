@extends('layouts.app')

@section('title', 'Sửa Giảng viên')

@section('content')
<div class="container mt-4">
    <h1>Sửa Giảng viên</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('giangvien.update', ['giangvien' => $lecturer->lecturer_id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="lecturer_id">Mã Giảng viên:</label>
            <input type="text" name="lecturer_id" id="lecturer_id" class="form-control" value="{{ $lecturer->lecturer_id }}" readonly>
        </div>
        <div class="form-group">
            <label for="lecturer_name">Tên Giảng viên:</label>
            <input type="text" name="lecturer_name" id="lecturer_name" class="form-control" value="{{ $lecturer->lecturer_name }}" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu mới:</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu mới" required>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection

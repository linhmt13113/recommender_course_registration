@extends('layouts.app')

@section('title', 'Sửa Nhân viên')

@section('content')
<div class="container mt-4">
    <h1>Sửa Nhân viên</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('staff_management.update', ['staff_management' => $staff->staff_id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="staff_id">Mã Nhân viên:</label>
            <input type="text" name="staff_id" id="staff_id" class="form-control" value="{{ $staff->staff_id }}" readonly>
        </div>
        <div class="form-group">
            <label for="staff_name">Tên Nhân viên:</label>
            <input type="text" name="staff_name" id="staff_name" class="form-control" value="{{ $staff->staff_name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $staff->email }}" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu mới (nếu đổi):</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu mới">
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection

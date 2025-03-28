<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Giảng viên</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
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
            <input type="text" name="lecturer_id" id="lecturer_id" class="form-control" value="{{ $lecturer->lecturer_id }}" required>
        </div>
        <div class="form-group">
            <label for="lecturer_name">Tên Giảng viên:</label>
            <input type="text" name="lecturer_name" id="lecturer_name" class="form-control" value="{{ $lecturer->lecturer_name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
</body>
</html>

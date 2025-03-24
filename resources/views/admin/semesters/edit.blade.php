<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Học kỳ</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container mt-4">
    <h1>Sửa Học kỳ</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('hocki.update', $semester->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="semester_id">Mã Học kỳ:</label>
            <input type="text" name="semester_id" id="semester_id" class="form-control" value="{{ $semester->semester_id }}" required>
        </div>
        <div class="form-group">
            <label for="start_date">Ngày bắt đầu:</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $semester->start_date }}" required>
        </div>
        <div class="form-group">
            <label for="end_date">Ngày kết thúc:</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $semester->end_date }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật Học kỳ</button>
    </form>
</div>
</body>
</html>

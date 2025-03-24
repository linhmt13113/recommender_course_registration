<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Môn học</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container mt-4">
    <h1>Thêm Môn học</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('monhoc.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="course_name">Tên Môn học:</label>
            <input type="text" name="course_name" id="course_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="course_description">Mô tả:</label>
            <textarea name="course_description" id="course_description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="lecturer_id">Chọn Giảng viên (nếu có):</label>
            <select name="lecturer_id" id="lecturer_id" class="form-control">
                <option value="">-- Chọn Giảng viên --</option>
                @foreach($lecturers as $lecturer)
                    <option value="{{ $lecturer->lecturer_id }}">{{ $lecturer->lecturer_name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Thêm Môn học</button>
    </form>
</div>
</body>
</html>

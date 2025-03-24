<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Sinh viên</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container mt-4">
    <h1>Thêm Sinh viên</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('sinhvien.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="student_id">Mã Sinh viên:</label>
            <input type="text" name="student_id" id="student_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="student_name">Tên Sinh viên:</label>
            <input type="text" name="student_name" id="student_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="major_id">Chuyên ngành:</label>
            <select name="major_id" id="major_id" class="form-control" required>
                <!-- Giả sử bạn đã truyền biến $majors từ controller -->
                @foreach($majors as $major)
                    <option value="{{ $major->major_id }}">{{ $major->major_name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Thêm Sinh viên</button>
    </form>
</div>
</body>
</html>

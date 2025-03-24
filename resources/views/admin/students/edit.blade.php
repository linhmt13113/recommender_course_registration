<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Sinh viên</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container mt-4">
    <h1>Sửa Sinh viên</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('sinhvien.update', ['sinhvien' => $student->student_id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="student_id">Mã Sinh viên:</label>
            <input type="text" name="student_id" id="student_id" class="form-control"
                   value="{{ $student->student_id }}" required>
        </div>
        <div class="form-group">
            <label for="student_name">Tên Sinh viên:</label>
            <input type="text" name="student_name" id="student_name" class="form-control" value="{{ $student->student_name }}" required>
        </div>
        <div class="form-group">
            <label for="major_id">Chuyên ngành:</label>
            <select name="major_id" id="major_id" class="form-control" required>
                @foreach($majors as $major)
                    <option value="{{ $major->id }}"
                        {{ $student->major_id == $major->id ? 'selected' : '' }}>
                        {{ $major->major_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
</body>
</html>

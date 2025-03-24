<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách Giảng viên</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container mt-4">
    <h1>Quản lý Giảng viên</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('giangvien.create') }}" class="btn btn-primary mb-3">Thêm Giảng viên</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã GV</th>
                <th>Tên</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lecturers as $lecturer)
            <tr>
                <td>{{ $lecturer->lecturer_id }}</td>
                <td>{{ $lecturer->lecturer_name }}</td>
                <td>
                    <a href="{{ route('giangvien.edit', ['giangvien' => $lecturer->lecturer_id]) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('giangvien.destroy', ['giangvien' => $lecturer->lecturer_id]) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $lecturers->links() }}
</div>
</body>
</html>

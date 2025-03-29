<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>Chào mừng Admin!</h1>
        <p>Đây là trang quản trị hệ thống.</p>
    </div>
    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Đăng xuất</button>
        </form>
</body>
</html>

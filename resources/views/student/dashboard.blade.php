<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Sinh Viên</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <header>
        <h1>Hệ thống đăng ký môn học</h1>
        <a href="{{ route('student.change_password') }}">Đổi mật khẩu</a>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Đăng xuất</button>
        </form>
        <!-- Menu, nav, … -->
        <nav>
            <a href="{{ route('student.curriculum') }}">Chương trình đào tạo</a> |
            <a href="{{ route('student.past_courses') }}">Các môn đã học</a>
        </nav>
    </header>
    <div class="container">
        <h1>Chào mừng, {{ session('user')->student_name }}!</h1>
        <p>Đây là trang dashboard của sinh viên. Mã sinh viên của bạn là: {{ session('user')->student_id }}</p>
    </div>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2025 - Hệ thống đăng ký môn học</p>
    </footer>
</body>

</html>

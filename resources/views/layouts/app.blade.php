<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    <!-- Import CSS chung, bootstrap... -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" href="{{ asset('icons.png') }}" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Các style bổ sung nếu cần -->
    @stack('styles')
</head>

<body>
    <!-- Header chung (nếu có) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin</a>
        <!-- Các menu, nav-item khác -->
        <div class="dashboard-menu mt-3">
            <a href="{{ route('viewmonhoc.index') }}" class="btn btn-primary">Quản lý Môn học</a>
            <a href="{{ route('giangvien.index') }}" class="btn btn-primary">Quản lý Giảng viên</a>
            <a href="{{ route('sinhvien.index') }}" class="btn btn-primary">Quản lý Sinh viên</a>
            <a href="{{ route('staff_management.index') }}" class="btn btn-primary">Quản lý Academic_Staff</a>
        </div>

        <div class="logout-btn mt-3">
            <a href="{{ route('admin.change_password') }}" class="btn btn-outline-primary me-2">
                Đổi mật khẩu
            </a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Đăng xuất</button>
            </form>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Footer chung (nếu có) -->
    <footer class="mt-4 text-center">
        <p>&copy; {{ date('Y') }} - Hệ thống quản trị</p>
    </footer>

    <!-- Import JS chung -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hệ thống quản lý đăng ký môn học')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('academic_staff.dashboard') }}">Quản lý giáo vụ</a>
        <div class="dashboard-menu mt-3">
            <a href="{{ route('academic_staff.registration.index') }}" class="btn btn-primary">Quản lý mở đợt đăng ký</a>
            <a href="{{ route('monhoc.index', ['id' => 1]) }}" class="btn btn-primary">Quản lý môn học</a>
            <a href="{{ route('hocki.index') }}" class="btn btn-primary">Quản lý học kỳ</a>
        </div>
        <div class="logout-btn mt-3">
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Đăng xuất</button>
            </form>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>

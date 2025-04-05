<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    <!-- Import common CSS, bootstrap... -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/admins/admin.css') }}"> <!-- Admin CSS -->
    <link rel="icon" href="{{ asset('icons.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
</head>

<body>
    <!-- Common Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin</a>
            <div class="dashboard-menu mt-3">
                <a href="{{ route('viewmonhoc.index') }}" class="btn btn-primary">Manage Courses</a>
                <a href="{{ route('giangvien.index') }}" class="btn btn-primary">Manage Lecturers</a>
                <a href="{{ route('sinhvien.index') }}" class="btn btn-primary">Manage Students</a>
                <a href="{{ route('staff_management.index') }}" class="btn btn-primary">Manage Academic Staff</a>
            </div>
            <div class="dashboard-menu mt-3">
                <a href="{{ route('admin.change_password') }}" class="btn btn-outline-primary me-2">
                    Change Password
                </a>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Log Out</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <footer class="mt-4 text-center">
        <div class="container">
            <p>&copy; {{ date('Y') }} - Admin System</p>
        </div>
    </footer>

    <!-- Import common JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('template/js/.js') }}"></script>
    @stack('scripts')
</body>

</html>

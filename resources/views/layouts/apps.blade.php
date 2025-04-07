<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Course Registration Management System')</title>
    <link rel="icon" href="{{ asset('icons.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('template/css/admins/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
    <style>
        .container.mt-4 {
            margin-bottom: 326px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('academic_staff.dashboard') }}">Academic Staff</a>
        <div class="dashboard-menu mt-3">
            <a href="{{ route('academic_staff.registration.index') }}" class="btn btn-primary">Manage Registration Periods</a>
            <a href="{{ route('monhoc.index') }}" class="btn btn-primary">Manage Courses</a>
            <a href="{{ route('hocki.index') }}" class="btn btn-primary">Manage Semesters</a>
            <a href="{{ route('viewsinhvien.index') }}" class="btn btn-primary">Manage Students</a>
        </div>
        <div class="dashboard-menu mt-3">
            <a href="{{ route('academic_staff.change_password') }}" class="btn btn-outline-primary me-2">
                Change Password
            </a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <footer class="mt-4 text-center">
        <div class="container">
            <p>&copy; {{ date('Y') }} - Acadamic Staff System</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('template/js/.js') }}"></script>
    @stack('scripts')
</body>

</html>

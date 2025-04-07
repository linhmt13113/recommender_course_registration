<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Lecturer System</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/lecturers/style.css') }}">
    <link rel="icon" href="{{ asset('icons.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
    <style>
        .container.mt-4 {
            margin-bottom: 460px;
        }
    </style>
</head>

<body>
    @if(session('success'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div class="toast show" role="alert">
                <div class="toast-header bg-success text-white">
                    <strong class="me-auto">Success</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('lecturer.schedule') }}">
                Welcome {{ session('user')->lecturer_name ?? session('user')->lecturer_id }}
            </a>
            <div class="d-flex align-items-center">
                <a href="{{ route('lecturer.change_password') }}" class="btn btn-outline-primary me-2">
                    Change Password
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <footer class="mt-5 py-3 bg-dark">
        <div class="container text-center">
            <p class="mb-0" style="color: white;">&copy; {{ date('Y') }} Teaching Management System</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('template/js/lec.js') }}"></script>
    @stack('scripts')
</body>

</html>

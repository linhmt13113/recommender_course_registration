<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-primary text-white p-3">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4">Course Registration System</h1>
            <div>
                <a href="{{ route('student.change_password') }}" class="btn btn-outline-light btn-sm">Change Password</a>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mt-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('student.dashboard') }}">Dashboard</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('student.curriculum') }}">Curriculum</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('student.past_courses') }}">Completed Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary text-white" href="{{ route('student.course_registration.index') }}">Course Registration</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary text-white" href="{{ route('student.schedule') }}">Schedule</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-5">
        <h1 class="display-4">Welcome, {{ session('user')->student_name }}!</h1>
        <p class="lead">This is your student dashboard. Your student ID is: {{ session('user')->student_id }}</p>
    </div>

    <main class="container">
        {{-- Chỉ hiển thị phần news nếu $hideNews không tồn tại hoặc bằng false --}}
        @if(!isset($hideNews) || !$hideNews)
            <section class="mt-5">
                <h2>Latest News</h2>
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="#" class="text-decoration-none">
                            NOTICE ON COLLECTING PHYSICAL EDUCATION FEES FOR SEMESTER I, ACADEMIC YEAR 2024-2025
                        </a>
                        <small class="text-muted d-block">(Updated news (01/04/2025))</small>
                    </li>
                    <li class="list-group-item">
                        <a href="#" class="text-decoration-none">
                            NOTICE ON THE REGULATION OF MID-TERM FEES COLLECTION FOR SEMESTER II, ACADEMIC YEAR 2024-2025
                        </a>
                        <small class="text-muted d-block">(Updated news (26/03/2025))</small>
                    </li>
                    <li class="list-group-item">
                        <a href="#" class="text-decoration-none">
                            NOTICE ON THE COLLECTION OF FEE AND ENGLISH TEXTBOOK FUND ENHANCEMENT
                        </a>
                        <small class="text-muted d-block">(Updated news (26/03/2025))</small>
                    </li>
                    <li class="list-group-item">
                        <a href="#" class="text-decoration-none">
                            NOTICE ON THE MID-TERM EXAM REGULATIONS FOR SEMESTER II, ACADEMIC YEAR 2024-2025
                        </a>
                        <small class="text-muted d-block">(18/03/2025)</small>
                    </li>
                    <li class="list-group-item">
                        <a href="#" class="text-decoration-none">
                            NOTICE ON THE APPLICATION PERIOD FOR MAJOR OR PROGRAM TRANSFER, ACADEMIC YEAR 2024-2025
                        </a>
                        <small class="text-muted d-block">(03/06/2024)</small>
                    </li>
                </ul>
            </section>
        @endif

        @yield('content')
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2025 - Course Registration System</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

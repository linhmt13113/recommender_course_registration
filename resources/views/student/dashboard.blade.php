<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard - Student')</title>
  <link rel="stylesheet" href="{{ asset('template/css/students/dashboard.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" href="{{ asset('icons.png') }}" type="image/png">
  @stack('styles')

</head>
<body>
  <!-- Header Topbar & Navbar -->
  <header class="main-header">
  <div class="header-top">
    <div class="container d-flex justify-content-between align-items-center">
      <div class="logo">
        My Education
      </div>
      <div class="header-actions">
        <a href="{{ route('student.change_password') }}" class="header-btn">Change Password</a>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="header-btn">Logout</button>
        </form>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('student.dashboard') }}">Dashboard</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('student.curriculum') }}">Curriculum</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('student.past_courses') }}">Completed Courses</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('student.course_registration.index') }}">Course Registration</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('student.schedule') }}">Schedule</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>


  <!-- Content Header -->
  <div class="container mt-5 pt-3">
    <h1 class="display-4">Welcome, {{ session('user')->student_name }}!</h1>
    <p class="lead">This is your student dashboard. Your student ID is: {{ session('user')->student_id }}</p>
  </div>

  <!-- Main Content & Latest News Section -->
  <main class="container my-5">
    @if(!isset($hideNews) || !$hideNews)
      <section class="news-section">
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

  <!-- Footer -->
  <footer class="footer bg-dark text-white text-center py-3">
    <div class="container">
      <p>&copy; 2025 - My Education</p>
    </div>
  </footer>

  <!-- Scripts -->
  <!-- <script src="{{ asset('js/students/dashboard.js') }}"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

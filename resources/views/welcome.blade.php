<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Education</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('template/css/landing.css') }}">
    <link rel="icon" href="{{ asset('icons.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>

    <!-- Navigation Bar -->
    <header class="navbar">
        <div class="container">
            <h1 class="logo">My Education</h1>
            <nav>
                <ul class="nav-links">
                    <li><a href="#home"><i class="bi bi-house-door"></i> HomePage</a></li>
                    <li><a href="#about"><i class="bi bi-info-circle"></i> Introduction</a></li>
                    <li><a href="#services"><i class="bi bi-hammer"></i> Services</a></li>
                    <li><a href="#feedback"><i class="bi bi-chat-left-text"></i> Feedback</a></li>
                    @if (Route::has('login'))
                        @auth
                            <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        @else
                            <li><a href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Login</a></li>
                        @endauth
                    @endif
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Section -->
    <main class="container mt-5">
        <img src="{{ asset('images/banner.jpg') }}" alt="Banner" class="hero-banner">
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
    </main>

    <!-- Scripts -->
    <script src="{{ asset('template/js/landing.js') }}"></script>
</body>

</html>

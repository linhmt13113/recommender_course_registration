@extends('layouts.apps')

@section('title', 'Dashboard - Academic Staff')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-3">Academic Staff Dashboard</h2>
        <p>Welcome {{ session('user')->staff_name }}, this is your overview page.</p>

        <!-- Overview Statistics -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Semesters</h5>
                        <p class="card-text fs-4">{{ $totalSemesters }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Open Registration Periods</h5>
                        <p class="card-text fs-4">{{ $openSemesters }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Courses in Latest Semester</h5>
                        <p class="card-text fs-4">{{ $totalCoursesInLatest }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Semesters List -->
        <div class="card">
            <div class="card-header">
                <strong>Recent Semesters</strong>
            </div>
            <div class="card-body p-0">
                @if($recentSemesters->isEmpty())
                    <p class="p-3">No semesters available.</p>
                @else
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Semester ID</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Registration Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentSemesters as $semester)
                                <tr>
                                    <td>{{ $semester->semester_id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($semester->start_date)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($semester->end_date)->format('d/m/Y') }}</td>

                                    <td>
                                        @if($semester->registration_status === 'open')
                                            <span class="badge bg-success">Open</span>
                                        @else
                                            <span class="badge bg-secondary">Closed</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart')?.getContext('2d');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Semesters', 'Open Registrations', 'Courses'],
                    datasets: [{
                        label: 'Statistics',
                        data: [{{ $totalSemesters }}, {{ $openSemesters }}, {{ $totalCoursesInLatest }}],
                        backgroundColor: ['#007bff', '#28a745', '#ffc107']
                    }]
                },
            });
        }
    </script>
@endpush

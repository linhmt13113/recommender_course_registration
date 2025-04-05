@extends('layouts.lecturer')

@section('title', 'Schedule')

@section('content')
<div class="container mt-4">
    @if($activeSemester)
        <div class="alert alert-info">
            Current semester: {{ $activeSemester->semester_id }}
        </div>
    @else
        <div class="alert alert-warning">No active semester.</div>
    @endif

    @if($courses->isNotEmpty())
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Schedule</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                        <tr>
                            <td>{{ $course->course_id }}</td>
                            <td>{{ $course->course_name }}</td>
                            <td>
                                @forelse($course->schedules as $schedule)
                                <div class="mb-2">
                                    <span class="badge bg-secondary">
                                        @switch($schedule->day_of_week)
                                            @case(1) Monday @break
                                            @case(2) Tuesday @break
                                            @case(3) Wednesday @break
                                            @case(4) Thursday @break
                                            @case(5) Friday @break
                                            @case(6) Saturday @break
                                            @case(7) Sunday @break
                                        @endswitch
                                    </span>
                                    {{ $schedule->start_time }} - {{ $schedule->end_time }}
                                </div>
                                @empty
                                <span class="text-muted">No schedule</span>
                                @endforelse
                            </td>
                            <td>
                                <a href="{{ route('lecturer.courses.registrations', $course->course_id) }}"
                                   class="btn btn-sm btn-outline-info">
                                    View registrations
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="alert alert-warning">No assigned courses.</div>
    @endif
</div>
@endsection

@push('styles')
    <!-- Include custom CSS file -->
    <link rel="stylesheet" href="{{ asset('template/css/lecturer/schedule.css') }}">
@endpush

@push('scripts')
    <!-- Include custom JS file -->
    <script src="{{ asset('template/js/lec.js') }}"></script>
@endpush

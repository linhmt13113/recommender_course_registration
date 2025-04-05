@extends('layouts.app')

@section('title', 'Subjects taught by Lecturer ' . $lecturer->lecturer_name)

@section('content')
<div class="container mt-4">
    <h1>Subjects taught by Lecturer {{ $lecturer->lecturer_name }}</h1>
    <a href="{{ route('giangvien.index') }}" class="btn btn-secondary mb-3">Back to Lecturer List</a>
    @if($courses->isNotEmpty())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Credits</th>
                    <th>Schedule</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td>{{ $course->course_id }}</td>
                    <td>{{ $course->course_name }}</td>
                    <td>{{ $course->credits }}</td>
                    <td>
                        @if($course->schedules->isNotEmpty())
                            @php $schedule = $course->schedules->first(); @endphp
                            <div><strong>Day:</strong>
                                @switch($schedule->day_of_week)
                                    @case(1) Monday @break
                                    @case(2) Tuesday @break
                                    @case(3) Wednesday @break
                                    @case(4) Thursday @break
                                    @case(5) Friday @break
                                    @case(6) Saturday @break
                                    @case(7) Sunday @break
                                    @default Undefined
                                @endswitch
                            </div>
                            <div><strong>Start Time:</strong> {{ $schedule->start_time }}</div>
                            <div><strong>End Time:</strong> {{ $schedule->end_time }}</div>
                        @else
                            No schedule available
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>This lecturer has not taught any subjects yet.</p>
    @endif
</div>
@endsection

@extends('layouts.lecturer')

@section('title', 'Thời khóa biểu')

@section('content')
<div class="container mt-4">
    @if($activeSemester)
        <div class="alert alert-info">
            Kỳ học hiện hành: {{ $activeSemester->semester_id }}
        </div>
    @else
        <div class="alert alert-warning">Không có kỳ học hiện hành.</div>
    @endif

    @if($courses->isNotEmpty())
        <div class="card shadow">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Mã môn</th>
                            <th>Tên môn</th>
                            <th>Lịch học</th>
                            <th>Hành động</th>
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
                                            @case(1) Thứ 2 @break
                                            @case(2) Thứ 3 @break
                                            @case(3) Thứ 4 @break
                                            @case(4) Thứ 5 @break
                                            @case(5) Thứ 6 @break
                                            @case(6) Thứ 7 @break
                                            @case(7) Chủ nhật @break
                                        @endswitch
                                    </span>
                                    {{ $schedule->start_time }} - {{ $schedule->end_time }}
                                </div>
                                @empty
                                <span class="text-muted">Chưa có lịch</span>
                                @endforelse
                            </td>
                            <td>
                                <a href="{{ route('lecturer.courses.registrations', $course->course_id) }}"
                                   class="btn btn-sm btn-outline-info">
                                    Xem đăng ký
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="alert alert-warning">Không có môn học được phân công.</div>
    @endif
</div>
@endsection

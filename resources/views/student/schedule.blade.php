@php
    $hideNews = true;
@endphp

@extends('student.dashboard')
@section('title', 'Schedule')


@section('content')
    <h1>Student timetable: {{ $student->student_name }}</h1>

    @php
        // Ánh xạ số (1-7) thành tên ngày tiếng Anh
        $days = [
            '1' => 'Monday',
            '2' => 'Tuesday',
            '3' => 'Wednesday',
            '4' => 'Thursday',
            '5' => 'Friday',
            '6' => 'Saturday',
            '7' => 'Sunday',
        ];


        $startHour = 8;
        $maxPeriod = 10;

        function getStartPeriod($timeStr, $startHour)
        {
            return \Carbon\Carbon::parse($timeStr)->hour - $startHour + 1;
        }

        function getEndPeriod($timeStr, $startHour)
        {
            $time = \Carbon\Carbon::parse($timeStr);
            return $time->minute == 0 ? $time->hour - $startHour : $time->hour - $startHour + 1;
        }

        $registrationsByDay = [];
        foreach ($student->registrations as $reg) {
            $course = optional($reg->course);
            $schedule = $course->schedules->first();
            if ($schedule) {
                $startPeriod = getStartPeriod($schedule->start_time, $startHour);
                $endPeriod = getEndPeriod($schedule->end_time, $startHour);
                $dayKey = $schedule->day_of_week;
                // Tính rowspan: nếu từ tiết 1 đến tiết 3 => rowspan = 3
                $registrationsByDay[$dayKey][] = [
                    'course_name' => $course->course_name,
                    'course_id' => $course->course_id,
                    'startPeriod' => $startPeriod,
                    'endPeriod' => $endPeriod,
                    'rowspan' => $endPeriod - $startPeriod + 1
                ];
            }
        }
    @endphp

    <table class="table table-bordered text-center" style="table-layout: fixed; width: 100%;">
        <thead>
            <tr>
                <th style="width: 100px;">Unit</th>
                @foreach($days as $day)
                    <th style="width: 150px;">{{ $day }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @for ($period = 1; $period <= $maxPeriod; $period++)
                <tr>
                    <td style="width: 100px;"
                        title="{{ sprintf("%02d:00", $startHour + $period - 1) }} - {{ sprintf("%02d:00", $startHour + $period) }}">
                        Unit {{ $period }}
                    </td>
                    @foreach($days as $dayKey => $dayName)
                        @php $hasCourse = false; @endphp
                        @if(isset($registrationsByDay[$dayKey]))
                            @foreach($registrationsByDay[$dayKey] as $index => $regInfo)
                                @if($regInfo['startPeriod'] == $period)
                                    <td style="width: 150px; background-color: #cce5ff; vertical-align: middle;"
                                        rowspan="{{ $regInfo['rowspan'] }}">
                                        <strong>{{ $regInfo['course_name'] }} ({{ $regInfo['course_id'] }})</strong>
                                    </td>
                                    @php
                                        $hasCourse = true;
                                        unset($registrationsByDay[$dayKey][$index]);
                                    @endphp
                                    @break
                                @elseif($period > $regInfo['startPeriod'] && $period <= $regInfo['endPeriod'])
                                    @php $hasCourse = true; @endphp
                                    @break
                                @endif
                            @endforeach
                        @endif
                        @if(!$hasCourse)
                            <td style="width: 150px;">&nbsp;</td>
                        @endif
                    @endforeach
                </tr>
            @endfor
        </tbody>
    </table>
@endsection

@php
    $hideNews = true;
@endphp

@extends('student.dashboard')
@section('title', 'Curriculum')

@section('content')
    <div class="curriculum-container">
        <h1 class="text-center text-primary">View curriculum of  {{ $student->major->major_name }} major</h1>

        @if($curriculum->isEmpty())
            <p class="no-data-text">There is no curriculum data </p>
        @else
            <table class="curriculum-table table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Subject code</th>
                        <th>Subject name</th>
                        <th>Type</th>
                        <th>Semester suggested</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mergedCurriculum as $item)
                        <tr>
                            <td>{{ $item['course']['course_id'] }}</td>
                            <td>{{ $item['course']['course_name'] }}</td>
                            <td>
                                @if($item['is_elective'] == 1)
                                    Elective
                                @else
                                    Compulsory
                                @endif
                            </td>
                            <td>{{ $item['recommended_semester'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('template/css/students/curriculum.css') }}">
@endpush

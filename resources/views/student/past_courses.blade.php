@php
    $hideNews = true;
@endphp

@extends('student.dashboard')
@section('title', 'Completed Courses')

@section('content')
    <div class="past-courses-container">
        <div class="card shadow-sm p-4">
            <h2 class="text-center text-primary mb-4">The courses have learned</h2>

            @if($courses->isEmpty())
                <p class="text-center">There is no courses.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>Subject code</th>
                            <th>Subject name</th>
                            <th>Semester</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td>{{ $course->course->course_id }}</td>
                                <td>{{ $course->course->course_name }}</td>
                                <td>{{ $course->semester }}</td>
                                <td>{{ $course->status == '1' || $course->status == 1 ? 'Completed' : 'Incompleted'}}</td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            @endif
        </div>
    </div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('template/css/students/past-courses.css') }}">
    <style>
        .table {
            margin-bottom: 20px;
        }

        .past-courses-container .card {
            margin-bottom: 100px;
        }
    </style>
@endpush

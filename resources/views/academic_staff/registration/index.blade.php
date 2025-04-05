@extends('layouts.apps')

@section('title', 'Semester Registration Management')

@section('content')
<div class="container mt-4">
    <h1>Semester Registration Management</h1>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Semester ID</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Registration Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($semesters as $semester)
            <tr>
                <td>{{ $semester->semester_id }}</td>
                <td>{{ $semester->start_date }}</td>
                <td>{{ $semester->end_date }}</td>
                <td>{{ ucfirst($semester->registration_status) }}</td>
                <td>
                    @if($semester->registration_status == 'closed')
                        <a href="{{ route('academic_staff.registration.courses', $semester->id) }}" class="btn btn-success">
                            Select Courses & Open Registration
                        </a>
                    @elseif($semester->registration_status == 'open')
                        <a href="{{ route('academic_staff.registration.courses', $semester->id) }}" class="btn btn-primary">
                            View/Edit Registered Courses
                        </a>
                    @else
                        <span>Closed</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

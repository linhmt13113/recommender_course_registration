@extends('layouts.apps')

@section('title', 'Student Course Registration for ' . $student->student_name)

@section('content')
<div class="container mt-4">
    <h1>Course Registration for Student: {{ $student->student_name }}</h1>
    <a href="{{ route('staff_viewstudents.index') }}" class="btn btn-secondary mb-3">Back to Student List</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($registrations->isNotEmpty())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Registration ID</th>
                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Credits</th>
                    <th>Status</th>
                    <th>Semester</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $registration)
                    <tr>
                        <td>{{ $registration->id }}</td>
                        <td>{{ $registration->course->course_id }}</td>
                        <td>{{ $registration->course->course_name }}</td>
                        <td>{{ $registration->course->credits }}</td>
                        <td>
                            @if($registration->status == 1)
                                Successfully Registered
                            @else
                                Unsuccessful
                            @endif
                        </td>
                        <td>{{ $registration->semester ?? 'N/A' }}</td>
                        <td>
                            <form action="{{ route('staff.students.registrations.destroy', $registration->id) }}"
                                method="POST" onsubmit="return confirm('Are you sure you want to delete this registration?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>This student has not registered for any courses yet.</p>
    @endif

</div>
@endsection

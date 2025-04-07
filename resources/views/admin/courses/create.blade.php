@extends('layouts.app')

@section('title', 'Add Course')

@section('content')
    <h1>Add Course</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('viewcourses.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="course_id">Course ID:</label>
            <input type="text" name="course_id" id="course_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="course_name">Course Name:</label>
            <input type="text" name="course_name" id="course_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="credits">Credits:</label>
            <input type="number" name="credits" id="credits" class="form-control" required min="1">
        </div>
        <div class="form-group">
            <label for="course_description">Description:</label>
            <textarea name="course_description" id="course_description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="lecturer_id">Select Lecturer (if available):</label>
            <select name="lecturer_id" id="lecturer_id" class="form-control">
                <option value="">-- Select Lecturer --</option>
                @foreach($lecturers as $lecturer)
                    <option value="{{ $lecturer->lecturer_id }}">{{ $lecturer->lecturer_name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Schedule Section -->
        <hr>
        <h4>Schedule</h4>
        <div class="form-group">
            <label for="day_of_week">Select Day of Week:</label>
            <select name="day_of_week" id="day_of_week" class="form-control" required>
                <option value="">-- Select Day --</option>
                <option value="1">Monday</option>
                <option value="2">Tuesday</option>
                <option value="3">Wednesday</option>
                <option value="4">Thursday</option>
                <option value="5">Friday</option>
                <option value="6">Saturday</option>
                <option value="7">Sunday</option>
            </select>
        </div>
        <div class="form-group">
            <label for="start_time">Start Time:</label>
            <input type="time" name="start_time" id="start_time" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_time">End Time:</label>
            <input type="time" name="end_time" id="end_time" class="form-control" required>
        </div>

        <!-- Course Major Section -->
        <hr>
        <h4>Major Information</h4>
        <div class="form-group">
            <label>Select Major:</label>
            <div class="border p-2 major-scroll">
                @foreach($majors as $major)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="majors[]" id="major_{{ $major->major_id }}" value="{{ $major->major_id }}">
                        <label class="form-check-label" for="major_{{ $major->major_id }}">
                            {{ $major->major_name }}
                        </label>
                    </div>
                @endforeach
            </div>
            @error('majors')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="is_elective">Course Type:</label>
            <select name="is_elective" id="is_elective" class="form-control">
                <option value="0">Mandatory</option>
                <option value="1">Elective</option>
            </select>
        </div>
        <div class="form-group">
            <label for="recommended_semester">Recommended Semester:</label>
            <input type="number" name="recommended_semester" id="recommended_semester" class="form-control">
        </div>

        <!-- Prerequisites Section -->
        <hr>
        <h4>Prerequisites Information</h4>
        <div class="form-group">
            <label>
                <input type="checkbox" name="no_prerequisites" id="no_prerequisites" value="1">
                No Prerequisites
            </label>
        </div>
        <div id="prerequisites_fields">
            <div class="form-group">
                <label for="prerequisite_major_id">Select Applicable Major:</label>
                <select name="prerequisite_major_id" id="prerequisite_major_id" class="form-control">
                    <option value="">-- Select Major --</option>
                    @foreach($majors as $major)
                        <option value="{{ $major->major_id }}">{{ $major->major_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="prerequisite_course_id">Select Prerequisite Course:</label>
                <select name="prerequisite_course_id" id="prerequisite_course_id" class="form-control">
                    <option value="">-- Select Prerequisite Course --</option>
                    @foreach($coursesList as $courseItem)
                        <option value="{{ $courseItem->course_id }}">{{ $courseItem->course_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="prerequisite_type">Prerequisite Type:</label>
                <select name="prerequisite_type" id="prerequisite_type" class="form-control">
                    <option value="Required">Mandatory</option>
                    <option value="Optional">Optional</option>
                    <option value="Previous">Prior</option>
                </select>
            </div>
        </div>

        <script>
            // Toggle prerequisites fields based on checkbox status
            document.getElementById('no_prerequisites').addEventListener('change', function () {
                var prereqFields = document.getElementById('prerequisites_fields');
                prereqFields.style.display = this.checked ? 'none' : 'block';
            });
        </script>

        <button type="submit" class="btn btn-primary">Add Course</button>
        <a href="{{ route('viewcourses.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
@endsection

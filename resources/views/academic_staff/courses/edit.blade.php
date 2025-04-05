@extends('layouts.apps')

@section('title', 'Edit Course')

@section('content')
<div class="edit-course-container">
    <h1 class="page-title">Edit Course</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <form action="{{ route('monhoc.update', $course->course_id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Allow editing Course ID -->
        <div class="form-group">
            <label for="course_id" class="form-label">Course ID:</label>
            <input type="text" name="course_id" id="course_id" class="form-control" value="{{ $course->course_id }}" required>
        </div>

        <div class="form-group">
            <label for="course_name" class="form-label">Course Name:</label>
            <input type="text" name="course_name" id="course_name" class="form-control" value="{{ $course->course_name }}" required>
        </div>
        <div class="form-group">
            <label for="course_description" class="form-label">Description:</label>
            <textarea name="course_description" id="course_description" class="form-control">{{ $course->course_description }}</textarea>
        </div>
        <div class="form-group">
            <label for="credits" class="form-label">Credits:</label>
            <input type="number" name="credits" id="credits" class="form-control" value="{{ $course->credits }}" required min="1">
        </div>
        <div class="form-group">
            <label for="lecturer_id" class="form-label">Select Lecturer (if available):</label>
            <select name="lecturer_id" id="lecturer_id" class="form-control">
                <option value="">-- Select Lecturer --</option>
                @foreach($lecturers as $lecturer)
                    <option value="{{ $lecturer->lecturer_id }}" {{ $course->lecturer_id == $lecturer->lecturer_id ? 'selected' : '' }}>
                        {{ $lecturer->lecturer_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <hr>
        <h4 class="section-title">Schedule</h4>
        @php
            $schedule = $course->schedules->first();
            $dayOfWeek = $schedule ? $schedule->day_of_week : '';
            $startTime = $schedule ? $schedule->start_time : '';
            $endTime = $schedule ? $schedule->end_time : '';
        @endphp
        <div class="form-group">
            <label for="day_of_week" class="form-label">Select Day of Week:</label>
            <select name="day_of_week" id="day_of_week" class="form-control" required>
                <option value="">-- Select Day --</option>
                <option value="1" {{ $dayOfWeek == 1 ? 'selected' : '' }}>Monday</option>
                <option value="2" {{ $dayOfWeek == 2 ? 'selected' : '' }}>Tuesday</option>
                <option value="3" {{ $dayOfWeek == 3 ? 'selected' : '' }}>Wednesday</option>
                <option value="4" {{ $dayOfWeek == 4 ? 'selected' : '' }}>Thursday</option>
                <option value="5" {{ $dayOfWeek == 5 ? 'selected' : '' }}>Friday</option>
                <option value="6" {{ $dayOfWeek == 6 ? 'selected' : '' }}>Saturday</option>
                <option value="7" {{ $dayOfWeek == 7 ? 'selected' : '' }}>Sunday</option>
            </select>
        </div>
        <div class="form-group">
            <label for="start_time" class="form-label">Start Time:</label>
            <input type="time" name="start_time" id="start_time" class="form-control" value="{{ $startTime }}" required>
        </div>
        <div class="form-group">
            <label for="end_time" class="form-label">End Time:</label>
            <input type="time" name="end_time" id="end_time" class="form-control" value="{{ $endTime }}" required>
        </div>

        <hr>
        <h4 class="section-title">Course Major Information</h4>
        @php
            $courseMajor = $course->majors->first();
        @endphp
        <div class="form-group">
            <label class="form-label">Major:</label>
            @error('majors')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="border p-2">
                @foreach($majors as $index => $major)
                    @php
                        $courseMajorItem = $course->majors->firstWhere('major_id', $major->major_id);
                    @endphp
                    <div class="form-group border-bottom pb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                name="majors[{{ $major->major_id }}][active]" value="1" {{ $courseMajorItem ? 'checked' : '' }}>
                            <input type="hidden" name="majors[{{ $major->major_id }}][major_id]"
                                value="{{ $major->major_id }}">
                            <label class="form-check-label">
                                {{ $major->major_name }}
                            </label>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="form-label">Course Type:</label>
                                <select name="majors[{{ $major->major_id }}][is_elective]" class="form-control">
                                    <option value="0" {{ ($courseMajorItem->pivot->is_elective ?? 0) == 0 ? 'selected' : '' }}>Required</option>
                                    <option value="1" {{ ($courseMajorItem->pivot->is_elective ?? 0) == 1 ? 'selected' : '' }}>Elective</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Recommended Semester:</label>
                                <input type="number" name="majors[{{ $major->major_id }}][recommended_semester]" class="form-control" value="{{ $courseMajorItem->pivot->recommended_semester ?? '' }}">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <hr>
        <h4 class="section-title">Prerequisites Information</h4>
        <div class="form-group">
            <label class="form-label">
                <input type="checkbox" name="delete_prerequisites" id="delete_prerequisites" value="1">
                Delete all prerequisites
            </label>
        </div>

        <div id="prerequisites_fields">
            @foreach($course->prerequisites as $index => $prereq)
            <div class="prerequisite-group border p-2 mb-3">
                <div class="form-group">
                    <label class="form-label">Select Applicable Major:</label>
                    <select name="prerequisites[{{ $index }}][major_id]" class="form-control">
                        <option value="">-- Select Major --</option>
                        @foreach($majors as $major)
                            <option value="{{ $major->major_id }}" {{ $prereq->major_id == $major->major_id ? 'selected' : '' }}>
                                {{ $major->major_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Select Prerequisite Course:</label>
                    <select name="prerequisites[{{ $index }}][prerequisite_course_id]" class="form-control">
                        <option value="">-- Select Course --</option>
                        @foreach($coursesList as $courseItem)
                            <option value="{{ $courseItem->course_id }}" {{ $prereq->prerequisite_course_id == $courseItem->course_id ? 'selected' : '' }}>
                                {{ $courseItem->course_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Prerequisite Type:</label>
                    <select name="prerequisites[{{ $index }}][prerequisite_type]" class="form-control">
                        <option value="Required" {{ $prereq->prerequisite_type == 'Required' ? 'selected' : '' }}>Required</option>
                        <option value="Optional" {{ $prereq->prerequisite_type == 'Optional' ? 'selected' : '' }}>Optional</option>
                        <option value="Previous" {{ $prereq->prerequisite_type == 'Previous' ? 'selected' : '' }}>Previous</option>
                    </select>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Button to add new prerequisite -->
        <button type="button" id="add_prerequisite" class="btn btn-sm btn-secondary mb-3">Add Prerequisite</button>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Course</button>
            <a href="{{ route('monhoc.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Add new prerequisite group
    let prerequisiteIndex = {{ count($course->prerequisites) }};
    document.getElementById('add_prerequisite').addEventListener('click', function() {
        const newPrereq = `
        <div class="prerequisite-group border p-2 mb-3">
            <div class="form-group">
                <label class="form-label">Select Applicable Major:</label>
                <select name="prerequisites[${prerequisiteIndex}][major_id]" class="form-control">
                    <option value="">-- Select Major --</option>
                    @foreach($majors as $major)
                        <option value="{{ $major->major_id }}">{{ $major->major_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Select Prerequisite Course:</label>
                <select name="prerequisites[${prerequisiteIndex}][prerequisite_course_id]" class="form-control">
                    <option value="">-- Select Course --</option>
                    @foreach($coursesList as $courseItem)
                        <option value="{{ $courseItem->course_id }}">{{ $courseItem->course_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Prerequisite Type:</label>
                <select name="prerequisites[${prerequisiteIndex}][prerequisite_type]" class="form-control">
                    <option value="Required">Required</option>
                    <option value="Optional">Optional</option>
                    <option value="Previous">Previous</option>
                </select>
            </div>
        </div>`;
        document.getElementById('prerequisites_fields').insertAdjacentHTML('beforeend', newPrereq);
        prerequisiteIndex++;
    });

    // Handle delete prerequisites checkbox
    document.getElementById('delete_prerequisites').addEventListener('change', function () {
        var prereqFields = document.getElementById('prerequisites_fields');
        prereqFields.style.display = this.checked ? 'none' : 'block';
    });
</script>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('template/css/staffs/edit_course.css') }}">
@endpush

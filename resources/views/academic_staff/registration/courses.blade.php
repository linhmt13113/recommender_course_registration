@extends('layouts.apps')

@section('title', 'Select Courses for Semester ' . $semester->semester_id)

@section('content')
<div class="container mt-4">
    <h1>Select Courses for Semester {{ $semester->semester_id }}</h1>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('academic_staff.registration.storeCourses', $semester->id) }}" method="POST">
        @csrf

        {{-- Elective Courses --}}
        <div class="card mb-3">
            <div class="card-header">
                <strong>Elective Courses</strong>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-info" onclick="selectAll('elective')">Select All</button>
                    <button type="button" class="btn btn-sm btn-warning" onclick="deselectAll('elective')">Deselect All</button>
                </div>
                <input type="text" class="form-control search-input" placeholder="Search..." onkeyup="filterTable('electiveTable', this.value)">
            </div>
            <div class="card-body">
                @if($electiveCourses->isNotEmpty())
                <table class="nested-table table table-bordered" id="electiveTable">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>Course ID</th>
                            <th>Course Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($electiveCourses as $cm)
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input elective" name="selected_courses[]" value="{{ $cm->course->course_id }}"
                                {{ in_array($cm->course->course_id, $selectedCourses) ? 'checked' : '' }}>
                            </td>
                            <td>{{ $cm->course->course_id }}</td>
                            <td>{{ $cm->course->course_name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p>No elective courses available.</p>
                @endif
            </div>
        </div>

        {{-- Required Courses - Even Semester --}}
        <div class="card mb-3">
            <div class="card-header">
                <strong>Required Courses – Even Semester</strong>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-info" onclick="selectAll('even')">Select All</button>
                    <button type="button" class="btn btn-sm btn-warning" onclick="deselectAll('even')">Deselect All</button>
                </div>
                <input type="text" class="form-control search-input" placeholder="Search..." onkeyup="filterTable('evenTable', this.value)">
            </div>
            <div class="card-body">
                @if($evenNonElectiveCourses->isNotEmpty())
                <table class="nested-table table table-bordered" id="evenTable">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>Course ID</th>
                            <th>Course Name</th>
                            <th>Suggested Semester</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($evenNonElectiveCourses as $cm)
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input even" name="selected_courses[]" value="{{ $cm->course->course_id }}"
                                {{ in_array($cm->course->course_id, $selectedCourses) ? 'checked' : '' }}>
                            </td>
                            <td>{{ $cm->course->course_id }}</td>
                            <td>{{ $cm->course->course_name }}</td>
                            <td>{{ $cm->recommended_semester }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p>No suitable courses for the even semester.</p>
                @endif
            </div>
        </div>

        {{-- Required Courses - Odd Semester --}}
        <div class="card mb-3">
            <div class="card-header">
                <strong>Required Courses – Odd Semester</strong>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-info" onclick="selectAll('odd')">Select All</button>
                    <button type="button" class="btn btn-sm btn-warning" onclick="deselectAll('odd')">Deselect All</button>
                </div>
                <input type="text" class="form-control search-input" placeholder="Search..." onkeyup="filterTable('oddTable', this.value)">
            </div>
            <div class="card-body">
                @if($oddNonElectiveCourses->isNotEmpty())
                <table class="nested-table table table-bordered" id="oddTable">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>Course ID</th>
                            <th>Course Name</th>
                            <th>Suggested Semester</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($oddNonElectiveCourses as $cm)
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input odd" name="selected_courses[]" value="{{ $cm->course->course_id }}"
                                {{ in_array($cm->course->course_id, $selectedCourses) ? 'checked' : '' }}>
                            </td>
                            <td>{{ $cm->course->course_id }}</td>
                            <td>{{ $cm->course->course_name }}</td>
                            <td>{{ $cm->recommended_semester }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p>No suitable courses for the odd semester.</p>
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save Courses & Open Registration</button>
    </form>

    <a href="{{ route('academic_staff.registration.index') }}" class="btn btn-secondary mt-3">Back to Semester List</a>
</div>
@endsection

@push('scripts')
<script>
    function selectAll(group) {
        document.querySelectorAll('input.' + group).forEach(cb => cb.checked = true);
    }
    function deselectAll(group) {
        document.querySelectorAll('input.' + group).forEach(cb => cb.checked = false);
    }
    function filterTable(tableId, query) {
        const filter = query.toUpperCase();
        const table = document.getElementById(tableId);
        const tr = table.getElementsByTagName("tr");

        for (let i = 1; i < tr.length; i++) {
            const tdArray = tr[i].getElementsByTagName("td");
            let rowText = "";
            for (let j = 0; j < tdArray.length; j++) {
                rowText += tdArray[j].textContent || tdArray[j].innerText;
            }
            tr[i].style.display = rowText.toUpperCase().indexOf(filter) > -1 ? "" : "none";
        }
    }
</script>
@endpush

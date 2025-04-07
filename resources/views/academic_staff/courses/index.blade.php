@extends('layouts.apps')

@section('title', 'Course List')

@section('content')
    <h1>Course Management</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Filter Form -->
    <form method="GET" action="{{ route('staff_courses.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="major_id" class="form-control">
                    <option value="">-- Select Major --</option>
                    @foreach($majors as $major)
                        <option value="{{ $major->major_id }}" {{ request('major_id') == $major->major_id ? 'selected' : '' }}>
                            {{ $major->major_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" name="search" class="form-control search-input"
                    placeholder="Search..."
                    value="{{ request('search') }}"
                    onkeyup="filterTable('electiveTable', this.value)">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('staff_courses.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <a href="{{ route('staff_courses.create') }}" class="btn btn-primary mb-3">Add Course</a>

    <table class="table table-bordered" id="electiveTable">
        <thead>
            <tr>
                <th>Course ID</th>
                <th>Course Name</th>
                <th>Description</th>
                <th>Lecturer</th>
                <th>Schedule</th>
                <th>Credits</th>
                <th>Type</th>
                <th>Recommended Semester</th>
                <th>Prerequisite</th>
                <th>Prerequisite Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->course_id }}</td>
                <td>{{ $course->course_name }}</td>
                <td>
                    @if(isset($course->course_description) && strlen($course->course_description) > 50)
                        <span class="short-description">{{ substr($course->course_description, 0, 50) }}...</span>
                        <a href="javascript:void(0)" class="toggle-desc" onclick="toggleDescription(this)">Show More</a>
                        <span class="full-description" style="display: none;">{{ $course->course_description }}</span>
                    @else
                        {{ $course->course_description ?? 'No description' }}
                    @endif
                </td>
                <td>{{ $course->lecturer ? $course->lecturer->lecturer_name : 'N/A' }}</td>
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
                                @default Not specified
                            @endswitch
                        </div>
                        <div><strong>Start:</strong> {{ $schedule->start_time }}</div>
                        <div><strong>End:</strong> {{ $schedule->end_time }}</div>
                    @else
                        No schedule
                    @endif
                </td>
                <td>{{ $course->credits }}</td>
                <td>{{ $course->course_major ? ($course->course_major->is_elective ? 'Elective' : 'Mandatory') : 'N/A' }}</td>
                <td>{{ $course->course_major ? $course->course_major->recommended_semester : 'N/A' }}</td>
                <td>{{ $course->prerequisite ? $course->prerequisite->prerequisite_course_id : 'N/A' }}</td>
                <td>{{ $course->prerequisite ? $course->prerequisite->prerequisite_type : 'N/A' }}</td>
                <td>
                    <a href="{{ route('staff_courses.edit', $course->course_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('staff_courses.destroy', $course->course_id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $courses->appends(request()->query())->links() }}
@endsection

@push('scripts')
<script>
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

    function toggleDescription(el) {
        const fullDesc = el.nextElementSibling;
        const shortDesc = el.previousElementSibling;
        if (fullDesc.style.display === "none") {
            fullDesc.style.display = "inline";
            el.textContent = "Show Less";
            shortDesc.style.display = "none";
        } else {
            fullDesc.style.display = "none";
            el.textContent = "Show More";
            shortDesc.style.display = "inline";
        }
    }
</script>
@endpush

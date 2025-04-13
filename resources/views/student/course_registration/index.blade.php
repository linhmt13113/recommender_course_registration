@php
    $hideNews = true;
@endphp

@extends('student.dashboard')
@section('title', 'Courses Registration')

@section('content')
    <div class="course-reg-container">
        <h1 class="page-title">Courses registration</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Thông báo ưu tiên đăng ký các môn bắt buộc chưa hoàn thành --}}
        {{-- Priority message for required courses not yet completed --}}
        @if(isset($priorityMessages) && count($priorityMessages) > 0)
            <div class="alert alert-warning">
                <ul class="mb-0">
                    @foreach($priorityMessages as $msg)
                        <li>{{ $msg }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Gợi ý các môn tự chọn dựa trên sở thích --}}
        {{-- Suggested elective courses based on interests --}}
        <h2 class="section-title">Suggested Elective Courses (Top 3) Based on Your Interests</h2>
        @if(session('electiveRecommendations'))
            @php $recommendations = session('electiveRecommendations'); @endphp
            @if(count($recommendations) > 0)
                <div class="table-scroll">
                    <table class="table table-bordered text-center recommendation-table">
                        <thead>
                            <tr>
                                <th>Subject code</th>
                                <th>Subject name</th>
                                <th>Description</th>
                                <th>Cosine Similarity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recommendations as $rec)
                                <tr>
                                    <td>{{ $rec['course_id'] }}</td>
                                    <td>{{ $rec['course_name'] }}</td>
                                    <td>{{ $rec['course_description'] ?? 'N/A' }}</td>
                                    <td>{{ round($rec['score'], 4) }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info" onclick="fillSearch('{{ $rec['course_id'] }}')">
                                            Search
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="no-data-text">No recommendations available.</p>
            @endif
        @else
            <p class="no-data-text">No elective course suggestions. Please save your preferences to receive suggestions.</p>
        @endif

        {{-- Available courses for registration --}}
        {{-- Các môn mở đăng ký --}}
        <h2 class="section-title">Available Courses for Registration</h2>
        <div class="search-box">
            <input type="text" id="searchAvailable" placeholder="Search for courses..." onkeyup="searchAvailableCourses()">
        </div>
        @if($availableCourses->isEmpty())
            <p class="no-data-text">No available courses for registration.</p>
        @else
            <div class="table-scroll">
                <table id="availableCoursesTable" class="table table-bordered available-courses-table text-center">
                    <thead>
                        <tr>
                            <th>Subject code</th>
                            <th>Subject name</th>
                            <th>Credits</th>
                            <th>Lecturer</th>
                            <th>Day</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($availableCourses as $semesterCourse)
                            @php
                                $course = optional($semesterCourse)->course;
                                $schedule = $course ? $course->schedules->first() : null;
                            @endphp
                            <tr>
                                <td>{{ optional($course)->course_id }}</td>
                                <td>{{ optional($course)->course_name }}</td>
                                <td>{{ optional($course)->credits }}</td>
                                <td>{{ optional($course->lecturer)->lecturer_name ?? 'N/A' }}</td>
                                <td>{{ $schedule ? $schedule->day_of_week : 'N/A' }}</td>
                                <td>{{ $schedule ? $schedule->start_time : 'N/A' }}</td>
                                <td>{{ $schedule ? $schedule->end_time : 'N/A' }}</td>
                                <td>
                                    <form action="{{ route('student.course_registration.register') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="course_id" value="{{ optional($course)->course_id }}">
                                        <button type="submit" class="btn btn-sm btn-success">Register</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        {{-- Registered courses --}}
        {{-- Các môn đã đăng ký --}}
        <h2 class="section-title">Registered Courses</h2>
        @if($registeredCourses->isEmpty())
            <p class="no-data-text">You have not registered for any courses yet.</p>
        @else
            <div class="table-scroll">
                <table class="table table-bordered registered-courses-table text-center">
                    <thead>
                        <tr>
                            <th>Subject code</th>
                            <th>Subject name</th>
                            <th>Credits</th>
                            <th>Lecturer</th>
                            <th>Day</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Semester</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registeredCourses as $reg)
                            @php
                                $course = optional($reg->course);
                                $schedule = $course ? $course->schedules->first() : null;
                            @endphp
                            <tr>
                                <td>{{ optional($course)->course_id }}</td>
                                <td>{{ optional($course)->course_name }}</td>
                                <td>{{ optional($course)->credits }}</td>
                                <td>{{ optional($course->lecturer)->lecturer_name ?? 'N/A' }}</td>
                                <td>{{ $schedule ? $schedule->day_of_week : 'N/A' }}</td>
                                <td>{{ $schedule ? $schedule->start_time : 'N/A' }}</td>
                                <td>{{ $schedule ? $schedule->end_time : 'N/A' }}</td>
                                <td>{{ $reg->semester }}</td>
                                <td>{{ $reg->status == '1' || $reg->status == 1 ? 'Successfully Registered' : 'Not Completed' }}</td>
                                <td>
                                    <form action="{{ route('student.course_registration.delete', $reg->course->course_id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        {{-- Required courses for the next semester --}}
        {{-- Các môn bắt buộc cho học kỳ tiếp theo --}}
        <div class="section-separator"></div>
        <h2 class="section-title">The current semester of the student is {{ $currentSemester }}.</h2>
        <h2 class="section-title">Required Courses for Semester {{ $currentSemester + 1 }} :</h2>
        @if($requiredNextSemesterCourses->isEmpty())
            <p class="no-data-text">No required courses for registration.</p>
        @else
            <div class="table-scroll">
                <table class="table table-bordered required-courses-table text-center">
                    <thead>
                        <tr>
                            <th>Subject code</th>
                            <th>Subject name</th>
                            <th>Credits</th>
                            <th>Suggested Semester</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requiredNextSemesterCourses as $item)
                            @php
                                $course = optional($item->course);
                            @endphp
                            <tr>
                                <td>{{ optional($course)->course_id }}</td>
                                <td>{{ optional($course)->course_name }}</td>
                                <td>{{ optional($course)->credits }}</td>
                                <td>{{ $item->recommended_semester }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" onclick="fillSearch('{{ optional($course)->course_id }}')">
                                        Search
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        {{-- Elective courses --}}
        {{-- Các môn tự chọn --}}
        <h2 class="section-title">Elective Courses</h2>
        @if($electiveCourses->isEmpty())
            <p class="no-data-text">No elective courses available for registration.</p>
        @else
            <div class="table-scroll">
                <table class="table table-bordered elective-courses-table text-center">
                    <thead>
                        <tr>
                            <th>Subject code</th>
                            <th>Subject name</th>
                            <th>Credits</th>
                            <th>Prerequisite Subject ID</th>
                            <th>Prerequisite Subject Name</th>
                            <th>Prerequisite Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($electiveCourses as $item)
                            @php
                                $course = optional($item->course);
                                $prereqId = optional($course->prerequisite)->prerequisite_course_id;
                                $prereq = $course->prerequisite;
                                $prereqCourseName = optional(optional($course->prerequisite)->prerequisiteCourse)->course_name;
                                $prereqType = $prereq ? $prereq->prerequisite_type : '';
                            @endphp
                            <tr>
                                <td>{{ optional($course)->course_id }}</td>
                                <td>{{ optional($course)->course_name }}</td>
                                <td>{{ optional($course)->credits }}</td>
                                <td>{{ $prereqId ?? '' }}</td>
                                <td>{{ $prereqCourseName ?? '' }}</td>
                                <td>{{ $prereqType  }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        {{-- Preferences form --}}
        {{-- Form lưu sở thích (Preferences) --}}
        <div class="section-separator"></div>
        <h2 class="section-title">Save Your Preferences</h2>
        <form action="{{ route('student.course_registration.preferences') }}" method="POST" class="preferences-form">
            @csrf
            <!-- Question 1 -->
            <div class="form-group">
                <label for="q1_project_description">
                    Question 1: Briefly describe your ideal future project (e.g., "Build an AI system to detect fraudulent transactions", "Design an educational VR game", ...):
                </label>
                <textarea name="q1_project_description" id="q1_project_description" cols="50" rows="3" class="form-control">{{ old('q1_project_description') }}</textarea>
            </div>

            <!-- Question 2 -->
            <div class="form-group">
                <label>Question 2: Which tools/technologies do you prefer to work with?</label>
                @foreach([
                    'Python or R' => 'Python or R',
                    'PyCharm or Visual Studio' => 'PyCharm or Visual Studio',
                    'TensorFlow or PyTorch' => 'TensorFlow or PyTorch for AI',
                    'AWS or Google Cloud' => 'AWS or Google Cloud',
                    'Unity or Unreal Engine' => 'Unity or Unreal Engine',
                    'SQL or NoSQL' => 'SQL or NoSQL',
                    'Wireshark or Postman' => 'Wireshark or Postman',
                    'Docker or Kubernetes' => 'Docker or Kubernetes'
                ] as $key => $label)
                    <div class="form-check">
                        <input type="checkbox" name="q2_tools[]" value="{{ $key }}"
                            {{ (is_array(old('q2_tools')) && in_array($key, old('q2_tools'))) ? 'checked' : '' }}
                            class="form-check-input">
                        <label class="form-check-label">{{ $key }}</label>
                    </div>
                @endforeach
                <div class="form-group">
                    <label for="q2_other_tools">Other (please specify your tool):</label>
                    <input type="text" name="q2_other_tools" id="q2_other_tools" value="{{ old('q2_other_tools') }}" class="form-control" style="width:300px;">
                </div>
            </div>

            <!-- Question 3 -->
            <div class="form-group">
                <label for="q3_interested_skills">
                    Question 3: Name 2-3 subjects or skills you are most passionate about at university (e.g., "Game programming", "Data analysis", "Computer networks", ...):
                </label>
                <textarea name="q3_interested_skills" id="q3_interested_skills" cols="50" rows="3" class="form-control">{{ old('q3_interested_skills') }}</textarea>
            </div>

            <!-- Question 4 -->
            <div class="form-group">
                <label for="q4_desired_skill">Question 4: Which skill do you most want to learn?</label>
                <select name="q4_desired_skill" id="q4_desired_skill" class="form-control" style="width:300px;">
                    <option value="">-- Select a skill --</option>
                    <option value="Build data mining algorithms" {{ old('q4_desired_skill') == 'Build data mining algorithms' ? 'selected' : '' }}>Build data mining algorithms</option>
                    <option value="Design distributed systems (Cloud, Distributed Systems)" {{ old('q4_desired_skill') == 'Design distributed systems (Cloud, Distributed Systems)' ? 'selected' : '' }}>Design distributed systems (Cloud, Distributed Systems)</option>
                    <option value="Develop AR or VR applications" {{ old('q4_desired_skill') == 'Develop AR or VR applications' ? 'selected' : '' }}>Develop AR or VR applications</option>
                    <option value="Implement virtual networks (VPN, IPSec)" {{ old('q4_desired_skill') == 'Implement virtual networks (VPN, IPSec)' ? 'selected' : '' }}>Implement virtual networks (VPN, IPSec)</option>
                    <option value="Create data visualization dashboards (Tableau, Power BI)" {{ old('q4_desired_skill') == 'Create data visualization dashboards (Tableau, Power BI)' ? 'selected' : '' }}>Create data visualization dashboards (Tableau, Power BI)</option>
                </select>
            </div>

            <!-- Question 5 -->
            <div class="form-group">
                <label>Question 5: Which activity would you like to spend most of your time on?</label>
                @foreach([
                    'Write image or graphics processing algorithms' => 'Write image or graphics processing algorithms',
                    'Design software architecture (UML)' => 'Design software architecture (UML)',
                    'Debug and test software' => 'Debug and test software',
                    'Build network protocols (TCP/IP, HTTP)' => 'Build network protocols (TCP/IP, HTTP)',
                    'Research blockchain applications' => 'Research blockchain applications',
                    'Develop cross-platform mobile applications' => 'Develop cross-platform mobile applications'
                ] as $key => $label)
                    <div class="form-check">
                        <input type="checkbox" name="q5_time_activity[]" value="{{ $key }}"
                            {{ (is_array(old('q5_time_activity')) && in_array($key, old('q5_time_activity'))) ? 'checked' : '' }}
                            class="form-check-input">
                        <label class="form-check-label">{{ $key }}</label>
                    </div>
                @endforeach
                <div class="form-group">
                    <label for="q5_other_activity">Other (please specify your activity):</label>
                    <input type="text" name="q5_other_activity" id="q5_other_activity" value="{{ old('q5_other_activity') }}" class="form-control" style="width:300px;">
                </div>
            </div>

            <!-- Question 6 -->
            <div class="form-group">
                <label for="q6_other_interest">Question 6: Do you have any other interests or passions in technology?</label>
                <textarea name="q6_other_interest" id="q6_other_interest" cols="50" rows="3" class="form-control">{{ old('q6_other_interest') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary submit-btn">Save Preferences</button>
        </form>
    </div>

    {{-- Đặt JS trực tiếp trong section content --}}
    <script>
        // Function to filter available courses by search keyword
        function searchAvailableCourses() {
            var input = document.getElementById("searchAvailable");
            var filter = input.value.toUpperCase();
            var table = document.getElementById("availableCoursesTable");
            var tr = table.getElementsByTagName("tr");

            // Loop through table rows, skipping the header row
            for (var i = 1; i < tr.length; i++) {
                var rowVisible = false;
                var td = tr[i].getElementsByTagName("td");
                // Check each cell in the row
                for (var j = 0; j < td.length; j++) {
                    if (td[j]) {
                        var txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            rowVisible = true;
                            break;
                        }
                    }
                }
                tr[i].style.display = rowVisible ? "" : "none";
            }
        }

        // Function to fill search input with given courseId and filter courses
        function fillSearch(courseId) {
            var input = document.getElementById("searchAvailable");
            input.value = courseId;
            searchAvailableCourses();
        }
    </script>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('template/css/students/index_course_registration.css') }}">
@endpush





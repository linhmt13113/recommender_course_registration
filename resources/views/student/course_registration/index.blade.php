@php
    $hideNews = true;
@endphp

@extends('student.dashboard')

@section('content')
    <h1>Đăng ký môn học</h1>

    {{-- Thông báo thành công hoặc lỗi --}}
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Hiển thị thông báo ưu tiên đăng ký các môn bắt buộc chưa hoàn thành --}}
    @if(isset($priorityMessages) && count($priorityMessages) > 0)
        <div style="color: orange;">
            <ul>
                @foreach($priorityMessages as $msg)
                    <li>{{ $msg }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Phần gợi ý các môn tự chọn dựa trên sở thích --}}
    <h2>Gợi ý các môn tự chọn (Top 3) dựa trên sở thích của bạn</h2>
    @if(session('electiveRecommendations'))
        @php $recommendations = session('electiveRecommendations'); @endphp
        @if(count($recommendations) > 0)
            <table style="border: 1px solid black; border-collapse: collapse;" cellpadding="5">
                <thead>
                    <tr>
                        <th>Mã môn</th>
                        <th>Tên môn</th>
                        <th>Mô tả</th>
                        <th>Cosine Similarity</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recommendations as $rec)
                        <tr>
                            <td>{{ $rec['course_id'] }}</td>
                            <td>{{ $rec['course_name'] }}</td>
                            <td>
                                {{ $rec['course_description'] ?? 'N/A' }}
                            </td>
                            <td>{{ round($rec['score'], 4) }}</td>
                            <td>
                                <!-- Nút tìm ngay: gọi JS để điền tên môn vào ô tìm kiếm -->
                                <button type="button" onclick="fillSearch('{{ $rec['course_id'] }}')">Tìm ngay</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Không có gợi ý nào.</p>
        @endif
    @else
        <p>Chưa có gợi ý môn tự chọn. Hãy lưu sở thích để nhận gợi ý.</p>
    @endif

    {{-- Ô tìm kiếm cho phần "Các môn mở đăng ký" --}}
    <h2>Các môn mở đăng ký</h2>
    <input type="text" id="searchAvailable" placeholder="Tìm kiếm môn học..." onkeyup="searchAvailableCourses()"
        style="width: 300px; margin-bottom: 10px;" />

    @if($availableCourses->isEmpty())
        <p>Không có môn học nào mở đăng ký.</p>
    @else
        <table id="availableCoursesTable" style="border: 1px solid black; border-collapse: collapse; width: 100%;"
            cellpadding="5">
            <thead>
                <tr>
                    <th>Mã môn</th>
                    <th>Tên môn</th>
                    <th>Tín chỉ</th>
                    <th>Giảng viên</th>
                    <th>Thứ</th>
                    <th>Bắt đầu</th>
                    <th>Kết thúc</th>
                    <th>Hành động</th>
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
                                <button type="submit">Đăng ký</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h2>Các môn đã đăng ký</h2>
    @if($registeredCourses->isEmpty())
        <p>Chưa đăng ký môn học nào.</p>
    @else
        <table style="border: 1px solid black; border-collapse: collapse; width: 100%;" cellpadding="5">
            <thead>
                <tr>
                    <th>Mã môn</th>
                    <th>Tên môn</th>
                    <th>Tín chỉ</th>
                    <th>Giảng viên</th>
                    <th>Thứ</th>
                    <th>Bắt đầu</th>
                    <th>Kết thúc</th>
                    <th>Học kỳ</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
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
                        <td>{{ $reg->status == '1' || $reg->status == 1 ? 'Đã đăng ký thành công' : 'Chưa hoàn thành' }}</td>
                        <td>
                            <form action="{{ route('student.course_registration.delete', $reg->course->course_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Hủy đăng ký</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h2>Học kỳ hiện tại của sinh viên là {{ $currentSemester }}.</h2>
    <h2>Các môn bắt buộc cho học kỳ {{ $currentSemester + 1 }} bao gồm:</h2>
    @if($requiredNextSemesterCourses->isEmpty())
        <p>Không có môn bắt buộc nào cần đăng ký.</p>
    @else
        <table style="border: 1px solid black; border-collapse: collapse; width: 100%;" cellpadding="5">
            <thead>
                <tr>
                    <th>Mã môn</th>
                    <th>Tên môn</th>
                    <th>Tín chỉ</th>
                    <th>Học kỳ đề nghị</th>
                    <th>Hành động</th>
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
                            <!-- Nút tìm ngay: gọi JS để điền tên môn vào ô tìm kiếm -->
                            <button type="button" onclick="fillSearch('{{ optional($course)->course_id }}')">Tìm ngay</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h2>Các môn tự chọn</h2>
    @if($electiveCourses->isEmpty())
        <p>Không có môn tự chọn nào cần đăng ký.</p>
    @else
        <table style="border: 1px solid black; border-collapse: collapse; width: 100%;" cellpadding="5">
            <thead>
                <tr>
                    <th>Mã môn</th>
                    <th>Tên môn</th>
                    <th>Tín chỉ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($electiveCourses as $item)
                    @php
                        $course = optional($item->course);
                    @endphp
                    <tr>
                        <td>{{ optional($course)->course_id }}</td>
                        <td>{{ optional($course)->course_name }}</td>
                        <td>{{ optional($course)->credits }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h2>Save Your Preferences</h2>
    <form action="{{ route('student.course_registration.preferences') }}" method="POST">
        @csrf
        <!-- Question 1 -->
        <div style="margin-bottom: 20px;">
            <label for="q1_project_description">
                Question 1: Briefly describe your ideal future project
                (e.g., "Build an AI system to detect fraudulent transactions", "Design an educational VR game", ...):
            </label><br>
            <textarea name="q1_project_description" id="q1_project_description" cols="50" rows="3">{{ old('q1_project_description') }}</textarea>
        </div>

        <!-- Question 2 -->
        <div style="margin-bottom: 20px;">
            <label>
                Question 2: Which tools/technologies do you prefer to work with?
            </label><br>
            @foreach([
                'Python/R' => 'Python/R',
                'PyCharm/Visual Studio' => 'PyCharm/Visual Studio ',
                'TensorFlow/PyTorch' => 'TensorFlow/PyTorch for AI',
                'AWS/Google Cloud' => 'AWS/Google Cloud ',
                'Unity/Unreal Engine' => 'Unity/Unreal Engine ',
                'SQL/NoSQL' => 'SQL/NoSQL ',
                'Wireshark/Postman' => 'Wireshark/Postman ',
                'Docker/Kubernetes' => 'Docker/Kubernetes '
            ] as $key => $fullLabel)
                <label>
                    <input type="checkbox" name="q2_tools[]" value="{{ $key }}"
                        {{ (is_array(old('q2_tools')) && in_array($key, old('q2_tools'))) ? 'checked' : '' }}>
                    {{ $key }}
                </label><br>
            @endforeach
            <label for="q2_other_tools">Other (please specify your tool):</label>
            <input type="text" name="q2_other_tools" id="q2_other_tools" value="{{ old('q2_other_tools') }}" style="width: 300px;">
        </div>

        <!-- Question 3 -->
        <div style="margin-bottom: 20px;">
            <label for="q3_interested_skills">
                Question 3: Name 2-3 subjects/skills you are most passionate about at university
                (e.g., "Game programming", "Data analysis", "Computer networks", ...):
            </label><br>
            <textarea name="q3_interested_skills" id="q3_interested_skills" cols="50" rows="3">{{ old('q3_interested_skills') }}</textarea>
        </div>

        <!-- Question 4 -->
        <div style="margin-bottom: 20px;">
            <label for="q4_desired_skill">
                Question 4: Which skill do you most want to learn?
            </label><br>
            <select name="q4_desired_skill" id="q4_desired_skill" style="width:300px;">
                <option value="">-- Select a skill --</option>
                <option value="Build data mining algorithms" {{ old('q4_desired_skill') == 'Build data mining algorithms' ? 'selected' : '' }}>Build data mining algorithms</option>
                <option value="Design distributed systems (Cloud, Distributed Systems)" {{ old('q4_desired_skill') == 'Design distributed systems (Cloud, Distributed Systems)' ? 'selected' : '' }}>Design distributed systems (Cloud, Distributed Systems)</option>
                <option value="Develop AR/VR applications" {{ old('q4_desired_skill') == 'Develop AR/VR applications' ? 'selected' : '' }}>Develop AR/VR applications</option>
                <option value="Implement virtual networks (VPN, IPSec)" {{ old('q4_desired_skill') == 'Implement virtual networks (VPN, IPSec)' ? 'selected' : '' }}>Implement virtual networks (VPN, IPSec)</option>
                <option value="Create data visualization dashboards (Tableau, Power BI)" {{ old('q4_desired_skill') == 'Create data visualization dashboards (Tableau, Power BI)' ? 'selected' : '' }}>Create data visualization dashboards (Tableau, Power BI)</option>
            </select>
        </div>

        <!-- Question 5 -->
        <div style="margin-bottom: 20px;">
            <label>
                Question 5: Which activity would you like to spend most of your time on?
            </label><br>
            @foreach([
                'Write image/graphics processing algorithms' => 'Write image/graphics processing algorithms',
                'Design software architecture (UML)' => 'Design software architecture (UML)',
                'Debug and test software' => 'Debug and test software',
                'Build network protocols (TCP/IP, HTTP)' => 'Build network protocols (TCP/IP, HTTP)',
                'Research blockchain applications' => 'Research blockchain applications',
                'Develop cross-platform mobile applications' => 'Develop cross-platform mobile applications'
            ] as $key => $label)
                <label>
                    <input type="checkbox" name="q5_time_activity[]" value="{{ $key }}"
                        {{ (is_array(old('q5_time_activity')) && in_array($key, old('q5_time_activity'))) ? 'checked' : '' }}>
                    {{ $key }}
                </label><br>
            @endforeach
            <label for="q5_other_activity">Other (please specify your activity):</label>
            <input type="text" name="q5_other_activity" id="q5_other_activity" value="{{ old('q5_other_activity') }}" style="width: 300px;">
        </div>

        <!-- Question 6 -->
        <div style="margin-bottom: 20px;">
            <label for="q6_other_interest">
                Question 6: Do you have any other interests or passions in technology?
            </label><br>
            <textarea name="q6_other_interest" id="q6_other_interest" cols="50" rows="3">{{ old('q6_other_interest') }}</textarea>
        </div>

        <button type="submit">Save Preferences</button>
    </form>


    <script>
        // Hàm lọc các môn mở đăng ký theo từ khóa nhập vào ô tìm kiếm
        function searchAvailableCourses() {
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById("searchAvailable");
            filter = input.value.toUpperCase();
            table = document.getElementById("availableCoursesTable");
            tr = table.getElementsByTagName("tr");

            // Lặp qua từng hàng trong bảng (bắt đầu từ hàng thứ 2, bỏ qua header)
            for (i = 1; i < tr.length; i++) {
                var rowVisible = false;
                td = tr[i].getElementsByTagName("td");
                // Lặp qua từng cột trong hàng
                for (j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            rowVisible = true;
                            break;
                        }
                    }
                }
                tr[i].style.display = rowVisible ? "" : "none";
            }
        }

        // Hàm điền giá trị vào ô tìm kiếm và kích hoạt hàm lọc
        function fillSearch(courseId) {
            var input = document.getElementById("searchAvailable");
            input.value = courseId;
            searchAvailableCourses();
        }
    </script>


@endsection

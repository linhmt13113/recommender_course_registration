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
                        <th>Độ tương đồng (Cosine Similarity)</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recommendations as $rec)
                        <tr>
                            <td>{{ $rec['course_id'] }}</td>
                            <td>{{ $rec['course_name'] }}</td>
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

    <h2>Lưu sở thích môn học</h2>
    <form action="{{ route('student.course_registration.preferences') }}" method="POST">
        @csrf
        <div>
            <label for="preference_text">Nhập sở thích của bạn:</label><br>
            <textarea name="preference_text" id="preference_text" cols="50" rows="5">{{ old('preference_text') }}</textarea>
        </div>
        <div style="margin-top: 10px;">
            <label for="preference_select">Chọn sở thích từ danh sách (có thể chọn nhiều):</label><br>
            <select name="preference_select[]" id="preference_select" multiple style="width:300px;">
                <option value="Sáng tạo">Sáng tạo</option>
                <option value="Tư duy logic">Tư duy logic</option>
                <option value="Khám phá">Khám phá</option>
                <option value="Kinh doanh">Kinh doanh</option>
                <option value="Nghiên cứu khoa học">Nghiên cứu khoa học</option>
            </select>
        </div>
        <button type="submit">Lưu sở thích</button>
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

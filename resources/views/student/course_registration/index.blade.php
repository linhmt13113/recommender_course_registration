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

    <h2>Các môn mở đăng ký</h2>
    @if($availableCourses->isEmpty())
        <p>Không có môn học nào mở đăng ký.</p>
    @else
        <table style="border: 1px solid black; border-collapse: collapse;" cellpadding="5">
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
                        // Lấy thông tin course từ semesterCourse, nếu chưa có sẽ là null
                        $course = optional($semesterCourse)->course;
                        // Lấy lịch học đầu tiên của course nếu tồn tại, ngược lại null.
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
        <table style="border: 1px solid black; border-collapse: collapse;" cellpadding="5">
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
                        // Lấy thông tin course từ registration
                        $course = optional($reg->course);
                        // Lấy lịch học đầu tiên của course, nếu có
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


    <h2>Học kỳ hiện tại của sinh viên là {{ $currentSemester }}. </h2>
    <h2>Các môn bắt buộc cho học kỳ {{ $currentSemester + 1 }} bao gồm:</h2>
    @if($requiredNextSemesterCourses->isEmpty())
        <p>Không có môn bắt buộc nào cần đăng ký.</p>
    @else
        <table style="border: 1px solid black; border-collapse: collapse;" cellpadding="5">
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
                    <tr>
                        <td>{{ optional($item->course)->course_id }}</td>
                        <td>{{ optional($item->course)->course_name }}</td>
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
        <table style="border: 1px solid black; border-collapse: collapse;" cellpadding="5">
            <thead>
                <tr>
                    <th>Mã môn</th>
                    <th>Tên môn</th>
                    <th>Tín chỉ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($electiveCourses as $item)
                    <tr>
                        <td>{{ optional($item->course)->course_id }}</td>
                        <td>{{ optional($item->course)->course_name }}</td>
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
            <label for="preferences">Sở thích của bạn với các môn học:</label><br>
            <textarea name="preferences" id="preferences" cols="50" rows="5">{{ old('preferences') }}</textarea>
        </div>
        <button type="submit">Lưu sở thích</button>
    </form>

    <h1>Gợi ý các môn tự chọn dựa trên sở thích của bạn</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(empty($topCourses))
        <p>Không có gợi ý nào.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã môn</th>
                    <th>Tên môn</th>
                    <th>Độ tương đồng (Cosine Similarity)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topCourses as $course)
                    <tr>
                        <td>{{ $course['course_id'] }}</td>
                        <td>{{ $course['course_name'] }}</td>
                        <td>{{ round($course['score'], 4) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection

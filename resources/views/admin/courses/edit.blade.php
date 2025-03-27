<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sửa Môn học</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container mt-4">
        <h1>Sửa Môn học</h1>

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

            <!-- Cho phép chỉnh sửa mã môn học -->
            <div class="form-group">
                <label for="course_id">Mã Môn học:</label>
                <input type="text" name="course_id" id="course_id" class="form-control" value="{{ $course->course_id }}"
                    required>
            </div>

            <div class="form-group">
                <label for="course_name">Tên Môn học:</label>
                <input type="text" name="course_name" id="course_name" class="form-control"
                    value="{{ $course->course_name }}" required>
            </div>
            <div class="form-group">
                <label for="course_description">Mô tả:</label>
                <textarea name="course_description" id="course_description"
                    class="form-control">{{ $course->course_description }}</textarea>
            </div>
            <div class="form-group">
                <label for="credits">Số tín chỉ:</label>
                <input type="number" name="credits" id="credits" class="form-control" value="{{ $course->credits }}"
                    required min="1">
            </div>
            <div class="form-group">
                <label for="lecturer_id">Chọn Giảng viên (nếu có):</label>
                <select name="lecturer_id" id="lecturer_id" class="form-control">
                    <option value="">-- Chọn Giảng viên --</option>
                    @foreach($lecturers as $lecturer)
                        <option value="{{ $lecturer->lecturer_id }}" {{ $course->lecturer_id == $lecturer->lecturer_id ? 'selected' : '' }}>
                            {{ $lecturer->lecturer_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <hr>
            <h4>Lịch học</h4>
            @php
                $schedule = $course->schedules->first();
                $dayOfWeek = $schedule ? $schedule->day_of_week : '';
                $startTime = $schedule ? $schedule->start_time : '';
                $endTime = $schedule ? $schedule->end_time : '';
            @endphp
            <div class="form-group">
                <label for="day_of_week">Chọn ngày trong tuần:</label>
                <select name="day_of_week" id="day_of_week" class="form-control" required>
                    <option value="">-- Chọn ngày --</option>
                    <option value="1" {{ $dayOfWeek == 1 ? 'selected' : '' }}>Thứ 2</option>
                    <option value="2" {{ $dayOfWeek == 2 ? 'selected' : '' }}>Thứ 3</option>
                    <option value="3" {{ $dayOfWeek == 3 ? 'selected' : '' }}>Thứ 4</option>
                    <option value="4" {{ $dayOfWeek == 4 ? 'selected' : '' }}>Thứ 5</option>
                    <option value="5" {{ $dayOfWeek == 5 ? 'selected' : '' }}>Thứ 6</option>
                    <option value="6" {{ $dayOfWeek == 6 ? 'selected' : '' }}>Thứ 7</option>
                    <option value="7" {{ $dayOfWeek == 7 ? 'selected' : '' }}>Chủ nhật</option>
                </select>
            </div>
            <div class="form-group">
                <label for="start_time">Giờ bắt đầu:</label>
                <input type="time" name="start_time" id="start_time" class="form-control" value="{{ $startTime }}"
                    required>
            </div>
            <div class="form-group">
                <label for="end_time">Giờ kết thúc:</label>
                <input type="time" name="end_time" id="end_time" class="form-control" value="{{ $endTime }}" required>
            </div>

            <hr>
            <h4>Thông tin Chuyên ngành (Course Major)</h4>
            @php
                $courseMajorMajorId = isset($courseMajor) ? $courseMajor->major_id : '';
                $isElective = isset($courseMajor) ? $courseMajor->is_elective : 0;
                $recommendedSemester = isset($courseMajor) ? $courseMajor->recommended_semester : '';
            @endphp
            <div class="form-group">
                <label for="course_major_major_id">Chọn Chuyên ngành:</label>
                <select name="course_major_major_id" id="course_major_major_id" class="form-control">
                    <option value="">-- Chọn chuyên ngành --</option>
                    @foreach($majors as $major)
                        <option value="{{ $major->major_id }}" {{ $courseMajorMajorId == $major->major_id ? 'selected' : '' }}>
                            {{ $major->major_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="is_elective">Loại môn học:</label>
                <select name="is_elective" id="is_elective" class="form-control">
                    <option value="0" {{ $isElective == 0 ? 'selected' : '' }}>Bắt buộc</option>
                    <option value="1" {{ $isElective == 1 ? 'selected' : '' }}>Tự chọn</option>
                </select>
            </div>
            <div class="form-group">
                <label for="recommended_semester">Học kỳ đề xuất:</label>
                <input type="number" name="recommended_semester" id="recommended_semester" class="form-control"
                    value="{{ $recommendedSemester }}">
            </div>

            <hr>
            <h4>Thông tin Tiên quyết (Prerequisites)</h4>
            <!-- Checkbox để chọn xóa hết thông tin tiên quyết -->
            <div class="form-group">
                <label>
                    <input type="checkbox" name="delete_prerequisites" id="delete_prerequisites" value="1">
                    Xóa hết thông tin tiên quyết (không có prerequisites)
                </label>
            </div>

            <!-- Các trường nhập cho prerequisites; bao bọc trong div để có thể ẩn khi chọn checkbox -->
            <div id="prerequisites_fields">
                <div class="form-group">
                    <label for="prerequisite_major_id">Chọn Chuyên ngành áp dụng:</label>
                    <select name="prerequisite_major_id" id="prerequisite_major_id" class="form-control">
                        <option value="">-- Chọn chuyên ngành --</option>
                        @foreach($majors as $major)
                            <option value="{{ $major->major_id }}" {{ (isset($prereqMajorId) && $prereqMajorId == $major->major_id) ? 'selected' : '' }}>
                                {{ $major->major_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="prerequisite_course_id">Chọn Môn học tiên quyết:</label>
                    <select name="prerequisite_course_id" id="prerequisite_course_id" class="form-control">
                        <option value="">-- Chọn Môn học tiên quyết --</option>
                        @foreach($coursesList as $courseItem)
                            <option value="{{ $courseItem->course_id }}" {{ (isset($prereqCourseId) && $prereqCourseId == $courseItem->course_id) ? 'selected' : '' }}>
                                {{ $courseItem->course_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="prerequisite_type">Loại tiên quyết:</label>
                    <select name="prerequisite_type" id="prerequisite_type" class="form-control">
                        <option value="Required" {{ (isset($prereqType) && $prereqType == 'Required') ? 'selected' : '' }}>Bắt buộc</option>
                        <option value="Optional" {{ (isset($prereqType) && $prereqType == 'Optional') ? 'selected' : '' }}>Tùy chọn</option>
                        <option value="Previous" {{ (isset($prereqType) && $prereqType == 'Previous') ? 'selected' : '' }}>Trước</option>
                    </select>
                </div>
            </div>

            <script>
                // Nếu checkbox "Xóa hết thông tin tiên quyết" được chọn, ẩn các trường nhập
                document.getElementById('delete_prerequisites').addEventListener('change', function(){
                    var prereqFields = document.getElementById('prerequisites_fields');
                    if(this.checked) {
                        prereqFields.style.display = 'none';
                    } else {
                        prereqFields.style.display = 'block';
                    }
                });
            </script>

            <button type="submit" class="btn btn-primary">Cập nhật Môn học</button>
            <a href="{{ route('monhoc.index') }}" class="btn btn-secondary">Trở về danh sách</a>

        </form>
    </div>
</body>

</html>

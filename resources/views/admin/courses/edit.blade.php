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

        <!-- Hiển thị mã môn học (không chỉnh sửa) -->
        <div class="form-group">
            <label>Mã Môn học:</label>
            <input type="text" class="form-control" value="{{ $course->course_id }}" disabled>
        </div>

        <div class="form-group">
            <label for="course_name">Tên Môn học:</label>
            <input type="text" name="course_name" id="course_name" class="form-control" value="{{ $course->course_name }}" required>
        </div>
        <div class="form-group">
            <label for="course_description">Mô tả:</label>
            <textarea name="course_description" id="course_description" class="form-control">{{ $course->course_description }}</textarea>
        </div>
        <div class="form-group">
            <label for="lecturer_id">Chọn Giảng viên (nếu có):</label>
            <select name="lecturer_id" id="lecturer_id" class="form-control">
                <option value="">-- Chọn Giảng viên --</option>
                @foreach($lecturers as $lecturer)
                    <option value="{{ $lecturer->lecturer_id }}"
                        {{ $course->lecturer_id == $lecturer->lecturer_id ? 'selected' : '' }}>
                        {{ $lecturer->lecturer_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <hr>
        <h4>Lịch học</h4>
        @php
            // Giả sử mỗi môn học chỉ có 1 lịch học chính.
            // Nếu chưa có lịch học, ta set các biến rỗng.
            $schedule = $course->schedules->first();
            $dayOfWeek  = $schedule ? $schedule->day_of_week : '';
            $startTime  = $schedule ? $schedule->start_time : '';
            $endTime    = $schedule ? $schedule->end_time : '';
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
            <input type="time" name="start_time" id="start_time" class="form-control" value="{{ $startTime }}" required>
        </div>
        <div class="form-group">
            <label for="end_time">Giờ kết thúc:</label>
            <input type="time" name="end_time" id="end_time" class="form-control" value="{{ $endTime }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật Môn học</button>
    </form>
</div>
</body>
</html>

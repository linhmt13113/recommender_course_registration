<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm Môn học</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container mt-4">
        <h1>Thêm Môn học</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('monhoc.store') }}" method="POST">
            @csrf

            <!-- Thêm input nhập mã môn học -->
            <div class="form-group">
                <label for="course_id">Mã Môn học:</label>
                <input type="text" name="course_id" id="course_id" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="course_name">Tên Môn học:</label>
                <input type="text" name="course_name" id="course_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="credits">Số tín chỉ:</label>
                <input type="number" name="credits" id="credits" class="form-control" required min="1">
            </div>
            <div class="form-group">
                <label for="course_description">Mô tả:</label>
                <textarea name="course_description" id="course_description" class="form-control"></textarea>
            </div>


            <div class="form-group">
                <label for="lecturer_id">Chọn Giảng viên (nếu có):</label>
                <select name="lecturer_id" id="lecturer_id" class="form-control">
                    <option value="">-- Chọn Giảng viên --</option>
                    @foreach($lecturers as $lecturer)
                        <option value="{{ $lecturer->lecturer_id }}">{{ $lecturer->lecturer_name }}</option>
                    @endforeach
                </select>
            </div>

            <hr>
            <h4>Lịch học</h4>
            <div class="form-group">
                <label for="day_of_week">Chọn ngày trong tuần:</label>
                <select name="day_of_week" id="day_of_week" class="form-control" required>
                    <option value="">-- Chọn ngày --</option>
                    <option value="1">Thứ 2</option>
                    <option value="2">Thứ 3</option>
                    <option value="3">Thứ 4</option>
                    <option value="4">Thứ 5</option>
                    <option value="5">Thứ 6</option>
                    <option value="6">Thứ 7</option>
                    <option value="7">Chủ nhật</option>
                </select>
            </div>
            <div class="form-group">
                <label for="start_time">Giờ bắt đầu:</label>
                <input type="time" name="start_time" id="start_time" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="end_time">Giờ kết thúc:</label>
                <input type="time" name="end_time" id="end_time" class="form-control" required>
            </div>

            <hr>
            <h4>Thông tin Chuyên ngành (Course Major)</h4>
            <div class="form-group">
                <label >Chọn Chuyên ngành:</label>
                <div class="border p-2" style="max-height: 200px; overflow-y: auto;">
                    @foreach($majors as $major)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="majors[]"
                                id="major_{{ $major->major_id }}" value="{{ $major->major_id }}">
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
                <label for="is_elective">Loại môn học:</label>
                <select name="is_elective" id="is_elective" class="form-control">
                    <option value="0">Bắt buộc</option>
                    <option value="1">Tự chọn</option>
                </select>
            </div>
            <div class="form-group">
                <label for="recommended_semester">Học kỳ đề xuất:</label>
                <input type="number" name="recommended_semester" id="recommended_semester" class="form-control">
            </div>

            <hr>
            <h4>Thông tin Tiên quyết (Prerequisites)</h4>
            <!-- Checkbox để chọn không có tiên quyết -->
            <div class="form-group">
                <label>
                    <input type="checkbox" name="no_prerequisites" id="no_prerequisites" value="1">
                    Không có tiên quyết
                </label>
            </div>

            <!-- Các trường nhập cho prerequisites; chúng ta bao bọc chúng trong 1 div để có thể ẩn khi checkbox được chọn -->
            <div id="prerequisites_fields">
                <div class="form-group">
                    <label for="prerequisite_major_id">Chọn Chuyên ngành áp dụng:</label>
                    <select name="prerequisite_major_id" id="prerequisite_major_id" class="form-control">
                        <option value="">-- Chọn chuyên ngành --</option>
                        @foreach($majors as $major)
                            <option value="{{ $major->major_id }}">{{ $major->major_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="prerequisite_course_id">Chọn Môn học tiên quyết:</label>
                    <select name="prerequisite_course_id" id="prerequisite_course_id" class="form-control">
                        <option value="">-- Chọn Môn học tiên quyết --</option>
                        @foreach($coursesList as $courseItem)
                            <option value="{{ $courseItem->course_id }}">{{ $courseItem->course_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="prerequisite_type">Loại tiên quyết:</label>
                    <select name="prerequisite_type" id="prerequisite_type" class="form-control">
                        <option value="Required">Bắt buộc</option>
                        <option value="Optional">Tùy chọn</option>
                        <option value="Previous">Trước</option>
                    </select>
                </div>
            </div>

            <script>
                // Khi checkbox "Không có tiên quyết" được chọn, ẩn các trường nhập prerequisites
                document.getElementById('no_prerequisites').addEventListener('change', function () {
                    var prereqFields = document.getElementById('prerequisites_fields');
                    if (this.checked) {
                        prereqFields.style.display = 'none';
                    } else {
                        prereqFields.style.display = 'block';
                    }
                });
            </script>

            <button type="submit" class="btn btn-primary">Thêm Môn học</button>
            <a href="{{ route('monhoc.index') }}" class="btn btn-secondary">Trở về danh sách</a>

        </form>
    </div>
</body>

</html>

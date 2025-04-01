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

                $isElective = isset($courseMajor) ? $courseMajor->is_elective : 0;
                $recommendedSemester = isset($courseMajor) ? $courseMajor->recommended_semester : '';
                $selectedMajors = $course->majors->pluck('major_id')->toArray();
            @endphp
            <div class="form-group">
                <label>Chuyên ngành:</label>
                @error('majors')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <div class="border p-2">
                    @foreach($majors as $index => $major)
                                        @php
                                            $courseMajor = $course->majors->firstWhere('major_id', $major->major_id);
                                        @endphp
                                        <div class="form-group border-bottom pb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    name="majors[{{ $major->major_id }}][active]" value="1" {{ $courseMajor ? 'checked' : '' }}>
                                                <input type="hidden" name="majors[{{ $major->major_id }}][major_id]"
                                                    value="{{ $major->major_id }}">
                                                <label class="form-check-label">
                                                    {{ $major->major_name }}
                                                </label>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <label>Loại môn:</label>
                                                    <select name="majors[{{ $major->major_id }}][is_elective]" class="form-control">
                                                        <option value="0" {{ ($courseMajor->pivot->is_elective ?? 0) == 0 ? 'selected' : '' }}>Bắt buộc</option>
                                                        <option value="1" {{ ($courseMajor->pivot->is_elective ?? 0) == 1 ? 'selected' : '' }}>Tự chọn</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Học kỳ đề xuất:</label>
                                                    <input type="number" name="majors[{{ $major->major_id }}][recommended_semester]"
                                                        class="form-control" value="{{ $courseMajor->pivot->recommended_semester ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                    @endforeach
                </div>
            </div>


            <hr>
            <h4>Thông tin Tiên quyết (Prerequisites)</h4>
            <div class="form-group">
                <label>
                    <input type="checkbox" name="delete_prerequisites" id="delete_prerequisites" value="1">
                    Xóa hết thông tin tiên quyết
                </label>
            </div>

            <div id="prerequisites_fields">
                @foreach($course->prerequisites as $index => $prereq)
                <div class="prerequisite-group border p-2 mb-3">
                    <div class="form-group">
                        <label>Chuyên ngành áp dụng:</label>
                        <select name="prerequisites[{{ $index }}][major_id]" class="form-control">
                            <option value="">-- Chọn chuyên ngành --</option>
                            @foreach($majors as $major)
                                <option value="{{ $major->major_id }}" {{ $prereq->major_id == $major->major_id ? 'selected' : '' }}>
                                    {{ $major->major_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Môn học tiên quyết:</label>
                        <select name="prerequisites[{{ $index }}][prerequisite_course_id]" class="form-control">
                            <option value="">-- Chọn môn học --</option>
                            @foreach($coursesList as $courseItem)
                                <option value="{{ $courseItem->course_id }}" {{ $prereq->prerequisite_course_id == $courseItem->course_id ? 'selected' : '' }}>
                                    {{ $courseItem->course_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Loại tiên quyết:</label>
                        <select name="prerequisites[{{ $index }}][prerequisite_type]" class="form-control">
                            <option value="Required" {{ $prereq->prerequisite_type == 'Required' ? 'selected' : '' }}>Bắt buộc</option>
                            <option value="Optional" {{ $prereq->prerequisite_type == 'Optional' ? 'selected' : '' }}>Tùy chọn</option>
                            <option value="Previous" {{ $prereq->prerequisite_type == 'Previous' ? 'selected' : '' }}>Trước</option>
                        </select>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Nút thêm prerequisite mới -->
            <button type="button" id="add_prerequisite" class="btn btn-sm btn-secondary mb-3">Thêm Tiên quyết</button>

            <script>
                // Thêm prerequisite mới
                let prerequisiteIndex = {{ count($course->prerequisites) }};
                document.getElementById('add_prerequisite').addEventListener('click', function() {
                    const newPrereq = `
                    <div class="prerequisite-group border p-2 mb-3">
                        <div class="form-group">
                            <label>Chuyên ngành áp dụng:</label>
                            <select name="prerequisites[${prerequisiteIndex}][major_id]" class="form-control">
                                <option value="">-- Chọn chuyên ngành --</option>
                                @foreach($majors as $major)
                                    <option value="{{ $major->major_id }}">{{ $major->major_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Môn học tiên quyết:</label>
                            <select name="prerequisites[${prerequisiteIndex}][prerequisite_course_id]" class="form-control">
                                <option value="">-- Chọn môn học --</option>
                                @foreach($coursesList as $courseItem)
                                    <option value="{{ $courseItem->course_id }}">{{ $courseItem->course_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Loại tiên quyết:</label>
                            <select name="prerequisites[${prerequisiteIndex}][prerequisite_type]" class="form-control">
                                <option value="Required">Bắt buộc</option>
                                <option value="Optional">Tùy chọn</option>
                                <option value="Previous">Trước</option>
                            </select>
                        </div>
                    </div>`;

                    document.getElementById('prerequisites_fields').insertAdjacentHTML('beforeend', newPrereq);
                    prerequisiteIndex++;
                });
            </script>

            <script>
                // Nếu checkbox "Xóa hết thông tin tiên quyết" được chọn, ẩn các trường nhập
                document.getElementById('delete_prerequisites').addEventListener('change', function () {
                    var prereqFields = document.getElementById('prerequisites_fields');
                    if (this.checked) {
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

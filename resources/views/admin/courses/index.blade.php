<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách Môn học</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Một chút style để ẩn hiện ô tìm kiếm theo yêu cầu */
        .search-input {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1>Quản lý Môn học</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Form lọc: chọn chuyên ngành và tìm kiếm -->
    <form method="GET" action="{{ route('monhoc.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="major_id" class="form-control">
                    <option value="">-- Chọn chuyên ngành --</option>
                    @foreach($majors as $major)
                        <option value="{{ $major->major_id }}" {{ request('major_id') == $major->major_id ? 'selected' : '' }}>
                            {{ $major->major_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <!-- Ô tìm kiếm với giao diện và chức năng giống file course -->
                <input type="text" name="search" class="form-control search-input"
                    placeholder="Tìm kiếm..."
                    value="{{ request('search') }}"
                    onkeyup="filterTable('electiveTable', this.value)">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Lọc</button>
                <a href="{{ route('monhoc.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>


    <a href="{{ route('monhoc.create') }}" class="btn btn-primary mb-3">Thêm Môn học</a>

    <table class="table table-bordered" id="electiveTable">
        <thead>
            <tr>
                <th>Mã Môn học</th>
                <th>Tên Môn học</th>
                <th>Mô tả</th>
                <th>Giảng viên</th>
                <th>Lịch học</th>
                <th>Số tín chỉ</th>
                <th>Is Elective</th>
                <th>Học kỳ đề xuất</th>
                <th>Môn tiên quyết</th>
                <th>Loại tiên quyết</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->course_id }}</td>
                <td>{{ $course->course_name }}</td>
                <td>{{ $course->course_description ?? 'Không có mô tả' }}</td>
                <td>{{ $course->lecturer ? $course->lecturer->lecturer_name : 'N/A' }}</td>
                <td>
                    @if($course->schedules->isNotEmpty())
                        @php
                            $schedule = $course->schedules->first();
                        @endphp
                        <div><strong>Ngày:</strong>
                            @switch($schedule->day_of_week)
                                @case(1) Thứ 2 @break
                                @case(2) Thứ 3 @break
                                @case(3) Thứ 4 @break
                                @case(4) Thứ 5 @break
                                @case(5) Thứ 6 @break
                                @case(6) Thứ 7 @break
                                @case(7) Chủ nhật @break
                                @default Không xác định
                            @endswitch
                        </div>
                        <div><strong>Bắt đầu:</strong> {{ $schedule->start_time }}</div>
                        <div><strong>Kết thúc:</strong> {{ $schedule->end_time }}</div>
                    @else
                        Chưa có lịch học
                    @endif
                </td>
                <td>{{ $course->credits }}</td>
                <td>{{ $course->course_major ? ($course->course_major->is_elective ? 'Tự chọn' : 'Bắt buộc') : 'N/A' }}</td>
                <td>{{ $course->course_major ? $course->course_major->recommended_semester : 'N/A' }}</td>
                <td>{{ $course->prerequisite ? $course->prerequisite->prerequisite_course_id : 'N/A' }}</td>
                <td>{{ $course->prerequisite ? $course->prerequisite->prerequisite_type : 'N/A' }}</td>
                <td>
                    <a href="{{ route('monhoc.edit', $course->course_id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('monhoc.destroy', $course->course_id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $courses->appends(request()->query())->links() }}
</div>

<!-- Nếu bạn muốn sử dụng một hàm JavaScript để lọc bảng trực tiếp khi gõ (bổ sung ngoài bộ lọc backend) -->
<script>
    function filterTable(tableId, query) {
        const filter = query.toUpperCase();
        const table = document.getElementById(tableId);
        const tr = table.getElementsByTagName("tr");

        for (let i = 1; i < tr.length; i++) { // Bỏ qua header (row đầu tiên)
            const tdArray = tr[i].getElementsByTagName("td");
            let rowText = "";
            for (let j = 0; j < tdArray.length; j++) {
                rowText += tdArray[j].textContent || tdArray[j].innerText;
            }
            if (rowText.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
</script>

</body>
</html>

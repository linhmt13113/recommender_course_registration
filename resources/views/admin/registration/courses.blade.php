<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chọn môn đăng ký cho học kỳ {{ $semester->semester_id }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .btn-group {
            margin-bottom: 10px;
        }
        .nested-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .nested-table th,
        .nested-table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }
        .nested-table th {
            background-color: #f8f9fa;
        }
        .search-input {
            margin-bottom: 10px;
            width: 30%;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1>Chọn môn đăng ký cho học kỳ {{ $semester->semester_id }}</h1>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.registration.storeCourses', $semester->id) }}" method="POST">
        @csrf

        {{-- Nhóm môn tự chọn --}}
        <div class="card mb-3">
            <div class="card-header">
                <strong>Các môn tự chọn</strong>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-info" onclick="selectAll('elective')">Chọn tất cả</button>
                    <button type="button" class="btn btn-sm btn-warning" onclick="deselectAll('elective')">Bỏ chọn tất cả</button>
                </div>
                <input type="text" class="form-control search-input" placeholder="Tìm kiếm..." onkeyup="filterTable('electiveTable', this.value)">
            </div>
            <div class="card-body">
                @if($electiveCourses->isNotEmpty())
                <table class="nested-table" id="electiveTable">
                    <thead>
                        <tr>
                            <th>Chọn</th>
                            <th>Course ID</th>
                            <th>Course Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($electiveCourses as $cm)
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input elective" name="selected_courses[]" value="{{ $cm->course->course_id }}" id="elective_{{ $cm->course->course_id }}"
                                {{ in_array($cm->course->course_id, $selectedCourses) ? 'checked' : '' }}>
                            </td>
                            <td>{{ $cm->course->course_id }}</td>
                            <td>{{ $cm->course->course_name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p>Không có môn tự chọn.</p>
                @endif
            </div>
        </div>

        {{-- Nhóm môn bắt buộc - Học kỳ chẵn --}}
        <div class="card mb-3">
            <div class="card-header">
                <strong>Các môn bắt buộc – Học kỳ chẵn</strong>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-info" onclick="selectAll('even')">Chọn tất cả</button>
                    <button type="button" class="btn btn-sm btn-warning" onclick="deselectAll('even')">Bỏ chọn tất cả</button>
                </div>
                <input type="text" class="form-control search-input" placeholder="Tìm kiếm..." onkeyup="filterTable('evenTable', this.value)">
            </div>
            <div class="card-body">
                @if($evenNonElectiveCourses->isNotEmpty())
                <table class="nested-table" id="evenTable">
                    <thead>
                        <tr>
                            <th>Chọn</th>
                            <th>Course ID</th>
                            <th>Course Name</th>
                            <th>Học kỳ đề xuất</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($evenNonElectiveCourses as $cm)
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input even" name="selected_courses[]" value="{{ $cm->course->course_id }}" id="even_{{ $cm->course->course_id }}"
                                {{ in_array($cm->course->course_id, $selectedCourses) ? 'checked' : '' }}>
                            </td>
                            <td>{{ $cm->course->course_id }}</td>
                            <td>{{ $cm->course->course_name }}</td>
                            <td>{{ $cm->recommended_semester }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p>Không có môn học phù hợp cho học kỳ chẵn.</p>
                @endif
            </div>
        </div>

        {{-- Nhóm môn bắt buộc - Học kỳ lẻ --}}
        <div class="card mb-3">
            <div class="card-header">
                <strong>Các môn bắt buộc – Học kỳ lẻ</strong>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-info" onclick="selectAll('odd')">Chọn tất cả</button>
                    <button type="button" class="btn btn-sm btn-warning" onclick="deselectAll('odd')">Bỏ chọn tất cả</button>
                </div>
                <input type="text" class="form-control search-input" placeholder="Tìm kiếm..." onkeyup="filterTable('oddTable', this.value)">
            </div>
            <div class="card-body">
                @if($oddNonElectiveCourses->isNotEmpty())
                <table class="nested-table" id="oddTable">
                    <thead>
                        <tr>
                            <th>Chọn</th>
                            <th>Course ID</th>
                            <th>Course Name</th>
                            <th>Học kỳ đề xuất</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($oddNonElectiveCourses as $cm)
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input odd" name="selected_courses[]" value="{{ $cm->course->course_id }}" id="odd_{{ $cm->course->course_id }}"
                                {{ in_array($cm->course->course_id, $selectedCourses) ? 'checked' : '' }}>
                            </td>
                            <td>{{ $cm->course->course_id }}</td>
                            <td>{{ $cm->course->course_name }}</td>
                            <td>{{ $cm->recommended_semester }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <p>Không có môn học phù hợp cho học kỳ lẻ.</p>
                @endif
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Lưu các môn đăng ký & Mở đăng ký</button>
    </form>

    <a href="{{ route('admin.registration.index') }}" class="btn btn-secondary mt-3">Quay lại danh sách Học kỳ</a>
</div>

<script>
    // Hàm chọn tất cả checkbox theo nhóm (group: 'elective', 'even', 'odd')
    function selectAll(group) {
        const checkboxes = document.querySelectorAll('input.' + group);
        checkboxes.forEach(cb => cb.checked = true);
    }
    // Hàm bỏ chọn tất cả checkbox theo nhóm
    function deselectAll(group) {
        const checkboxes = document.querySelectorAll('input.' + group);
        checkboxes.forEach(cb => cb.checked = false);
    }
    // Hàm lọc bảng theo input tìm kiếm
    function filterTable(tableId, query) {
        const filter = query.toUpperCase();
        const table = document.getElementById(tableId);
        const tr = table.getElementsByTagName("tr");

        for (let i = 1; i < tr.length; i++) { // bắt đầu từ 1 để bỏ qua header
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

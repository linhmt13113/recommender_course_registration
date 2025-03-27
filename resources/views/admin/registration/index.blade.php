<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Đăng ký Học kỳ</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .nested-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .nested-table th, .nested-table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }
        .nested-table th {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <h1>Quản lý Đăng ký Học kỳ</h1>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Semester ID</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Registration Status</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($semesters as $semester)
            <tr>
                <td>{{ $semester->semester_id }}</td>
                <td>{{ $semester->start_date }}</td>
                <td>{{ $semester->end_date }}</td>
                <td>{{ ucfirst($semester->registration_status) }}</td>
                <td>
                    @if($semester->registration_status == 'closed')
                        <a href="{{ route('admin.registration.courses', $semester->id) }}" class="btn btn-success">
                            Chọn môn & Mở đăng ký
                        </a>
                    @elseif($semester->registration_status == 'open')
                        <a href="{{ route('admin.registration.courses', $semester->id) }}" class="btn btn-primary">
                            Xem/Chỉnh sửa môn đăng ký
                        </a>
                    @else
                        <span>Đã kết thúc</span>
                    @endif
                </td>
            </tr>
            @if($semester->registration_status == 'open' && $semester->courses->isNotEmpty())
            <tr>
                <td colspan="5">
                    @php
                        // Tách danh sách các môn đã đăng ký thành hai bộ: môn tự chọn và môn bắt buộc
                        $registeredElective = $semester->courses->filter(function($course) {
                            $cm = \App\Models\CourseMajor::where('course_id', $course->course_id)->first();
                            return $cm ? $cm->is_elective : false;
                        });
                        $registeredRequired = $semester->courses->filter(function($course) {
                            $cm = \App\Models\CourseMajor::where('course_id', $course->course_id)->first();
                            return $cm ? !$cm->is_elective : false;
                        });
                    @endphp

                    @if($registeredElective->isNotEmpty())
                        <h5>Môn tự chọn</h5>
                        <table class="nested-table table table-bordered">
                            <thead>
                                <tr>
                                    <th>Course ID</th>
                                    <th>Course Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registeredElective as $course)
                                <tr>
                                    <td>{{ $course->course_id }}</td>
                                    <td>{{ $course->course_name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p><em>Chưa có môn tự chọn</em></p>
                    @endif

                    @if($registeredRequired->isNotEmpty())
                        <h5>Môn bắt buộc</h5>
                        <table class="nested-table table table-bordered">
                            <thead>
                                <tr>
                                    <th>Course ID</th>
                                    <th>Course Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registeredRequired as $course)
                                <tr>
                                    <td>{{ $course->course_id }}</td>
                                    <td>{{ $course->course_name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p><em>Chưa có môn bắt buộc</em></p>
                    @endif
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Đăng ký Học kỳ</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container">
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
                <td>{{ $semester->registration_status }}</td>
                <td>
                    @if($semester->registration_status == 'closed')
                        <form action="{{ route('admin.registration.open', $semester->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Mở đăng ký</button>
                        </form>
                    @else
                        <span>Đã mở</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>

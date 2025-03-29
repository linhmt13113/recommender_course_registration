@extends('student.dashboard')

@section('content')
    <h1>Các môn đã học</h1>
    @if($courses->isEmpty())
        <p>Chưa có môn học nào.</p>
    @else
        <table style="border: 1px solid black; border-collapse: collapse;" cellpadding="5">
            <thead>
                <tr>
                    <th>Mã môn</th>
                    <th>Tên môn</th>
                    <th>Học kỳ</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{ $course->course->course_id }}</td>
                        <td>{{ $course->course->course_name }}</td>
                        <td>{{ $course->semester }}</td>
                        <td>{{ $course->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection

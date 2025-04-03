@extends('layouts.apps')

@section('title', 'Quản lý Môn học')

@section('content')
<div class="container">
    <h2>Quản lý Môn học</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Mã môn học</th>
                <th>Tên môn học</th>
                <th>Số tín chỉ</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $course->course_code }}</td>
                <td>{{ $course->course_name }}</td>
                <td>{{ $course->credits }}</td>
                <td>
                    <a href="{{ route('monhoc.edit', $course->id) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('monhoc.destroy', $course->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

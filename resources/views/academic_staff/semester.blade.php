@extends('layouts.apps')

@section('title', 'Quản lý Học kỳ')

@section('content')
<div class="container">
    <h2>Quản lý Học kỳ</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên học kỳ</th>
                <th>Năm học</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($semesters as $semester)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $semester->name }}</td>
                <td>{{ $semester->year }}</td>
                <td>
                    <a href="{{ route('hocki.edit', $semester->id) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('hocki.destroy', $semester->id) }}" method="POST" class="d-inline">
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

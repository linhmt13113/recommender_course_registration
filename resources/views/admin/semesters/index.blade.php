@extends('layouts.app')

@section('title', 'Danh sách Học kỳ')

@section('content')
<div class="container mt-4">
    <h1>Quản lý Học kỳ</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('hocki.create') }}" class="btn btn-primary mb-3">Thêm Học kỳ</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã Học kỳ</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($semesters as $semester)
            <tr>
                <td>{{ $semester->semester_id }}</td>
                <td>{{ $semester->start_date }}</td>
                <td>{{ $semester->end_date }}</td>
                <td>
                    <a href="{{ route('hocki.edit', $semester->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('hocki.destroy', $semester->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $semesters->links() }}
</div>
@endsection

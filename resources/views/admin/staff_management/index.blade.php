@extends('layouts.app')

@section('title', 'Danh sách Nhân viên')

@section('content')
<div class="container mt-4">
    <h1>Quản lý Nhân viên</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('staff_management.create') }}" class="btn btn-primary mb-3">Thêm Nhân viên</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã NV</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($staffs as $staff)
            <tr>
                <td>{{ $staff->staff_id }}</td>
                <td>{{ $staff->staff_name }}</td>
                <td>{{ $staff->email }}</td>
                <td>
                    <a href="{{ route('staff_management.edit', ['staff_management' => $staff->staff_id]) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('staff_management.destroy', ['staff_management' => $staff->staff_id]) }}" method="POST" style="display:inline-block">
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
    {!! $staffs->links() !!}
</div>
@endsection

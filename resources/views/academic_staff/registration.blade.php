@extends('layouts.apps')

@section('title', 'Quản lý Mở đợt Đăng ký')

@section('content')
<div class="container">
    <h2>Quản lý Mở đợt Đăng ký</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Tên đợt đăng ký</th>
                <th>Ngày bắt đầu</th>
                <th>Ngày kết thúc</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($registrations as $reg)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $reg->name }}</td>
                <td>{{ $reg->start_date }}</td>
                <td>{{ $reg->end_date }}</td>
                <td>
                    <form action="{{ route('staff.registration.open', $reg->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Mở</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

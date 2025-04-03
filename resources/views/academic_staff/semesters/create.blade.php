@extends('layouts.apps')

@section('title', 'Thêm Học kỳ')

@section('content')
<div class="container mt-4">
    <h1>Thêm Học kỳ</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('hocki.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="semester_id">Mã Học kỳ:</label>
            <input type="text" name="semester_id" id="semester_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="start_date">Ngày bắt đầu:</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="end_date">Ngày kết thúc:</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm Học kỳ</button>
        <a href="{{ route('hocki.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection

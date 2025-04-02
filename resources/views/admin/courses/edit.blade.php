@extends('layouts.app')

@section('title', 'Sửa Môn học')

@section('content')
    <h1>Sửa Môn học</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('monhoc.update', $course->course_id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Các input sửa đổi -->
        <div class="form-group">
            <label for="course_id">Mã Môn học:</label>
            <input type="text" name="course_id" id="course_id" class="form-control" value="{{ $course->course_id }}" required>
        </div>
        <div class="form-group">
            <label for="course_name">Tên Môn học:</label>
            <input type="text" name="course_name" id="course_name" class="form-control" value="{{ $course->course_name }}" required>
        </div>
        <div class="form-group">
            <label for="course_description">Mô tả:</label>
            <textarea name="course_description" id="course_description" class="form-control">{{ $course->course_description }}</textarea>
        </div>
        <div class="form-group">
            <label for="credits">Số tín chỉ:</label>
            <input type="number" name="credits" id="credits" class="form-control" value="{{ $course->credits }}" required min="1">
        </div>
        <div class="form-group">
            <label for="lecturer_id">Chọn Giảng viên (nếu có):</label>
            <select name="lecturer_id" id="lecturer_id" class="form-control">
                <option value="">-- Chọn Giảng viên --</option>
                @foreach($lecturers as $lecturer)
                    <option value="{{ $lecturer->lecturer_id }}" {{ $course->lecturer_id == $lecturer->lecturer_id ? 'selected' : '' }}>
                        {{ $lecturer->lecturer_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Các phần Lịch học, Course Major, Tiên quyết ... (giữ nguyên cấu trúc và code hiện tại) -->

        <button type="submit" class="btn btn-primary">Cập nhật Môn học</button>
        <a href="{{ route('monhoc.index') }}" class="btn btn-secondary">Trở về danh sách</a>
    </form>
@endsection


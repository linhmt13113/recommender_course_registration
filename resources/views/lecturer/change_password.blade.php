@extends('layouts.lecturer')

@section('title', 'Đổi mật khẩu')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Đổi mật khẩu</h4>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form method="POST" action="{{ route('change.password') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                            <input type="password" class="form-control"
                                   id="current_password" name="current_password" required>
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">Mật khẩu mới</label>
                            <input type="password" class="form-control"
                                   id="new_password" name="new_password" required>
                        </div>

                        <div class="mb-4">
                            <label for="new_password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                            <input type="password" class="form-control"
                                   id="new_password_confirmation" name="new_password_confirmation" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
                            <a href="{{ route('lecturer.schedule') }}" class="btn btn-outline-secondary">
                                Hủy bỏ
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

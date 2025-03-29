@extends('student.dashboard')

@section('content')
    <h1>Đổi mật khẩu</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('change.password') }}" method="POST">
        @csrf
        <div>
            <label for="current_password">Mật khẩu hiện tại:</label>
            <input type="password" id="current_password" name="current_password" required>
        </div>
        <div>
            <label for="new_password">Mật khẩu mới:</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>
        <div>
            <label for="new_password_confirmation">Xác nhận mật khẩu mới:</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
        </div>
        <button type="submit">Đổi mật khẩu</button>
    </form>

    <a href="{{ route('student.dashboard') }}" class="btn btn-primary" style="margin-top: 20px;">Quay lại </a>

@endsection

@php
    $hideNews = true;
@endphp

@extends('student.dashboard')
@section('title', 'Changes Password')


@section('content')
    <div class="change-password-container">
        <div class="card shadow-sm p-4">
            <h2 class="mb-4 text-center text-primary">Change password</h2>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                           <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('change.password') }}" method="POST" class="change-password-form">
                @csrf
                <div class="mb-3">
                    <label for="current_password" class="form-label">Input Current password: </label>
                    <input type="password" id="current_password" name="current_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">Input New password: </label>
                    <input type="password" id="new_password" name="new_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="new_password_confirmation" class="form-label">Confirm the new password: </label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Confirm</button>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('student.dashboard') }}" class="btn btn-outline-secondary">← Back to previous page.</a>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('template/css/students/change-password.css') }}">
@endpush

@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <h1>Chào mừng Admin!</h1>
    <p>Đây là trang quản trị hệ thống.</p>
@endsection

@push('styles')
<style>
    .dashboard-menu a {
        display: inline-block;
        padding: 10px 15px;
        margin-right: 10px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
    }
    .dashboard-menu a:hover {
        background-color: #0056b3;
    }
</style>
@endpush

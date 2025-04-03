@extends('layouts.apps')

@section('title', 'Dashboard - Nhân viên Giáo vụ')

@section('content')
<div class="container">
    <h2>Dashboard Nhân viên Giáo vụ</h2>
    <p>Chào mừng {{ session('user')->staff_name }}, đây là trang tổng quan của bạn.</p>
</div>
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

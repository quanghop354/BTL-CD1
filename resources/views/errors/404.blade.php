@extends('layouts.master')

@section('title', 'Lỗi 404 - Trang không tồn tại')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-6 text-center">
        <h1 class="display-1 text-danger">404</h1>
        <h2 class="mb-4">Trang không tồn tại</h2>
        <p class="mb-4">Xin lỗi, trang bạn tìm kiếm không tồn tại hoặc đã bị xóa.</p>
        <a href="{{ route('login') }}" class="btn btn-primary">Quay lại trang chủ</a>
    </div>
</div>
@endsection

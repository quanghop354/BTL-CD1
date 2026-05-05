@extends('layouts.master')

@section('title', 'Lỗi 500 - Lỗi máy chủ nội bộ')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-6 text-center">
        <h1 class="display-1 text-danger">500</h1>
        <h2 class="mb-4">Lỗi máy chủ</h2>
        <p class="mb-4">Xin lỗi, có lỗi xảy ra trên máy chủ. Vui lòng thử lại sau.</p>
        <a href="{{ route('login') }}" class="btn btn-primary">Quay lại trang chủ</a>
    </div>
</div>
@endsection

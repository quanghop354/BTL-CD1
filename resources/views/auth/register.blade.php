@extends('layouts.master')

@section('title', 'Đăng Ký')

@section('content')
<div class="row justify-content-center align-items-center min-vh-100">
    <div class="col-md-7 col-lg-5">
        <div class="card shadow-lg border-0 animate__animated animate__fadeInDown">
            <div class="card-header text-center bg-gradient" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h3 class="mb-0 text-white"><i class="fas fa-user-plus me-2"></i>Đăng ký tài khoản</h3>
            </div>
            <div class="card-body p-4">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                <form method="POST" action="{{ route('register') }}" autocomplete="off">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="fas fa-user me-1"></i>Họ và tên</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required autofocus placeholder="Nhập họ và tên">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="fas fa-envelope me-1"></i>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required placeholder="Nhập email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="fas fa-user-tag me-1"></i>Tên đăng nhập</label>
                        <input type="text" name="username" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" required placeholder="Nhập tên đăng nhập">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="fas fa-lock me-1"></i>Mật khẩu</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Nhập mật khẩu">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><i class="fas fa-lock me-1"></i>Xác nhận mật khẩu</label>
                        <input type="password" name="password_confirmation" class="form-control" required placeholder="Nhập lại mật khẩu">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 mb-3 fw-bold shadow-sm">
                        <i class="fas fa-user-plus me-1"></i>Đăng ký
                    </button>
                    <div class="text-center">
                        <span>Đã có tài khoản? <a href="{{ route('login') }}" class="fw-semibold text-primary">Đăng nhập ngay</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

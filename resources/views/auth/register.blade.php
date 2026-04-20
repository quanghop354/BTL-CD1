@extends('layouts.master')

@section('title', 'Đăng Ký')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title mb-4">Đăng ký tài khoản</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Họ và tên</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tên đăng nhập</label>
                        <input type="text" name="username" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mật khẩu</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Xác nhận mật khẩu</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-3">Đăng ký</button>
                    <div class="text-center">
                        <p>Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

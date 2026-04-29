@extends('layouts.master')

@section('title', 'Đăng Nhập')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title mb-4">Đăng nhập</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email hoặc Tên đăng nhập</label>
                        <input type="text" name="email_or_username" value="{{ old('email_or_username') }}" class="form-control @error('email_or_username') is-invalid @enderror" required autofocus>
                        @error('email_or_username')
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

                    <button type="submit" class="btn btn-primary w-100 mb-3">Đăng nhập</button>
                </form>

                <hr>

                <a href="{{ route('login.google') }}" class="btn btn-light btn-outline-secondary w-100 mb-3">
                    <img src="https://www.gstatic.com/firebaseapp/v8.10.0/images/firebaseui-icon-16.png" alt="Google" style="height: 18px; margin-right: 8px;">
                    Đăng nhập bằng Google
                </a>

                <div class="text-center mt-3">
                    <p>Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

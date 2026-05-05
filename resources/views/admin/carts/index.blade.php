@extends('layouts.master')

@section('title', 'Quản Lý Giỏ Hàng')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">Quản lý giỏ hàng</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h5><i class="fas fa-shopping-basket me-2"></i>Giỏ Hàng Của Người Dùng</h5>
            </div>
            <div class="card-body">
                @if($carts->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Người Dùng</th>
                                <th>Sách</th>
                                <th>Số lượng</th>
                                <th>Ngày Thêm</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($carts as $cart)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($cart->user->avatar)
                                            <img src="{{ asset('storage/' . $cart->user->avatar) }}" alt="{{ $cart->user->name }}" class="rounded-circle me-2" width="40" height="40" style="object-fit: cover;">
                                        @else
                                            <i class="fas fa-user-circle fa-2x text-secondary me-2"></i>
                                        @endif
                                        <div>
                                            <h6 class="mb-0">{{ $cart->user->name }}</h6>
                                            <small class="text-muted">{{ $cart->user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($cart->book->image)
                                            <img src="{{ asset('storage/' . $cart->book->image) }}" alt="{{ $cart->book->name }}" class="img-thumbnail me-3" style="width: 40px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center me-3 rounded" style="width: 40px; height: 50px;">
                                                <i class="fas fa-book"></i>
                                            </div>
                                        @endif
                                        <span>{{ $cart->book->name }}</span>
                                    </div>
                                </td>
                                <td><span class="badge bg-primary rounded-pill">{{ $cart->quantity }}</span></td>
                                <td>{{ $cart->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Không có người dùng nào đang có sách trong giỏ hàng</h5>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

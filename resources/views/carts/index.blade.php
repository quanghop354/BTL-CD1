@extends('layouts.master')

@section('title', 'Giỏ Hàng Của Bạn')

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Trang chủ</a></li>
        <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-shopping-cart me-2"></i>Giỏ Hàng Của Bạn</h5>
            </div>
            <div class="card-body">
                @if($carts->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Sách</th>
                                <th>Số lượng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($carts as $cart)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($cart->book->image)
                                            <img src="{{ asset('storage/' . $cart->book->image) }}" alt="{{ $cart->book->name }}" class="img-thumbnail me-3" style="width: 50px; height: 70px; object-fit: cover;">
                                        @else
                                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center me-3 rounded" style="width: 50px; height: 70px;">
                                                <i class="fas fa-book fa-2x"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <h6 class="mb-0 fw-bold">{{ $cart->book->name }}</h6>
                                            <small class="text-muted">{{ $cart->book->author }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <form action="{{ route('carts.update', $cart->id) }}" method="POST" class="d-flex align-items-center" style="max-width: 150px;">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" class="form-control form-control-sm me-2" value="{{ $cart->quantity }}" min="1">
                                        <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fas fa-save"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('carts.destroy', $cart->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sách này khỏi giỏ hàng?');">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('payments.create', ['book' => $cart->book_id, 'type' => 'borrow']) }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-credit-card"></i> Thanh toán mượn
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5">
                    <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Giỏ hàng của bạn đang trống</h5>
                    <a href="{{ route('books.index') }}" class="btn btn-primary mt-3">Khám phá sách ngay</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

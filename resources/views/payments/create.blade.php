@extends('layouts.master')

@section('title', 'Tạo Thanh Toán - Quản Lý Thư Viện')

@section('breadcrumb')
<x-breadcrumb :items="[
    ['title' => 'Sách', 'url' => route('books.index')],
    ['title' => $book->name, 'url' => route('books.show', $book)],
    ['title' => 'Thanh toán']
]" />
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-book-open me-2"></i>Thông Tin Sách</h5>
            </div>
            <div class="card-body">
                <div class="row g-3 align-items-center">
                    <div class="col-md-3 text-center">
                        @if($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->name }}" class="img-fluid rounded" style="max-height: 180px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 180px;">
                                <i class="fas fa-book fa-3x text-muted"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <h3 class="mb-2">{{ $book->name }}</h3>
                        <p class="text-muted mb-2">Tác giả: {{ $book->author }}</p>
                        <p class="mb-2">
                            <span class="badge bg-{{ $book->status === 'available' ? 'success' : 'danger' }}">
                                {{ $book->status === 'available' ? 'Có Sẵn' : 'Không Có Sẵn' }}
                            </span>
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="border rounded p-3">
                                    <div class="text-muted small">Giá Mua</div>
                                    <div class="fw-bold text-primary">{{ number_format($book->price, 0, ',', '.') }} VNĐ</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="border rounded p-3">
                                    <div class="text-muted small">Phí Mượn</div>
                                    <div class="fw-bold text-info">{{ number_format($amount, 0, ',', '.') }} VNĐ</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-credit-card me-2"></i>Tạo Yêu Cầu Thanh Toán</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('payments.store', $book) }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Hình Thức</label>
                        <select name="type" id="paymentType" class="form-select" required>
                            <option value="purchase" {{ old('type', $type) === 'purchase' ? 'selected' : '' }}>Mua Sách</option>
                            <option value="borrow" {{ old('type', $type) === 'borrow' ? 'selected' : '' }}>Mượn Sách</option>
                        </select>
                        @error('type')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="borrowFields" class="{{ old('type', $type) === 'borrow' ? '' : 'd-none' }}">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Ngày Mượn</label>
                                <input type="date" name="borrow_date" class="form-control" value="{{ old('borrow_date', now()->toDateString()) }}">
                                @error('borrow_date')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ngày Trả Dự Kiến</label>
                                <input type="date" name="return_date" class="form-control" value="{{ old('return_date') }}">
                                @error('return_date')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="alert alert-info">
                            <i class="fas fa-circle-info me-2"></i>
                            Khi admin xác nhận thanh toán mượn sách, hệ thống sẽ tự tạo phiếu mượn và đánh dấu sách là không có sẵn.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phương Thức Thanh Toán</label>
                        <select name="payment_method" class="form-select" required>
                            <option value="cash" {{ old('payment_method') === 'cash' ? 'selected' : '' }}>Tiền Mặt</option>
                            <option value="bank_transfer" {{ old('payment_method') === 'bank_transfer' ? 'selected' : '' }}>Chuyển Khoản</option>
                            <option value="momo" {{ old('payment_method') === 'momo' ? 'selected' : '' }}>MoMo</option>
                        </select>
                        @error('payment_method')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ghi Chú</label>
                        <textarea name="notes" rows="3" class="form-control" placeholder="Ví dụ: thanh toán vào cuối ngày, liên hệ qua email...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="border rounded p-3 bg-light mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold">Số tiền cần thanh toán</span>
                            <span id="paymentAmount" class="h4 mb-0 text-primary"
                                data-purchase-amount="{{ number_format($book->price, 0, ',', '.') }} VNĐ"
                                data-borrow-amount="{{ number_format($amount, 0, ',', '.') }} VNĐ">
                                {{ old('type', $type) === 'borrow' ? number_format($amount, 0, ',', '.') : number_format($book->price, 0, ',', '.') }} VNĐ
                            </span>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-1"></i>Gửi Yêu Cầu Thanh Toán
                        </button>
                        <a href="{{ route('books.show', $book) }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Quay Lại
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const paymentType = document.getElementById('paymentType');
    const borrowFields = document.getElementById('borrowFields');
    const paymentAmount = document.getElementById('paymentAmount');

    function togglePaymentFields() {
        const isBorrow = paymentType.value === 'borrow';
        borrowFields.classList.toggle('d-none', !isBorrow);
        paymentAmount.textContent = isBorrow
            ? paymentAmount.dataset.borrowAmount
            : paymentAmount.dataset.purchaseAmount;
    }

    paymentType.addEventListener('change', togglePaymentFields);
    togglePaymentFields();
</script>
@endsection

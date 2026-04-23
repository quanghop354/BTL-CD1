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
                        {{-- Thêm ID 'paymentMethod' để lắng nghe sự kiện thay đổi bằng JavaScript --}}
                        <select name="payment_method" id="paymentMethod" class="form-select" required>
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
                            {{-- Lưu thêm data-* attributes raw để dùng cho URL API sinh QR Code --}}
                            <span id="paymentAmount" class="h4 mb-0 text-primary"
                                data-purchase-amount="{{ number_format($book->price, 0, ',', '.') }} VNĐ"
                                data-borrow-amount="{{ number_format($amount, 0, ',', '.') }} VNĐ"
                                data-purchase-raw="{{ $book->price }}"
                                data-borrow-raw="{{ $amount }}">
                                {{ old('type', $type) === 'borrow' ? number_format($amount, 0, ',', '.') : number_format($book->price, 0, ',', '.') }} VNĐ
                            </span>
                        </div>
                    </div>

                    {{-- Giao diện QR Code cho hình thức Chuyển khoản (Ẩn mặc định) --}}
                    <div id="bankTransferQR" class="text-center mb-4 d-none">
                        <div class="card border-primary mb-3 mx-auto" style="max-width: 300px;">
                            <div class="card-header bg-primary text-white">
                                <i class="fas fa-qrcode me-2"></i>Quét Mã QR Để Thanh Toán
                            </div>
                            <div class="card-body">
                                <img id="qrCodeImage" src="" alt="VietQR Code" class="img-fluid mb-3">
                                <div class="small text-start">
                                    <p class="mb-1"><strong>Ngân hàng:</strong> MB Bank</p>
                                    <p class="mb-1"><strong>Chủ tài khoản:</strong> HOANG QUANG HOP</p>
                                    <p class="mb-0"><strong>Số tài khoản:</strong> 0356798504</p>
                                </div>
                                <div class="alert alert-warning mt-3 small mb-0 py-2">
                                    Vui lòng chụp lại màn hình giao dịch sau khi chuyển khoản thành công.
                                </div>
                            </div>
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
    
    // Các phần tử DOM cần thiết cho QR Code
    const paymentMethod = document.getElementById('paymentMethod');
    const bankTransferQR = document.getElementById('bankTransferQR');
    const qrCodeImage = document.getElementById('qrCodeImage');

    // Hàm cập nhật và hiển thị QR Code dựa trên lựa chọn của người dùng
    function updateQR() {
        const isBorrow = paymentType.value === 'borrow';
        const isBankTransfer = paymentMethod.value === 'bank_transfer';
        
        // Ẩn/hiện khối QR Code
        bankTransferQR.classList.toggle('d-none', !isBankTransfer);
        
        if (isBankTransfer) {
            // Lấy số tiền dạng số thô (không có dấu phân cách) từ data attribute
            const amountRaw = isBorrow ? paymentAmount.dataset.borrowRaw : paymentAmount.dataset.purchaseRaw;
            
            // Tạo nội dung chuyển khoản không dấu (ví dụ: Thanh toan sach Harry Potter)
            const description = 'Thanh toan sach ' + '{{ \Illuminate\Support\Str::slug($book->name) }}';
            
            // Gọi API img.vietqr.io để sinh hình ảnh mã QR (MB Bank mã bin là 970422)
            // Cấu trúc URL: img.vietqr.io/image/[BIN]-[STK]-[TEMPLATE].png?amount=[SốTiền]&accountName=[TênTK]&addInfo=[MôTả]
            // Template có thể là: compact, compact2, qr_only, print
            const qrUrl = `https://img.vietqr.io/image/970422-0356798504-compact2.png?amount=${amountRaw}&addInfo=${description}&accountName=HOANG%20QUANG%20HOP`;
            
            // Cập nhật đường dẫn ảnh
            qrCodeImage.src = qrUrl;
        }
    }

    // Hàm cập nhật trạng thái các trường liên quan đến "Mượn sách"
    function togglePaymentFields() {
        const isBorrow = paymentType.value === 'borrow';
        borrowFields.classList.toggle('d-none', !isBorrow);
        
        // Cập nhật số tiền hiển thị có định dạng VNĐ
        paymentAmount.textContent = isBorrow
            ? paymentAmount.dataset.borrowAmount
            : paymentAmount.dataset.purchaseAmount;
            
        updateQR(); // Cập nhật lại QR vì số tiền đã thay đổi
    }

    // Gắn sự kiện lắng nghe
    paymentType.addEventListener('change', togglePaymentFields);
    paymentMethod.addEventListener('change', updateQR);
    
    // Khởi tạo trạng thái giao diện lần đầu tiên khi tải trang
    togglePaymentFields();
    updateQR();
</script>
@endsection

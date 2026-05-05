@extends('layouts.master')

@section('title', 'Thanh Toán - Quản Lý Thư Viện')

@section('breadcrumb')
<x-breadcrumb :items="[
    ['title' => 'Thanh toán', 'url' => route('payments.index')]
]" />
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1"><i class="fas fa-credit-card me-2"></i>Thanh Toán</h1>
        <p class="text-muted mb-0">
            {{ (auth()->user()->isAdmin() || auth()->user()->isStaff()) ? 'Quản lý toàn bộ giao dịch mua và mượn sách.' : 'Theo dõi các yêu cầu thanh toán của bạn.' }}
        </p>
    </div>
</div>

@if(auth()->user()->isAdmin() || auth()->user()->isStaff())
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Bộ Lọc Thanh Toán</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('payments.index') }}">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Trạng Thái</label>
                        <select name="payment_status" class="form-select">
                            <option value="">Tất Cả</option>
                            <option value="pending" {{ request('payment_status') === 'pending' ? 'selected' : '' }}>Chờ Xử Lý</option>
                            <option value="paid" {{ request('payment_status') === 'paid' ? 'selected' : '' }}>Đã Thanh Toán</option>
                            <option value="cancelled" {{ request('payment_status') === 'cancelled' ? 'selected' : '' }}>Đã Hủy</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Loại Giao Dịch</label>
                        <select name="type" class="form-select">
                            <option value="">Tất Cả</option>
                            <option value="purchase" {{ request('type') === 'purchase' ? 'selected' : '' }}>Mua Sách</option>
                            <option value="borrow" {{ request('type') === 'borrow' ? 'selected' : '' }}>Mượn Sách</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Sách</label>
                        <select name="book_id" class="form-select">
                            <option value="">Tất Cả Sách</option>
                            @foreach($books as $book)
                                <option value="{{ $book->id }}" {{ (string) request('book_id') === (string) $book->id ? 'selected' : '' }}>
                                    {{ $book->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Người Dùng</label>
                        <select name="user_id" class="form-select">
                            <option value="">Tất Cả Người Dùng</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ (string) request('user_id') === (string) $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-search me-1"></i>Lọc
                        </button>
                        <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-rotate-left me-1"></i>Đặt Lại
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sách</th>
                        <th>Người Dùng</th>
                        <th>Loại</th>
                        <th>Số Tiền</th>
                        <th>Phương Thức</th>
                        <th>Trạng Thái</th>
                        <th>Chi Tiết</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                        <tr>
                            <td>#{{ $payment->id }}</td>
                            <td>
                                <strong>{{ $payment->book->name ?? 'N/A' }}</strong>
                                <br>
                                <small class="text-muted">{{ $payment->book->author ?? '' }}</small>
                            </td>
                            <td>
                                <strong>{{ $payment->user->name ?? 'N/A' }}</strong>
                                <br>
                                <small class="text-muted">{{ $payment->user->email ?? '' }}</small>
                            </td>
                            <td>
                                <span class="badge bg-{{ $payment->type === 'purchase' ? 'primary' : 'info' }}">
                                    {{ $payment->type === 'purchase' ? 'Mua Sách' : 'Mượn Sách' }}
                                </span>
                            </td>
                            <td class="fw-bold text-primary">{{ number_format($payment->amount, 0, ',', '.') }} VNĐ</td>
                            <td>
                                @php
                                    $methodLabels = [
                                        'cash' => 'Tiền Mặt',
                                        'bank_transfer' => 'Chuyển Khoản',
                                        'momo' => 'MoMo',
                                    ];
                                @endphp
                                {{ $methodLabels[$payment->payment_method] ?? $payment->payment_method }}
                            </td>
                            <td>
                                @php
                                    $statusClass = [
                                        'pending' => 'warning',
                                        'paid' => 'success',
                                        'cancelled' => 'danger',
                                    ];
                                    $statusLabel = [
                                        'pending' => 'Chờ Xử Lý',
                                        'paid' => 'Đã Thanh Toán',
                                        'cancelled' => 'Đã Hủy',
                                    ];
                                @endphp
                                <span class="badge bg-{{ $statusClass[$payment->payment_status] ?? 'secondary' }}">
                                    {{ $statusLabel[$payment->payment_status] ?? $payment->payment_status }}
                                </span>
                            </td>
                            <td>
                                @if($payment->type === 'borrow')
                                    <small class="d-block">
                                        <strong>Mượn:</strong>
                                        {{ optional($payment->borrow_date)->format('d/m/Y') ?? '-' }}
                                    </small>
                                    <small class="d-block">
                                        <strong>Trả:</strong>
                                        {{ optional($payment->return_date)->format('d/m/Y') ?? '-' }}
                                    </small>
                                @else
                                    <small class="text-muted">Thanh toán mua sách</small>
                                @endif

                                @if($payment->notes)
                                    <small class="d-block mt-1"><strong>Ghi chú:</strong> {{ $payment->notes }}</small>
                                @endif

                                @if($payment->admin_note)
                                    <small class="d-block mt-1 text-danger"><strong>Ghi chú admin:</strong> {{ $payment->admin_note }}</small>
                                @endif
                            </td>
                            <td>
                                @if(auth()->user()->isAdmin() || auth()->user()->isStaff())
                                    <form method="POST" action="{{ route('payments.update-status', $payment) }}">
                                        @csrf
                                        @method('PATCH')
                                        <div class="mb-2">
                                            <select name="payment_status" class="form-select form-select-sm">
                                                <option value="pending" {{ $payment->payment_status === 'pending' ? 'selected' : '' }}>Chờ Xử Lý</option>
                                                <option value="paid" {{ $payment->payment_status === 'paid' ? 'selected' : '' }}>Đã Thanh Toán</option>
                                                <option value="cancelled" {{ $payment->payment_status === 'cancelled' ? 'selected' : '' }}>Đã Hủy</option>
                                            </select>
                                        </div>
                                        <div class="mb-2">
                                            <textarea name="admin_note" class="form-control form-control-sm" rows="2" placeholder="Ghi chú admin...">{{ $payment->admin_note }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-save me-1"></i>Cập Nhật
                                        </button>
                                    </form>
                                @else
                                    <small class="text-muted">
                                        @if($payment->paid_at)
                                            Xác nhận lúc {{ $payment->paid_at->format('d/m/Y H:i') }}
                                        @else
                                            Đang chờ admin xử lý
                                        @endif
                                    </small>
                                    @if($payment->payment_status === 'paid' && $payment->book)
                                        <button type="button" class="btn btn-sm btn-outline-warning mt-2 d-block w-100" data-bs-toggle="modal" data-bs-target="#reviewModal{{ $payment->id }}">
                                            <i class="fas fa-star me-1"></i>Đánh Giá
                                        </button>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                <i class="fas fa-receipt fa-2x mb-2"></i>
                                <p class="mb-0">Chưa có giao dịch thanh toán nào.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $payments->appends(request()->query())->links() }}
</div>

<!-- Modals Đánh Giá (Đặt ngoài table-responsive để tránh lỗi backdrop che trang) -->
@foreach($payments as $payment)
    @if(!auth()->user()->isAdmin() && !auth()->user()->isStaff() && $payment->payment_status === 'paid' && $payment->book)
        <div class="modal fade" id="reviewModal{{ $payment->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST" action="{{ route('reviews.store', $payment->book) }}">
                        @csrf
                        <div class="modal-header bg-warning text-dark">
                            <h5 class="modal-title"><i class="fas fa-star me-2"></i>Đánh giá sách: {{ $payment->book->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Chất lượng sách (Số sao)</label>
                                <select name="rating" class="form-select" required>
                                    <option value="5">5 Sao - Tuyệt vời</option>
                                    <option value="4">4 Sao - Rất tốt</option>
                                    <option value="3">3 Sao - Bình thường</option>
                                    <option value="2">2 Sao - Tệ</option>
                                    <option value="1">1 Sao - Rất tệ</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nhận xét của bạn</label>
                                <textarea name="comment" class="form-control" rows="3" placeholder="Chia sẻ cảm nhận của bạn về cuốn sách này..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-warning"><i class="fas fa-paper-plane me-1"></i>Gửi Đánh Giá</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endforeach

@endsection


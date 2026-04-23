@extends('layouts.master')

@section('title', 'Thông Tin Cá Nhân')

@section('breadcrumb')
<x-breadcrumb :items="[
    ['title' => 'Thông tin cá nhân']
]" />
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-user-edit me-2"></i>Chỉnh Sửa Thông Tin Cá Nhân</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="form-control @error('email') is-invalid @enderror" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tên đăng nhập <span class="text-danger">*</span></label>
                            <input type="text" name="username" value="{{ old('username', Auth::user()->username) }}" class="form-control @error('username') is-invalid @enderror" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Ngày tham gia</label>
                            <input type="text" value="{{ Auth::user()->created_at->format('d/m/Y') }}" class="form-control" readonly>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h6 class="mb-3"><i class="fas fa-key me-2"></i>Đổi Mật Khẩu (Để trống nếu không muốn đổi)</h6>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Mật khẩu hiện tại</label>
                            <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Mật khẩu mới</label>
                            <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror">
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Xác nhận mật khẩu mới</label>
                            <input type="password" name="new_password_confirmation" class="form-control">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Cập Nhật Thông Tin
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Account Statistics -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Thống Kê Tài Khoản</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="p-3 border rounded">
                            <h3 class="text-primary mb-1">{{ \App\Models\User::count() }}</h3>
                            <p class="text-muted mb-0">Tổng số tài khoản</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded">
                            <h3 class="text-success mb-1">{{ \App\Models\Book::count() }}</h3>
                            <p class="text-muted mb-0">Tổng số sách</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded">
                            <h3 class="text-info mb-1">{{ \App\Models\Reader::count() }}</h3>
                            <p class="text-muted mb-0">Tổng độc giả</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lịch sử Giao Dịch -->
        <div class="card mt-4 mb-5">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-history me-2"></i>Lịch Sử Giao Dịch Gần Đây</h5>
                <a href="{{ route('payments.index') }}" class="btn btn-sm btn-outline-light" style="border-color: white; color: white;">Xem tất cả</a>
            </div>
            <div class="card-body">
                @if(isset($payments) && $payments->isEmpty())
                    <p class="text-center text-muted my-3">Bạn chưa có giao dịch nào.</p>
                @elseif(isset($payments))
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Mã GD</th>
                                    <th>Sách</th>
                                    <th>Loại</th>
                                    <th>Số tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                                <tr>
                                    <td>#{{ $payment->id }}</td>
                                    <td>{{ Str::limit($payment->book->name ?? 'N/A', 25) }}</td>
                                    <td>
                                        @if($payment->type === 'purchase')
                                            <span class="badge bg-primary">Mua sách</span>
                                        @else
                                            <span class="badge bg-info">Mượn sách</span>
                                        @endif
                                    </td>
                                    <td class="fw-bold text-primary">{{ number_format($payment->amount, 0, ',', '.') }} đ</td>
                                    <td>
                                        @if($payment->payment_status === 'pending')
                                            <span class="badge bg-warning text-dark">Chờ duyệt</span>
                                        @elseif($payment->payment_status === 'paid')
                                            <span class="badge bg-success">Đã thanh toán</span>
                                        @else
                                            <span class="badge bg-danger">Đã hủy</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#paymentModal{{ $payment->id }}">
                                            <i class="fas fa-eye"></i> Chi tiết
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal Chi Tiết Giao Dịch -->
                                <div class="modal fade" id="paymentModal{{ $payment->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title"><i class="fas fa-file-invoice-dollar me-2"></i>Chi tiết giao dịch #{{ $payment->id }}</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-0">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <span><strong>Sách:</strong></span>
                                                        <span class="text-end fw-semibold">{{ $payment->book->name ?? 'N/A' }}</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <span><strong>Ngày tạo:</strong></span>
                                                        <span>{{ $payment->created_at->format('d/m/Y H:i') }}</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <span><strong>Loại giao dịch:</strong></span>
                                                        <span>{{ $payment->type === 'purchase' ? 'Mua sách' : 'Mượn sách' }}</span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <span><strong>Phương thức:</strong></span>
                                                        <span>
                                                            {{ $payment->payment_method === 'cash' ? 'Tiền mặt' : ($payment->payment_method === 'momo' ? 'Ví MoMo' : 'Chuyển khoản') }}
                                                        </span>
                                                    </li>
                                                    @if($payment->type === 'borrow')
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <span><strong>Hạn mượn dự kiến:</strong></span>
                                                        <span>
                                                            {{ $payment->borrow_date ? \Carbon\Carbon::parse($payment->borrow_date)->format('d/m/Y') : 'N/A' }} 
                                                            - 
                                                            {{ $payment->return_date ? \Carbon\Carbon::parse($payment->return_date)->format('d/m/Y') : 'N/A' }}
                                                        </span>
                                                    </li>
                                                    @endif
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        <span><strong>Tổng tiền:</strong></span>
                                                        <span class="h5 mb-0 text-primary fw-bold">{{ number_format($payment->amount, 0, ',', '.') }} VNĐ</span>
                                                    </li>
                                                    @if($payment->notes)
                                                    <li class="list-group-item bg-light">
                                                        <strong>Ghi chú từ bạn:</strong>
                                                        <p class="mb-0 mt-1 text-muted small">{{ $payment->notes }}</p>
                                                    </li>
                                                    @endif
                                                    @if($payment->admin_note)
                                                    <li class="list-group-item bg-warning bg-opacity-10">
                                                        <strong>Ghi chú từ Admin:</strong>
                                                        <p class="mb-0 mt-1 text-dark small">{{ $payment->admin_note }}</p>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
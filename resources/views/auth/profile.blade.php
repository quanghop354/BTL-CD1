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
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="text-center mb-4">
                        <div class="position-relative d-inline-block">
                            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=667eea&color=fff&size=150' }}" alt="Profile Image" class="rounded-circle img-thumbnail shadow-sm" style="width: 120px; height: 120px; object-fit: cover; aspect-ratio: 1/1;">
                            <label for="avatar" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2 shadow" style="cursor: pointer; transform: translate(10%, 10%);" title="Thay đổi ảnh đại diện">
                                <i class="fas fa-camera"></i>
                            </label>
                            <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*">
                        </div>
                        @error('avatar')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                        <h4 class="mt-3 mb-0">{{ Auth::user()->name }}</h4>
                        <p class="text-muted">{{ Auth::user()->email }}</p>
                    </div>

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
                            <label class="form-label">Số điện thoại</label>
                            <div class="input-group">
                                <input type="text" id="phoneInput" name="phone" value="{{ Auth::user()->phone ? '********' : '' }}" class="form-control @error('phone') is-invalid @enderror" readonly placeholder="Chưa cập nhật (Bấm Xem/Sửa để hiển thị)">
                                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#revealPhoneModal">
                                    <i class="fas fa-eye"></i> Xem/Sửa
                                </button>
                            </div>
                            @error('phone')
                                <div class="text-danger small mt-1">{{ $message }}</div>
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

<!-- Modal Xác Thực Xem Số Điện Thoại -->
<div class="modal fade" id="revealPhoneModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-lock me-2"></i>Xác thực mật khẩu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="small text-muted">Vui lòng nhập mật khẩu của bạn để xem hoặc thay đổi số điện thoại.</p>
                <div class="mb-3">
                    <input type="password" id="revealPasswordInput" class="form-control" placeholder="Nhập mật khẩu">
                    <div class="invalid-feedback" id="revealPasswordError"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" id="btnConfirmRevealPhone">Xác nhận</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Preview Avatar
    document.getElementById('avatar').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('.rounded-circle.img-thumbnail').src = e.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    // Handle Reveal Phone Logic
    document.getElementById('btnConfirmRevealPhone').addEventListener('click', function() {
        const password = document.getElementById('revealPasswordInput').value;
        const errorDiv = document.getElementById('revealPasswordError');
        const inputPass = document.getElementById('revealPasswordInput');
        const btn = this;
        
        errorDiv.textContent = '';
        inputPass.classList.remove('is-invalid');

        if (!password) {
            errorDiv.textContent = 'Vui lòng nhập mật khẩu';
            inputPass.classList.add('is-invalid');
            return;
        }

        // Show loading state
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang xử lý...';
        btn.disabled = true;

        fetch('{{ route('profile.reveal-phone') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ password: password })
        })
        .then(response => response.json().then(data => ({status: response.status, body: data})))
        .then(result => {
            btn.innerHTML = 'Xác nhận';
            btn.disabled = false;

            if (result.status === 200 && result.body.success) {
                const phoneInput = document.getElementById('phoneInput');
                phoneInput.value = result.body.phone === 'Chưa cập nhật' ? '' : result.body.phone;
                phoneInput.removeAttribute('readonly');
                phoneInput.placeholder = "Nhập số điện thoại mới";
                
                // Hide modal
                const modalEl = document.getElementById('revealPhoneModal');
                const modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                modal.hide();
                
                // Focus on phone input
                phoneInput.focus();
                
                // Clear password input
                document.getElementById('revealPasswordInput').value = '';
            } else {
                errorDiv.textContent = result.body.message || 'Mật khẩu không đúng';
                inputPass.classList.add('is-invalid');
            }
        })
        .catch(error => {
            btn.innerHTML = 'Xác nhận';
            btn.disabled = false;
            errorDiv.textContent = 'Đã có lỗi xảy ra. Vui lòng thử lại.';
            inputPass.classList.add('is-invalid');
        });
    });
</script>
@endpush
@extends('layouts.master')

@section('title', $book->name . ' - Chi Tiết Sách')

@section('breadcrumb')
<x-breadcrumb :items="[
    ['title' => 'Sách', 'url' => route('books.index')],
    ['title' => 'Chi tiết sách']
]" />
@endsection

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                @if($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" class="img-fluid rounded mb-3" alt="Book Image" style="max-height: 400px; object-fit: cover;">
                @else
                    <div class="bg-light d-flex align-items-center justify-content-center rounded mb-3" style="height: 400px;">
                        <i class="fas fa-book fa-5x text-muted"></i>
                    </div>
                @endif

                <h4 class="card-title">{{ $book->name }}</h4>
                <p class="text-muted mb-2">bởi {{ $book->author }}</p>

                <div class="mb-3">
                    <span class="badge bg-{{ $book->status == 'available' ? 'success' : 'danger' }} fs-6">
                        <i class="fas fa-{{ $book->status == 'available' ? 'check' : 'times' }} me-1"></i>
                        {{ $book->status == 'available' ? 'Có Sẵn' : 'Không Có Sẵn' }}
                    </span>
                </div>

                <div class="d-grid gap-2">
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-outline-warning">
                            <i class="fas fa-edit me-1"></i>Sửa Sách
                        </a>
                    @else
                        <a href="{{ route('payments.create', ['book' => $book, 'type' => 'purchase']) }}" class="btn btn-primary">
                            <i class="fas fa-cart-shopping me-1"></i>Mua Sách
                        </a>

                        @if($book->status === 'available')
                            <a href="{{ route('payments.create', ['book' => $book, 'type' => 'borrow']) }}" class="btn btn-outline-info">
                                <i class="fas fa-handshake me-1"></i>Mượn Sách
                            </a>
                        @else
                            <button type="button" class="btn btn-outline-secondary" disabled>
                                <i class="fas fa-ban me-1"></i>Hiện Không Thể Mượn
                            </button>
                        @endif
                    @endif

                    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Quay Lại Danh Sách
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Thông Tin Chi Tiết</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="border rounded p-3">
                            <h6 class="text-muted mb-2"><i class="fas fa-tag me-1"></i>Giá Bán</h6>
                            <h4 class="text-primary mb-0">{{ number_format($book->price, 0, ',', '.') }} VNĐ</h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded p-3">
                            <h6 class="text-muted mb-2"><i class="fas fa-handshake me-1"></i>Lượt Mượn</h6>
                            <h4 class="text-info mb-0">{{ $book->borrows->count() }}</h4>
                        </div>
                    </div>
                </div>

                @if(!auth()->user()->isAdmin())
                    <div class="alert alert-light border mt-4 mb-0">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <strong class="d-block mb-1"><i class="fas fa-cart-shopping me-1"></i>Mua Sách</strong>
                                <span class="text-muted">Thanh toán toàn bộ giá sách: {{ number_format($book->price, 0, ',', '.') }} VNĐ</span>
                            </div>
                            <div class="col-md-6">
                                <strong class="d-block mb-1"><i class="fas fa-handshake me-1"></i>Mượn Sách</strong>
                                <span class="text-muted">
                                    Phí mượn tạm tính: {{ number_format($book->price * 0.3, 0, ',', '.') }} VNĐ
                                </span>
                            </div>
                        </div>
                    </div>
                @endif

                <hr>

                <div class="mb-3">
                    <h6 class="text-muted mb-2"><i class="fas fa-building me-1"></i>Nhà Xuất Bản</h6>
                    @if($book->publisher)
                        <span class="badge bg-info me-1 text-dark">{{ $book->publisher->name }}</span>
                    @else
                        <span class="text-muted">Không có</span>
                    @endif
                </div>

                <div class="mb-3">
                    <h6 class="text-muted mb-2"><i class="fas fa-tags me-1"></i>Thể Loại</h6>
                    @if($book->categories->count() > 0)
                        @foreach($book->categories as $category)
                            <span class="badge bg-secondary me-1">{{ $category->name }}</span>
                        @endforeach
                    @else
                        <span class="text-muted">Không có thể loại</span>
                    @endif
                </div>

                @if($book->description)
                    <div class="mb-3">
                        <h6 class="text-muted mb-2"><i class="fas fa-align-left me-1"></i>Mô Tả</h6>
                        <p class="mb-0">{{ $book->description }}</p>
                    </div>
                @endif

                <div class="row g-3">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2"><i class="fas fa-calendar-plus me-1"></i>Ngày Thêm</h6>
                        <p class="mb-0">{{ $book->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2"><i class="fas fa-calendar-check me-1"></i>Cập Nhật Cuối</h6>
                        <p class="mb-0">{{ $book->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if($book->borrows->count() > 0)
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-history me-2"></i>Lịch Sử Mượn</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Người Mượn</th>
                                    <th>Ngày Mượn</th>
                                    <th>Ngày Trả</th>
                                    <th>Trạng Thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($book->borrows as $borrow)
                                    <tr>
                                        <td>{{ $borrow->reader->name ?? 'N/A' }}</td>
                                        <td>{{ $borrow->borrow_date->format('d/m/Y') }}</td>
                                        <td>{{ $borrow->return_date ? $borrow->return_date->format('d/m/Y') : '-' }}</td>
                                        <td>
                                            <span class="badge bg-{{ $borrow->status == 'returned' ? 'success' : 'warning' }}">
                                                {{ $borrow->status == 'returned' ? 'Đã Trả' : 'Đang Mượn' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        <div class="card mt-4 mb-5">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-comments me-2 text-warning"></i>Đánh Giá & Nhận Xét</h5>
            </div>
            <div class="card-body">
                @if($book->reviews && $book->reviews->count() > 0)
                    @php
                        $avgRating = $book->reviews->avg('rating');
                    @endphp
                    <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                        <h1 class="display-4 fw-bold text-warning mb-0 me-3">{{ number_format($avgRating, 1) }}</h1>
                        <div>
                            <div class="text-warning fs-5">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= round($avgRating) ? '' : 'text-light' }}"></i>
                                @endfor
                            </div>
                            <span class="text-muted">{{ $book->reviews->count() }} lượt đánh giá</span>
                        </div>
                    </div>

                    <div class="reviews-list">
                        @foreach($book->reviews as $review)
                            <div class="review-item mb-4 pb-3 border-bottom">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 40px; height: 40px;">
                                            {{ strtoupper(substr($review->user->name ?? 'U', 0, 1)) }}
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold">{{ $review->user->name ?? 'Người dùng ẩn danh' }}</h6>
                                            <small class="text-muted">{{ $review->created_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                    </div>
                                    <div class="text-warning">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $review->rating ? '' : 'text-light' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                                @if($review->comment)
                                    <p class="mb-0 text-dark mt-2" style="background: #f8f9fa; padding: 10px 15px; border-radius: 10px; border-left: 3px solid #ffc107;">{{ $review->comment }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="far fa-comment-dots fa-3x text-muted mb-3"></i>
                        <h6 class="text-muted">Chưa có đánh giá nào cho cuốn sách này.</h6>
                        <p class="small text-muted mb-0">Hãy là người đầu tiên mượn và đánh giá sách!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

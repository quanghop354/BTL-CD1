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
    </div>
</div>
@endsection

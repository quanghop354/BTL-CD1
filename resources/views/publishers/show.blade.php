@extends('layouts.master')

@section('title', 'Nhà Xuất Bản ' . $publisher->name)

@section('breadcrumb')
<x-breadcrumb :items="[
    ['title' => 'Sách', 'url' => route('books.index')],
    ['title' => 'Nhà xuất bản ' . $publisher->name]
]" />
@endsection

@section('content')
<div class="card mb-4">
    <div class="card-header bg-primary text-white" style="border-radius: 15px 15px 0 0 !important; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;">
        <h5 class="mb-0"><i class="fas fa-building me-2"></i>Thông Tin Nhà Xuất Bản</h5>
    </div>
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h3 class="fw-bold text-primary mb-3">{{ $publisher->name }}</h3>
                <p class="mb-2"><i class="fas fa-envelope me-2 text-muted" style="width: 20px;"></i> <strong>Email:</strong> {{ $publisher->email ?? 'Không có' }}</p>
                <p class="mb-2"><i class="fas fa-phone me-2 text-muted" style="width: 20px;"></i> <strong>Số Điện Thoại:</strong> {{ $publisher->phone ?? 'Không có' }}</p>
                <p class="mb-0"><i class="fas fa-map-marker-alt me-2 text-muted" style="width: 20px;"></i> <strong>Địa Chỉ:</strong> {{ $publisher->address ?? 'Không có' }}</p>
            </div>
            <div class="col-md-4 text-md-end mt-4 mt-md-0">
                <div class="p-4 bg-light rounded d-inline-block text-center border shadow-sm" style="min-width: 150px;">
                    <h1 class="text-primary fw-bold mb-1">{{ $publisher->books->count() }}</h1>
                    <span class="text-muted fw-semibold">Đầu Sách</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex align-items-center mb-4">
    <h4 class="mb-0 fw-bold"><i class="fas fa-book me-2 text-primary"></i>Sách Của {{ $publisher->name }}</h4>
    <div class="ms-auto">
        <a href="{{ route('books.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
            <i class="fas fa-arrow-left me-1"></i>Trở Về
        </a>
    </div>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 mb-4">
    @forelse($books as $book)
        <div class="col">
            <div class="card h-100 shadow-sm" style="transition: transform 0.3s; border: none; border-radius: 15px;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div class="position-relative">
                    @if($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" class="card-img-top" alt="{{ $book->name }}" style="height: 250px; object-fit: cover; border-radius: 15px 15px 0 0;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 250px; border-radius: 15px 15px 0 0;">
                            <i class="fas fa-book fa-4x text-muted"></i>
                        </div>
                    @endif
                    <div class="position-absolute top-0 end-0 p-2">
                        <span class="badge bg-{{ $book->status == 'available' ? 'success' : 'danger' }} rounded-pill px-3 py-2 shadow-sm">
                            {{ $book->status == 'available' ? 'Có Sẵn' : 'Không Có Sẵn' }}
                        </span>
                    </div>
                </div>
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title fw-bold text-truncate mb-2" title="{{ $book->name }}">{{ $book->name }}</h6>
                    <small class="text-muted mb-3 d-block text-truncate" title="{{ $book->author }}"><i class="fas fa-user-edit me-1"></i>{{ $book->author }}</small>
                    
                    <div class="mt-auto">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-primary fw-bold fs-5">{{ number_format($book->price, 0, ',', '.') }} đ</span>
                            <small class="text-muted bg-light px-2 py-1 rounded"><i class="fas fa-handshake me-1"></i>{{ $book->borrows->count() }} lượt mượn</small>
                        </div>
                        <a href="{{ route('books.show', $book) }}" class="btn btn-outline-primary w-100 rounded-pill fw-semibold">
                            <i class="fas fa-info-circle me-1"></i>Xem Chi Tiết
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center border-0 shadow-sm rounded-3 py-4">
                <i class="fas fa-info-circle fa-2x mb-3 text-info"></i>
                <h5>Chưa có sách nào</h5>
                <p class="text-muted mb-0">Hiện tại nhà xuất bản này chưa có cuốn sách nào trong hệ thống.</p>
            </div>
        </div>
    @endforelse
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $books->links() }}
</div>
@endsection

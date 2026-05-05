@extends('layouts.master')

@section('title', 'Sách - Quản Lý Thư Viện')

@section('breadcrumb')
<x-breadcrumb :items="[
    ['title' => 'Sách', 'url' => route('books.index')]
]" />
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="fas fa-book me-2"></i>Sách</h1>

    @if(auth()->user()->isAdmin() || auth()->user()->isStaff())
        <div>
            <a href="{{ route('books.trashed') }}" class="btn btn-outline-warning me-2">
                <i class="fas fa-trash me-1"></i>Thùng Rác
            </a>
            <a href="{{ route('books.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Thêm Sách
            </a>
        </div>
    @endif
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="fas fa-book me-2"></i>Sách</h1>
    <div>
        <a href="{{ route('books.trashed') }}" class="btn btn-outline-warning me-2">
            <i class="fas fa-trash me-1"></i>Thùng Rác
        </a>
        <a href="{{ route('books.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Thêm Sách
        </a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Bộ Lọc</h5>
    </div>
    <div class="card-body">
        <form method="GET">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Tìm Kiếm</label>
                    <input type="text" name="search" class="form-control" placeholder="Tên hoặc tác giả" value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Thể Loại</label>
                    <select name="category_id" class="form-select">
                        <option value="">Tất Cả Thể Loại</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Trạng Thái</label>
                    <select name="status" class="form-select">
                        <option value="">Tất Cả Trạng Thái</option>
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Có Sẵn</option>
                        <option value="unavailable" {{ request('status') == 'unavailable' ? 'selected' : '' }}>Không Có Sẵn</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Khoảng Giá</label>
                    <div class="input-group">
                        <input type="number" step="0.01" name="min_price" class="form-control" placeholder="Tối Thiểu" value="{{ request('min_price') }}">
                        <span class="input-group-text">-</span>
                        <input type="number" step="0.01" name="max_price" class="form-control" placeholder="Tối Đa" value="{{ request('max_price') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Sắp Xếp Theo</label>
                    <select name="sort_by" class="form-select">
                        <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Ngày Thêm</option>
                        <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Giá</option>
                        <option value="borrows_count" {{ request('sort_by') == 'borrows_count' ? 'selected' : '' }}>Lượt Mượn</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Thứ Tự</label>
                    <select name="sort_order" class="form-select">
                        <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Giảm Dần</option>
                        <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Tăng Dần</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-secondary me-2">
                        <i class="fas fa-search me-1"></i>Tìm Kiếm
                    </button>
                    <a href="{{ route('books.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i>Xóa Bộ Lọc
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    @forelse($books as $book)
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0 table-hover transition">
                <div class="card-body d-flex flex-column p-0">
                    @if($book->image)
                        <a href="{{ route('books.show', $book) }}" class="text-decoration-none">
                            <div class="bg-light d-flex align-items-center justify-content-center border-bottom" style="height: 250px; overflow: hidden; border-top-left-radius: 0.375rem; border-top-right-radius: 0.375rem;">
                                <img src="{{ asset('storage/' . $book->image) }}" class="img-fluid" alt="Book Image" style="max-height: 100%; width: 100%; object-fit: contain; padding: 15px; box-shadow: inset 0 0 10px rgba(0,0,0,0.05);">
                            </div>
                        </a>
                    @else
                        <a href="{{ route('books.show', $book) }}" class="text-decoration-none">
                            <div class="bg-light d-flex align-items-center justify-content-center border-bottom" style="height: 250px; border-top-left-radius: 0.375rem; border-top-right-radius: 0.375rem;">
                                <i class="fas fa-book fa-4x text-muted opacity-50"></i>
                            </div>
                        </a>
                    @endif

                    <div class="p-3 d-flex flex-column flex-grow-1">

                    <h5 class="card-title">
                        <a href="{{ route('books.show', $book) }}" class="text-decoration-none text-dark">
                            {{ $book->name }}
                        </a>
                    </h5>

                    <p class="card-text text-muted">bởi {{ $book->author }}</p>
                    <p class="card-text"><strong>{{ number_format($book->price, 0, ',', '.') }} VNĐ</strong></p>

                    <p class="card-text">
                        <span class="badge bg-{{ $book->status == 'available' ? 'success' : 'danger' }}">
                            <i class="fas fa-{{ $book->status == 'available' ? 'check' : 'times' }} me-1"></i>
                            {{ $book->status == 'available' ? 'Có Sẵn' : 'Không Có Sẵn' }}
                        </span>
                    </p>

                    <p class="card-text small text-muted">
                        <i class="fas fa-tags me-1"></i>{{ $book->categories->pluck('name')->join(', ') ?: 'Không Có Thể Loại' }}
                    </p>

                    <p class="card-text small">
                        <i class="fas fa-handshake me-1"></i>{{ $book->borrows_count }} lượt mượn
                    </p>

                    <div class="mt-auto d-flex flex-wrap gap-2">
                        <a href="{{ route('books.show', $book) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye me-1"></i>Xem Chi Tiết
                        </a>

                        @if(auth()->user()->isAdmin() || auth()->user()->isStaff())
                            <a href="{{ route('books.edit', $book) }}" class="btn btn-outline-warning btn-sm">
                                <i class="fas fa-edit me-1"></i>Sửa
                            </a>

                            <form method="POST" action="{{ route('books.destroy', $book) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Bạn có chắc chắn?')">
                                    <i class="fas fa-trash me-1"></i>Xóa
                                </button>
                            </form>
                        @else
                            <a href="{{ route('payments.create', ['book' => $book, 'type' => 'purchase']) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-cart-shopping me-1"></i>Mua
                            </a>

                            @if($book->status === 'available')
                                <a href="{{ route('payments.create', ['book' => $book, 'type' => 'borrow']) }}" class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-handshake me-1"></i>Mượn
                                </a>
                            @else
                                <button type="button" class="btn btn-outline-secondary btn-sm" disabled>
                                    <i class="fas fa-ban me-1"></i>Hết Mượn
                                </button>
                            @endif
                            <form action="{{ route('carts.store') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <button type="submit" class="btn btn-outline-success btn-sm" title="Thêm vào giỏ">
                                    <i class="fas fa-cart-plus"></i>
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    @if($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" class="card-img-top mb-3" alt="Book Image" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center mb-3" style="height: 200px;">
                            <i class="fas fa-book fa-3x text-muted"></i>
                        </div>
                    @endif
                    <h5 class="card-title">{{ $book->name }}</h5>
                    <p class="card-text text-muted">bởi {{ $book->author }}</p>
                    <p class="card-text"><strong>{{ number_format($book->price, 0, ',', '.') }} VNĐ</strong></p>
                    <p class="card-text">
                        <span class="badge bg-{{ $book->status == 'available' ? 'success' : 'danger' }}">
                            <i class="fas fa-{{ $book->status == 'available' ? 'check' : 'times' }} me-1"></i>{{ $book->status == 'available' ? 'Có Sẵn' : 'Không Có Sẵn' }}
                        </span>
                    </p>
                    <p class="card-text small text-muted">
                        <i class="fas fa-tags me-1"></i>{{ $book->categories->pluck('name')->join(', ') ?: 'Không Có Thể Loại' }}
                    </p>
                    <p class="card-text small">
                        <i class="fas fa-handshake me-1"></i>{{ $book->borrows_count }} lượt mượn
                    </p>
                    <div class="mt-auto">
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-outline-warning btn-sm me-1">
                            <i class="fas fa-edit me-1"></i>Sửa
                        </a>
                        <form method="POST" action="{{ route('books.destroy', $book) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm me-1" onclick="return confirm('Bạn có chắc chắn?')">
                                <i class="fas fa-trash me-1"></i>Xóa
                            </button>
                        </form>
                        @if($book->trashed())
                            <form method="POST" action="{{ route('books.restore', $book) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-undo me-1"></i>Khôi Phục
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle fa-2x mb-2"></i>
                <h5>Không Tìm Thấy Sách Nào</h5>
                <p>Hãy thử điều chỉnh bộ lọc hoặc thêm sách mới.</p>
            </div>
        </div>
    @endforelse
</div>

<div class="d-flex justify-content-center">
    {{ $books->appends(request()->query())->links() }}
</div>
@endsection

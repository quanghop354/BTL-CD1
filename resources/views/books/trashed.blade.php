@extends('layouts.master')

@section('title', 'Thùng Rác Sách - Quản Lý Thư Viện')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="fas fa-trash me-2"></i>Thùng Rác Sách</h1>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Quay Lại Danh Sách Sách
    </a>
</div>

@if($trashedBooks->count() > 0)
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-search me-2"></i>Tìm Kiếm</h5>
        </div>
        <div class="card-body">
            <form method="GET">
                <div class="row g-3">
                    <div class="col-md-8">
                        <input type="text" name="search" class="form-control" placeholder="Tìm theo tên hoặc tác giả" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-secondary me-2">
                            <i class="fas fa-search me-1"></i>Tìm Kiếm
                        </button>
                        <a href="{{ route('books.trashed') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i>Xóa Bộ Lọc
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        @forelse($trashedBooks as $book)
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-danger shadow-sm">
                    <div class="card-body d-flex flex-column p-0">
                        @if($book->image)
                            <div class="bg-light d-flex align-items-center justify-content-center border-bottom" style="height: 250px; overflow: hidden; border-top-left-radius: 0.375rem; border-top-right-radius: 0.375rem;">
                                <img src="{{ asset('storage/' . $book->image) }}" class="img-fluid opacity-50" alt="Book Image" style="max-height: 100%; width: 100%; object-fit: contain; padding: 15px; box-shadow: inset 0 0 10px rgba(0,0,0,0.05);">
                            </div>
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center border-bottom opacity-50" style="height: 250px; border-top-left-radius: 0.375rem; border-top-right-radius: 0.375rem;">
                                <i class="fas fa-book fa-4x text-muted opacity-50"></i>
                            </div>
                        @endif
                        <div class="p-3 d-flex flex-column flex-grow-1">
=======
=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-danger">
                    <div class="card-body d-flex flex-column">
                        @if($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" class="card-img-top mb-3 opacity-50" alt="Book Image" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center mb-3 opacity-50" style="height: 200px;">
                                <i class="fas fa-book fa-3x text-muted"></i>
                            </div>
                        @endif
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
                        <h5 class="card-title text-muted">{{ $book->name }}</h5>
                        <p class="card-text text-muted">bởi {{ $book->author }}</p>
                        <p class="card-text"><strong>{{ number_format($book->price, 0, ',', '.') }} VNĐ</strong></p>
                        <p class="card-text small text-muted">
                            <i class="fas fa-tags me-1"></i>{{ $book->categories->pluck('name')->join(', ') ?: 'Không Có Thể Loại' }}
                        </p>
                        <p class="card-text small text-danger">
                            <i class="fas fa-calendar-times me-1"></i>Đã xóa: {{ $book->deleted_at->format('d/m/Y H:i') }}
                        </p>
                        <div class="mt-auto">
                            <form method="POST" action="{{ route('books.restore', $book) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-outline-success btn-sm me-1">
                                    <i class="fas fa-undo me-1"></i>Khôi Phục
                                </button>
                            </form>
                            <form method="POST" action="{{ route('books.force-delete', $book) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn sách này?')">
                                    <i class="fas fa-trash-alt me-1"></i>Xóa Vĩnh Viễn
                                </button>
                            </form>
                        </div>
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
                        </div>
=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle fa-2x mb-2"></i>
                    <h5>Không có sách nào trong thùng rác</h5>
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center">
        {{ $trashedBooks->appends(request()->query())->links() }}
    </div>
@else
    <div class="alert alert-info text-center">
        <i class="fas fa-trash fa-3x mb-3 text-muted"></i>
        <h4>Thùng Rác Trống</h4>
        <p class="mb-0">Không có sách nào đã bị xóa.</p>
        <a href="{{ route('books.index') }}" class="btn btn-primary mt-3">
            <i class="fas fa-arrow-left me-1"></i>Quay Lại Danh Sách Sách
        </a>
    </div>
@endif
@endsection
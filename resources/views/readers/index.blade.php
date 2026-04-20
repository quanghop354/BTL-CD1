@extends('layouts.master')

@section('title', 'Độc Giả - Quản Lý Thư Viện')

@section('breadcrumb')
<x-breadcrumb :items="[
    ['title' => 'Độc giả', 'url' => route('readers.index')]
]" />
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="fas fa-users me-2"></i>Độc Giả</h1>
    <a href="{{ route('readers.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Thêm Độc Giả
    </a>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-search me-2"></i>Tìm Kiếm & Sắp Xếp</h5>
    </div>
    <div class="card-body">
        <form method="GET">
            <div class="row g-3">
                <div class="col-md-8">
                    <input type="text" name="search" class="form-control" placeholder="Tìm theo tên hoặc email" value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="sort_by" class="form-select">
                        <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Ngày Thêm (Mới nhất)</option>
                        <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Tên (A-Z)</option>
                        <option value="borrows_count" {{ request('sort_by') == 'borrows_count' ? 'selected' : '' }}>Số Lượt Mượn (Cao nhất)</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-secondary">
                        <i class="fas fa-search me-1"></i>Tìm
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    @forelse($readers as $reader)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                            <i class="fas fa-user fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1">{{ $reader->name }}</h5>
                            <p class="card-text small text-muted mb-0">{{ $reader->email }}</p>
                        </div>
                    </div>
                    <p class="card-text">
                        <span class="badge bg-info">
                            <i class="fas fa-book me-1"></i>{{ $reader->borrows_count }} lượt mượn
                        </span>
                    </p>
                    <div class="mt-auto">
                        <a href="{{ route('readers.show', $reader) }}" class="btn btn-outline-info btn-sm me-1">
                            <i class="fas fa-eye me-1"></i>Xem
                        </a>
                        <a href="{{ route('readers.edit', $reader) }}" class="btn btn-outline-warning btn-sm me-1">
                            <i class="fas fa-edit me-1"></i>Sửa
                        </a>
                        <form method="POST" action="{{ route('readers.destroy', $reader) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa độc giả này?')">
                                <i class="fas fa-trash me-1"></i>Xóa
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                <i class="fas fa-users fa-2x mb-2"></i>
                <h5>Không Tìm Thấy Độc Giả Nào</h5>
                <p>Hãy thử điều chỉnh bộ lọc hoặc thêm độc giả mới.</p>
            </div>
        </div>
    @endforelse
</div>

<div class="d-flex justify-content-center">
    {{ $readers->appends(request()->query())->links() }}
</div>
@endsection
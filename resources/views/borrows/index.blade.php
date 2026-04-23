@extends('layouts.master')

@section('title', 'Mượn Trả - Quản Lý Thư Viện')

@section('breadcrumb')
<x-breadcrumb :items="[
    ['title' => 'Mượn trả', 'url' => route('borrows.index')]
]" />
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="fas fa-handshake me-2"></i>Mượn Trả</h1>
    <a href="{{ route('borrows.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Thêm Mượn Sách
    </a>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Bộ Lọc</h5>
    </div>
    <div class="card-body">
        <form method="GET">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Sách</label>
                    <select name="book_id" class="form-select">
                        <option value="">Tất Cả Sách</option>
                        @foreach($books as $book)
                            <option value="{{ $book->id }}" {{ request('book_id') == $book->id ? 'selected' : '' }}>{{ $book->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Độc Giả</label>
                    <select name="reader_id" class="form-select">
                        <option value="">Tất Cả Độc Giả</option>
                        @foreach($readers as $reader)
                            <option value="{{ $reader->id }}" {{ request('reader_id') == $reader->id ? 'selected' : '' }}>{{ $reader->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Trạng Thái</label>
                    <select name="status" class="form-select">
                        <option value="">Tất Cả Trạng Thái</option>
                        <option value="borrowed" {{ request('status') == 'borrowed' ? 'selected' : '' }}>Đang Mượn</option>
                        <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>Đã Trả</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-secondary me-2">
                        <i class="fas fa-search me-1"></i>Tìm Kiếm
                    </button>
                    <a href="{{ route('borrows.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-1"></i>Xóa Bộ Lọc
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Sách</th>
                        <th>Độc Giả</th>
                        <th>Ngày Mượn</th>
                        <th>Ngày Trả</th>
                        <th>Trạng Thái</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrows as $borrow)
                        <tr>
                            <td>
                                <strong>{{ $borrow->book->name }}</strong>
                                <br><small class="text-muted">{{ $borrow->book->author }}</small>
                            </td>
                            <td>
                                <strong>{{ $borrow->reader->name }}</strong>
                                <br><small class="text-muted">{{ $borrow->reader->email }}</small>
                            </td>
                            <td>{{ $borrow->borrow_date->format('d/m/Y') }}</td>
                            <td>{{ $borrow->return_date ? $borrow->return_date->format('d/m/Y') : '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $borrow->status == 'returned' ? 'success' : 'warning' }}">
                                    <i class="fas fa-{{ $borrow->status == 'returned' ? 'check' : 'clock' }} me-1"></i>
                                    {{ $borrow->status == 'returned' ? 'Đã Trả' : 'Đang Mượn' }}
                                </span>
                            </td>
                            <td>
                                @if($borrow->status == 'borrowed')
                                    <form method="POST" action="{{ route('borrows.return', $borrow) }}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success btn-sm" onclick="return confirm('Xác nhận trả sách?')">
                                            <i class="fas fa-undo me-1"></i>Trả Sách
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="fas fa-handshake fa-2x mb-2"></i>
                                <p>Không tìm thấy bản ghi mượn trả nào</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $borrows->appends(request()->query())->links() }}
</div>
@endsection
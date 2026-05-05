@extends('layouts.master')

@section('title', 'Chi Tiết Độc Giả - Quản Lý Thư Viện')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="fas fa-user me-2"></i>Chi Tiết Độc Giả</h1>
    <div>
        <a href="{{ route('readers.edit', $reader) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit me-1"></i>Sửa
        </a>
        <a href="{{ route('readers.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i>Quay Lại Danh Sách
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-body text-center">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                    <i class="fas fa-user fa-2x"></i>
                </div>
                <h4 class="card-title">{{ $reader->name }}</h4>
                <p class="card-text text-muted">{{ $reader->email }}</p>
                <p class="card-text">
                    <span class="badge bg-info fs-6">
                        <i class="fas fa-book me-1"></i>{{ $reader->borrows_count }} lượt mượn
                    </span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-history me-2"></i>Lịch Sử Mượn Sách</h5>
            </div>
            <div class="card-body">
                @if($reader->borrows->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Sách</th>
                                    <th>Ngày Mượn</th>
                                    <th>Ngày Trả</th>
                                    <th>Trạng Thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reader->borrows as $borrow)
                                    <tr>
                                        <td>
                                            <strong>{{ $borrow->book->name }}</strong><br>
                                            <small class="text-muted">bởi {{ $borrow->book->author }}</small>
                                        </td>
                                        <td>{{ $borrow->borrowed_at->format('d/m/Y') }}</td>
                                        <td>
                                            @if($borrow->returned_at)
                                                {{ $borrow->returned_at->format('d/m/Y') }}
                                            @else
                                                <span class="text-warning">Chưa trả</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($borrow->returned_at)
                                                <span class="badge bg-success">Đã trả</span>
                                            @else
                                                <span class="badge bg-warning">Đang mượn</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Chưa Có Lịch Sử Mượn Sách</h5>
                        <p class="text-muted">Độc giả này chưa mượn sách nào.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
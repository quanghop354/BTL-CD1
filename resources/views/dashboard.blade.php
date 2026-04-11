@extends('layouts.master')

@section('title', 'Bảng Điều Khiển - Quản Lý Thư Viện')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="fas fa-tachometer-alt me-2"></i>Bảng Điều Khiển</h1>
    <small class="text-muted">Chào mừng đến Hệ Thống Quản Lý Thư Viện</small>
</div>

<div class="row mb-4">
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title"><i class="fas fa-book me-2"></i>Tổng Số Sách</h5>
                        <h2 class="mb-0">{{ $totalBooks }}</h2>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-book fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title"><i class="fas fa-users me-2"></i>Tổng Số Độc Giả</h5>
                        <h2 class="mb-0">{{ $totalReaders }}</h2>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-users fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title"><i class="fas fa-handshake me-2"></i>Tổng Số Mượn</h5>
                        <h2 class="mb-0">{{ $totalBorrows }}</h2>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-handshake fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title"><i class="fas fa-tags me-2"></i>Tổng Số Thể Loại</h5>
                        <h2 class="mb-0">{{ $totalCategories }}</h2>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-tags fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Sách Được Mượn Nhiều Nhất</h5>
            </div>
            <div class="card-body">
                @if($mostBorrowedBooks->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($mostBorrowedBooks as $book)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $book->name }}
                                <span class="badge bg-primary rounded-pill">{{ $book->borrows_count }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted mb-0">Chưa có lượt mượn nào</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Sách Mới Thêm</h5>
            </div>
            <div class="card-body">
                @if($recentBooks->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($recentBooks as $book)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $book->name }}
                                <small class="text-muted">{{ $book->created_at->format('d/m/Y') }}</small>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted mb-0">Chưa có sách nào được thêm</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Mượn Theo Sách</h5>
            </div>
            <div class="card-body">
                @if($borrowsByBook->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($borrowsByBook as $book)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $book->name }}
                                <span class="badge bg-success rounded-pill">{{ $book->borrows_count }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted mb-0">Không có dữ liệu</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-user-friends me-2"></i>Mượn Theo Độc Giả</h5>
            </div>
            <div class="card-body">
                @if($borrowsByReader->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach($borrowsByReader as $reader)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $reader->name }}
                                <span class="badge bg-warning rounded-pill">{{ $reader->borrows_count }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted mb-0">Không có dữ liệu</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
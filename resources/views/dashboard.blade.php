@extends('layouts.master')

{{-- Đặt tiêu đề trang --}}
@section('title', 'Trang chủ - Quản Lý Thư Viện')

{{-- Breadcrumb: Đường dẫn điều hướng --}}
@section('breadcrumb')
<x-breadcrumb :items="[
    ['title' => 'Trang chủ']
]" />
@endsection

{{-- Nội dung chính của trang --}}
@section('content')

{{-- Bắt đầu Banner Giới Thiệu --}}
<div class="card bg-dark text-white mb-4 border-0 shadow-lg overflow-hidden position-relative" style="border-radius: 15px; min-height: 350px;">
    {{-- Ảnh Background lấy từ Unsplash --}}
    <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" class="card-img position-absolute w-100 h-100" alt="Library Background" style="object-fit: cover; opacity: 0.5; top: 0; left: 0; z-index: 0;">
    
    {{-- Lớp phủ gradient để làm nổi bật chữ --}}
    <div class="position-absolute w-100 h-100" style="background: linear-gradient(to right, rgba(118, 75, 162, 0.8), rgba(102, 126, 234, 0.4)); z-index: 1;"></div>
    
    <div class="card-img-overlay d-flex flex-column justify-content-center align-items-center text-center p-4 position-relative" style="z-index: 2;">
        <h1 class="display-4 fw-bold text-white mb-3" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">Thư Viện LibTech</h1>
        <p class="lead text-light mb-4" style="max-width: 800px; text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">Nơi khơi nguồn tri thức, nuôi dưỡng tâm hồn và kết nối những người yêu sách. Khám phá hàng ngàn đầu sách hấp dẫn thuộc mọi thể loại ngay hôm nay!</p>
        <div>
            <a href="{{ route('books.index') }}" class="btn btn-primary btn-lg rounded-pill px-4 py-2 me-2 mb-2 fw-semibold shadow" style="background: linear-gradient(135deg, #FF6B6B 0%, #FF8E53 100%); border: none;">
                <i class="fas fa-search me-2"></i>Tìm Kiếm Sách
            </a>
            <a href="{{ route('borrows.index') }}" class="btn btn-outline-light btn-lg rounded-pill px-4 py-2 mb-2 fw-semibold shadow">
                <i class="fas fa-handshake me-2"></i>Lịch Sử Mượn Trả
            </a>
        </div>
    </div>
</div>
{{-- Kết thúc Banner --}}

<div class="d-flex justify-content-between align-items-center mb-4 mt-5">
    <h3 class="h4 mb-0"><i class="fas fa-chart-line me-2 text-primary"></i>Tổng Quan Tình Hình</h3>
</div>

{{-- ====================================
    PHẦN 1: THỐNG KÊ CỐT LÕI (DASHBOARD STATS)
    ==================================== --}}
<div class="row mb-4">
    {{-- STAT 1: Tổng Số Sách (Hiển thị cho tất cả người dùng) --}}
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="card-title"><i class="fas fa-book me-2"></i>Tổng Số Sách</h5>
                        {{-- Hiển thị tổng số sách từ biến $totalBooks --}}
                        <h2 class="mb-0">{{ $totalBooks }}</h2>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-book fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- 
        STATS: Độc Giả, Mượn, Thể Loại - Chỉ Admin
        Những thống kê này chỉ hiển thị khi người dùng là Admin
    --}}
    @if(Auth::user()->isAdmin())
        {{-- STAT 2: Tổng Số Độc Giả (Chỉ Admin) --}}
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title"><i class="fas fa-users me-2"></i>Tổng Số Độc Giả</h5>
                            {{-- Hiển thị tổng số độc giả từ biến $totalReaders --}}
                            <h2 class="mb-0">{{ $totalReaders }}</h2>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-users fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- STAT 3: Tổng Số Mượn (Chỉ Admin) --}}
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title"><i class="fas fa-handshake me-2"></i>Tổng Số Mượn</h5>
                            {{-- Hiển thị tổng số lần mượn từ biến $totalBorrows --}}
                            <h2 class="mb-0">{{ $totalBorrows }}</h2>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-handshake fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- STAT 4: Tổng Số Thể Loại (Chỉ Admin) --}}
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="card-title"><i class="fas fa-tags me-2"></i>Tổng Số Thể Loại</h5>
                            {{-- Hiển thị tổng số thể loại từ biến $totalCategories --}}
                            <h2 class="mb-0">{{ $totalCategories }}</h2>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-tags fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

{{-- ====================================
    PHẦN 2: BIỂU ĐỒ SÁCH (Hiển thị cho tất cả)
    ==================================== --}}
<div class="row">
    {{-- BIỂU ĐỒ 1: Sách Được Mượn Nhiều Nhất --}}
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Sách Được Mượn Nhiều Nhất</h5>
            </div>
            <div class="card-body">
                {{-- Nếu có sách được mượn -> Hiển thị danh sách --}}
                @if($mostBorrowedBooks->count() > 0)
                    <ul class="list-group list-group-flush">
                        {{-- Lặp qua từng sách được mượn --}}
                        @foreach($mostBorrowedBooks as $book)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{-- Tên sách --}}
                                {{ $book->name }}
                                {{-- Badge hiển thị số lần mượn --}}
                                <span class="badge bg-primary rounded-pill">{{ $book->borrows_count }}</span>
                            </li>
                        @endforeach
                    </ul>
                {{-- Nếu không có sách nào được mượn -> Hiển thị thông báo --}}
                @else
                    <p class="text-muted mb-0">Chưa có lượt mượn nào</p>
                @endif
            </div>
        </div>
    </div>
    
    {{-- BIỂU ĐỒ 2: Sách Mới Thêm --}}
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Sách Mới Thêm</h5>
            </div>
            <div class="card-body">
                {{-- Nếu có sách mới -> Hiển thị danh sách --}}
                @if($recentBooks->count() > 0)
                    <ul class="list-group list-group-flush">
                        {{-- Lặp qua từng sách mới --}}
                        @foreach($recentBooks as $book)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{-- Tên sách --}}
                                {{ $book->name }}
                                {{-- Ngày thêm sách (định dạng dd/mm/yyyy) --}}
                                <small class="text-muted">{{ $book->created_at->format('d/m/Y') }}</small>
                            </li>
                        @endforeach
                    </ul>
                {{-- Nếu không có sách nào -> Hiển thị thông báo --}}
                @else
                    <p class="text-muted mb-0">Chưa có sách nào được thêm</p>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- ====================================
    PHẦN 3: BIỂU ĐỒ QUẢN TRỊ (Chỉ Admin)
    ==================================== --}}
@if(Auth::user()->isAdmin())
<div class="row">
    {{-- BIỂU ĐỒ 3: Mượn Theo Sách (Chỉ Admin) --}}
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Mượn Theo Sách</h5>
            </div>
            <div class="card-body">
                {{-- Nếu có dữ liệu -> Hiển thị danh sách --}}
                @if($borrowsByBook->count() > 0)
                    <ul class="list-group list-group-flush">
                        {{-- Lặp qua từng sách và số lần được mượn --}}
                        @foreach($borrowsByBook as $book)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{-- Tên sách --}}
                                {{ $book->name }}
                                {{-- Badge hiển thị số lần mượn --}}
                                <span class="badge bg-success rounded-pill">{{ $book->borrows_count }}</span>
                            </li>
                        @endforeach
                    </ul>
                {{-- Nếu không có dữ liệu -> Hiển thị thông báo --}}
                @else
                    <p class="text-muted mb-0">Không có dữ liệu</p>
                @endif
            </div>
        </div>
    </div>
    
    {{-- BIỂU ĐỒ 4: Mượn Theo Độc Giả (Chỉ Admin) --}}
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-user-friends me-2"></i>Mượn Theo Độc Giả</h5>
            </div>
            <div class="card-body">
                {{-- Nếu có dữ liệu -> Hiển thị danh sách --}}
                @if($borrowsByReader->count() > 0)
                    <ul class="list-group list-group-flush">
                        {{-- Lặp qua từng độc giả và số lần họ mượn --}}
                        @foreach($borrowsByReader as $reader)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{-- Tên độc giả --}}
                                {{ $reader->name }}
                                {{-- Badge hiển thị số lần mượn của độc giả này --}}
                                <span class="badge bg-warning rounded-pill">{{ $reader->borrows_count }}</span>
                            </li>
                        @endforeach
                    </ul>
                {{-- Nếu không có dữ liệu -> Hiển thị thông báo --}}
                @else
                    <p class="text-muted mb-0">Không có dữ liệu</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endif
@endsection
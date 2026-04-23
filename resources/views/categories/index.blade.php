@extends('layouts.master')

@section('title', 'Thể Loại - Quản Lý Thư Viện')

@section('breadcrumb')
<x-breadcrumb :items="[
    ['title' => 'Thể loại', 'url' => route('categories.index')]
]" />
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="fas fa-tags me-2"></i>Thể Loại</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Thêm Thể Loại
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tên Thể Loại</th>
                        <th>Mô Tả</th>
                        <th>Số Lượng Sách</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>
                                <strong>{{ $category->name }}</strong>
                            </td>
                            <td>{{ $category->description ?? 'Không có mô tả' }}</td>
                            <td>
                                <span class="badge bg-primary">{{ $category->books_count }}</span>
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-outline-warning btn-sm me-1">
                                    <i class="fas fa-edit me-1"></i>Sửa
                                </a>
                                <form method="POST" action="{{ route('categories.destroy', $category) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa thể loại này?')">
                                        <i class="fas fa-trash me-1"></i>Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                <i class="fas fa-tags fa-2x mb-2"></i>
                                <p>Chưa có thể loại nào</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
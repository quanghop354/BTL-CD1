@extends('layouts.master')
@section('title', 'Danh Sách Tác Giả')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="fas fa-user-tie me-2"></i>Danh Sách Tác Giả</h1>
    <a href="{{ route('authors.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i>Thêm Tác Giả</a>
</div>
<div class="card mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Tác Giả</th>
                        <th>Tiểu Sử</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($authors as $author)
                    <tr>
                        <td>{{ $author->id }}</td>
                        <td class="fw-bold">{{ $author->name }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($author->bio, 50) }}</td>
                        <td>
                            <a href="{{ route('authors.edit', $author) }}" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('authors.destroy', $author) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa tác giả này?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-muted">Chưa có tác giả nào</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="custom-pagination mt-3 d-flex justify-content-center">
            {{ $authors->links() }}
        </div>
    </div>
</div>
@endsection

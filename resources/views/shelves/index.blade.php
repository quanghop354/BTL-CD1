@extends('layouts.master')
@section('title', 'Danh Sách Kệ Sách')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="fas fa-layer-group me-2"></i>Danh Sách Kệ Sách</h1>
    <a href="{{ route('shelves.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i>Thêm Kệ Sách</a>
</div>
<div class="card mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Kệ Sách</th>
                        <th>Vị Trí</th>
                        <th>Mô Tả</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($shelves as $shelf)
                    <tr>
                        <td>{{ $shelf->id }}</td>
                        <td class="fw-bold">{{ $shelf->name }}</td>
                        <td>{{ $shelf->location }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($shelf->description, 50) }}</td>
                        <td>
                            <a href="{{ route('shelves.edit', $shelf) }}" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('shelves.destroy', $shelf) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa kệ sách này?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted">Chưa có kệ sách nào</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="custom-pagination mt-3 d-flex justify-content-center">
            {{ $shelves->links() }}
        </div>
    </div>
</div>
@endsection

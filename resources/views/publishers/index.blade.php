@extends('layouts.master')
@section('title', 'Danh Sách Nhà Xuất Bản')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="fas fa-building me-2"></i>Danh Sách Nhà Xuất Bản</h1>
    <a href="{{ route('publishers.create') }}" class="btn btn-primary"><i class="fas fa-plus me-1"></i>Thêm NXB</a>
</div>
<div class="card mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên NXB</th>
                        <th>Email</th>
                        <th>SĐT</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($publishers as $publisher)
                    <tr>
                        <td>{{ $publisher->id }}</td>
                        <td class="fw-bold">{{ $publisher->name }}</td>
                        <td>{{ $publisher->email }}</td>
                        <td>{{ $publisher->phone }}</td>
                        <td>
                            <a href="{{ route('publishers.edit', $publisher) }}" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('publishers.destroy', $publisher) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa NXB này?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted">Chưa có nhà xuất bản nào</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="custom-pagination mt-3 d-flex justify-content-center">
            {{ $publishers->links() }}
        </div>
    </div>
</div>
@endsection

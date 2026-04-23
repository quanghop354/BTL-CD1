@extends('layouts.master')
@section('title', 'Đánh Giá & Nhận Xét')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="fas fa-star me-2 text-warning"></i>Đánh Giá & Nhận Xét</h1>
</div>
<div class="card mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Người Dùng</th>
                        <th>Sách</th>
                        <th>Đánh Giá</th>
                        <th>Bình Luận</th>
                        <th>Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                    <tr>
                        <td>{{ $review->id }}</td>
                        <td class="fw-bold">{{ $review->user->name ?? 'N/A' }}</td>
                        <td>{{ $review->book->name ?? 'N/A' }}</td>
                        <td>
                            <span class="text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $review->rating ? '' : 'text-light' }}"></i>
                                @endfor
                            </span>
                        </td>
                        <td>{{ \Illuminate\Support\Str::limit($review->comment, 50) }}</td>
                        <td>
                            <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa đánh giá này?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted">Chưa có đánh giá nào</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="custom-pagination mt-3 d-flex justify-content-center">
            {{ $reviews->links() }}
        </div>
    </div>
</div>
@endsection

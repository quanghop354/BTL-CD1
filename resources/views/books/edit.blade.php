@extends('layouts.master')

@section('title', 'Sửa Sách - Quản Lý Thư Viện')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="fas fa-edit me-2"></i>Sửa Sách</h1>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i>Quay Lại Danh Sách Sách
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-book me-2"></i>Thông Tin Sách</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('books.update', $book) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-heading me-1"></i>Tên Sách <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $book->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="author" class="form-label">
                                <i class="fas fa-user me-1"></i>Tác Giả <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author', $book->author) }}" required>
                            @error('author')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">
                                <i class="fas fa-dollar-sign me-1"></i>Giá <span class="text-danger">*</span>
                            </label>
                            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $book->price) }}" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category_ids" class="form-label">
                                <i class="fas fa-tags me-1"></i>Thể Loại <span class="text-danger">*</span>
                            </label>
                            <div class="border p-3" style="max-height: 200px; overflow-y: auto;">
                                @foreach($categories as $category)
                                    <div class="form-check">
                                        <input class="form-check-input category-checkbox" type="checkbox" name="category_ids[]" value="{{ $category->id }}" id="category_{{ $category->id }}"
                                               {{ in_array($category->id, old('category_ids', $book->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="category_{{ $category->id }}">
                                            {{ $category->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-text">Chọn tối đa 2 thể loại</div>
                            @error('category_ids')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="publisher_id" class="form-label">
                            <i class="fas fa-building me-1"></i>Nhà Xuất Bản
                        </label>
                        <select class="form-select @error('publisher_id') is-invalid @enderror" id="publisher_id" name="publisher_id">
                            <option value="">-- Chọn Nhà Xuất Bản (Tùy chọn) --</option>
                            @foreach($publishers as $publisher)
                                <option value="{{ $publisher->id }}" {{ old('publisher_id', $book->publisher_id) == $publisher->id ? 'selected' : '' }}>{{ $publisher->name }}</option>
                            @endforeach
                        </select>
                        @error('publisher_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">
                            <i class="fas fa-align-left me-1"></i>Mô Tả
                        </label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $book->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">
                                <i class="fas fa-info-circle me-1"></i>Trạng Thái <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="available" {{ old('status', $book->status) == 'available' ? 'selected' : '' }}>Có Sẵn</option>
                                <option value="unavailable" {{ old('status', $book->status) == 'unavailable' ? 'selected' : '' }}>Không Có Sẵn</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label">
                                <i class="fas fa-image me-1"></i>Ảnh Bìa Sách
                            </label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            @if($book->image)
                                <img src="{{ asset('storage/' . $book->image) }}" class="img-thumbnail mt-2" style="max-width: 100px;">
                            @endif
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Tải lên ảnh bìa mới nếu muốn thay đổi</div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('books.index') }}" class="btn btn-outline-secondary me-md-2">
                            <i class="fas fa-times me-1"></i>Hủy
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Cập Nhật Sách
                        </button>
                    </div>
                </form>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const checkboxes = document.querySelectorAll('.category-checkbox');
                        checkboxes.forEach(checkbox => {
                            checkbox.addEventListener('change', function() {
                                const checkedBoxes = document.querySelectorAll('.category-checkbox:checked');
                                if (checkedBoxes.length > 2) {
                                    this.checked = false;
                                    alert('Chỉ được chọn tối đa 2 thể loại!');
                                }
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
@endsection
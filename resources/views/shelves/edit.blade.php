@extends('layouts.master')
@section('title', 'Sửa Kệ Sách')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="fas fa-edit me-2"></i>Sửa Kệ Sách</h1>
</div>
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('shelves.update', $shelf) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Tên kệ sách <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $shelf->name) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Vị trí</label>
                <input type="text" name="location" class="form-control" value="{{ old('location', $shelf->location) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $shelf->description) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Cập nhật</button>
            <a href="{{ route('shelves.index') }}" class="btn btn-secondary"><i class="fas fa-times me-1"></i>Hủy</a>
        </form>
    </div>
</div>
@endsection

@extends('layouts.master')
@section('title', 'Thêm Tác Giả')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="fas fa-plus me-2"></i>Thêm Tác Giả</h1>
</div>
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('authors.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Tên tác giả <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Tiểu sử</label>
                <textarea name="bio" class="form-control" rows="4">{{ old('bio') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Lưu</button>
            <a href="{{ route('authors.index') }}" class="btn btn-secondary"><i class="fas fa-times me-1"></i>Hủy</a>
        </form>
    </div>
</div>
@endsection

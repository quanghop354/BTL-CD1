@extends('layouts.master')
@section('title', 'Sửa Nhà Xuất Bản')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="fas fa-edit me-2"></i>Sửa Nhà Xuất Bản</h1>
</div>
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('publishers.update', $publisher) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Tên nhà xuất bản <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $publisher->name) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Địa chỉ</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $publisher->address) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $publisher->email) }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Số điện thoại</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $publisher->phone) }}">
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Cập nhật</button>
            <a href="{{ route('publishers.index') }}" class="btn btn-secondary"><i class="fas fa-times me-1"></i>Hủy</a>
        </form>
    </div>
</div>
@endsection

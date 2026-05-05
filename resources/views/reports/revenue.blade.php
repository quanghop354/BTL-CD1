@extends('layouts.master')

@section('title', 'Báo Cáo Doanh Thu')

@section('breadcrumb')
<x-breadcrumb :items="[
    ['title' => 'Báo Cáo Doanh Thu']
]" />
@endsection

@section('content')
<div class="card mb-4">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Báo Cáo Doanh Thu</h5>
        <a href="{{ route('reports.revenue.export', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn btn-sm btn-success">
            <i class="fas fa-file-excel me-1"></i> Xuất Excel (CSV)
        </a>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('reports.revenue') }}" class="row g-3 mb-4">
            <div class="col-md-4">
                <label for="start_date" class="form-label">Từ ngày</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $startDate }}" required>
            </div>
            <div class="col-md-4">
                <label for="end_date" class="form-label">Đến ngày</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $endDate }}" required>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-filter me-1"></i> Lọc Dữ Liệu
                </button>
            </div>
        </form>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="p-3 bg-light rounded border text-center">
                    <h6 class="text-muted mb-2">Tổng Doanh Thu</h6>
                    <h3 class="text-primary mb-0">{{ number_format($totalRevenue, 0, ',', '.') }} VNĐ</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 bg-light rounded border text-center">
                    <h6 class="text-muted mb-2">Doanh Thu Mua Sách</h6>
                    <h3 class="text-success mb-0">{{ number_format($purchaseRevenue, 0, ',', '.') }} VNĐ</h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 bg-light rounded border text-center">
                    <h6 class="text-muted mb-2">Doanh Thu Mượn Sách</h6>
                    <h3 class="text-info mb-0">{{ number_format($borrowRevenue, 0, ',', '.') }} VNĐ</h3>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Mã GD</th>
                        <th>Khách Hàng</th>
                        <th>Sách</th>
                        <th>Loại</th>
                        <th>Số Tiền</th>
                        <th>Phương Thức</th>
                        <th>Ngày Thanh Toán</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                    <tr>
                        <td>#{{ $payment->id }}</td>
                        <td>{{ $payment->user->name ?? 'N/A' }}</td>
                        <td>{{ $payment->book->name ?? 'N/A' }}</td>
                        <td>
                            <span class="badge bg-{{ $payment->type == 'purchase' ? 'success' : 'info' }}">
                                {{ $payment->type == 'purchase' ? 'Mua sách' : 'Mượn sách' }}
                            </span>
                        </td>
                        <td class="fw-bold text-primary">{{ number_format($payment->amount, 0, ',', '.') }} đ</td>
                        <td>{{ strtoupper($payment->payment_method) }}</td>
                        <td>{{ $payment->paid_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Không có giao dịch nào trong khoảng thời gian này.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

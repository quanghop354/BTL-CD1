<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function revenue(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());

        $payments = Payment::with(['user', 'book'])
            ->where('payment_status', 'paid')
            ->whereBetween('paid_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->orderBy('paid_at', 'desc')
            ->get();

        $totalRevenue = $payments->sum('amount');
        $purchaseRevenue = $payments->where('type', 'purchase')->sum('amount');
        $borrowRevenue = $payments->where('type', 'borrow')->sum('amount');

        return view('reports.revenue', compact('payments', 'startDate', 'endDate', 'totalRevenue', 'purchaseRevenue', 'borrowRevenue'));
    }

    public function exportExcel(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());

        $payments = Payment::with(['user', 'book'])
            ->where('payment_status', 'paid')
            ->whereBetween('paid_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
            ->orderBy('paid_at', 'desc')
            ->get();

        $fileName = "baocao_doanhthu_{$startDate}_to_{$endDate}.csv";

        $headers = array(
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $callback = function() use($payments, $startDate, $endDate) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8 to display Vietnamese correctly in Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Report Header
            fputcsv($file, ['BÁO CÁO DOANH THU THƯ VIỆN']);
            fputcsv($file, ['Từ ngày', $startDate, 'Đến ngày', $endDate]);
            fputcsv($file, ['Ngày xuất', Carbon::now()->format('d/m/Y H:i:s')]);
            fputcsv($file, []);

            // Summary
            $totalRevenue = $payments->sum('amount');
            $purchaseRevenue = $payments->where('type', 'purchase')->sum('amount');
            $borrowRevenue = $payments->where('type', 'borrow')->sum('amount');
            fputcsv($file, ['Tổng doanh thu', $totalRevenue . ' VNĐ']);
            fputcsv($file, ['Doanh thu mua sách', $purchaseRevenue . ' VNĐ']);
            fputcsv($file, ['Doanh thu mượn sách', $borrowRevenue . ' VNĐ']);
            fputcsv($file, []);

            // Data Headers
            fputcsv($file, ['ID Giao Dịch', 'Khách Hàng', 'Sách', 'Loại Giao Dịch', 'Số Tiền (VNĐ)', 'Phương Thức', 'Ngày Thanh Toán', 'Ghi Chú']);

            // Data Rows
            foreach ($payments as $payment) {
                fputcsv($file, [
                    $payment->id,
                    $payment->user->name ?? 'N/A',
                    $payment->book->name ?? 'N/A',
                    $payment->type === 'purchase' ? 'Mua sách' : 'Mượn sách',
                    $payment->amount,
                    strtoupper($payment->payment_method),
                    $payment->paid_at->format('d/m/Y H:i:s'),
                    $payment->notes
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

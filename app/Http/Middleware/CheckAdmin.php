<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware CheckAdmin - Kiểm Tra Quyền Truy Cập Admin
 * 
 * Middleware này kiểm tra xem người dùng hiện tại có phải là Admin hay không
 * Nếu không phải admin → Trả về lỗi 403 Forbidden
 * Nếu là admin → Cho phép tiếp tục xử lý request
 * 
 * Cách sử dụng trong routes:
 * Route::middleware('admin')->group(function () {
 *     // Các route chỉ admin có thể truy cập
 * });
 * 
 * @package App\Http\Middleware
 */
class CheckAdmin
{
    /**
     * Xử lý yêu cầu (request) đến từ client
     * 
     * Kiểm tra xem:
     * 1. Người dùng đã đăng nhập chưa? (auth()->check())
     * 2. Vai trò của người dùng có phải 'admin' không? (auth()->user()->role === 'admin')
     * 
     * Nếu cả hai điều kiện đều đúng → Cho phép tiếp tục
     * Nếu một trong hai không đúng → Trả về lỗi 403
     *
     * @param \Illuminate\Http\Request $request Đối tượng yêu cầu từ client
     * @param \Closure $next Hàm gọi middleware tiếp theo hoặc xử lý request
     * 
     * @return \Symfony\Component\HttpFoundation\Response Phản hồi HTTP
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra: Người dùng không đăng nhập HOẶC vai trò không phải 'admin'
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            // Trả về lỗi 403 Forbidden (Cấm truy cập)
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        // Người dùng là admin → Cho phép tiếp tục xử lý request
        return $next($request);
    }
}

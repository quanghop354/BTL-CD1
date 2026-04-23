<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReaderController;
use Illuminate\Support\Facades\Auth;

/**
 * ========================================
 * HỆ THỐNG ĐỊNH TUYẾN (ROUTES)
 * LibTech - Role-Based Access Control
 * ========================================
 * 
 * Các middleware được sử dụng:
 * - 'guest':  Chỉ cho phép người dùng chưa đăng nhập
 * - 'auth':   Chỉ cho phép người dùng đã đăng nhập
 * - 'admin':  Chỉ cho phép người dùng có vai trò 'admin'
 */

/**
 * ========================================
 * ROUTE TRANG CHỦ
 * ========================================
 * 
 * GET / - Trang chủ
 * - Nếu đã đăng nhập → Hiển thị trang welcome
 * - Nếu chưa đăng nhập → Chuyển hướng đến trang login
 */
Route::get('/', function () {
    if (Auth::check()) {
        return view('welcome');
    }
    return redirect()->route('login');
});

/**
 * ========================================
 * ROUTES XÁC THỰC (AUTH) - CHƯA ĐĂNG NHẬP
 * ========================================
 * 
 * Middleware 'guest': Chỉ người dùng chưa đăng nhập mới có thể truy cập
 * Nếu đã đăng nhập → Tự động chuyển hướng đến dashboard
 */
Route::middleware('guest')->group(function () {
    // Hiển thị form đăng nhập
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    
    // Xử lý dữ liệu đăng nhập (gửi email/username + password)
    Route::post('login', [AuthController::class, 'login']);
    
    // Chuyển hướng đến Google OAuth
    Route::get('login/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
    
    // Xử lý callback từ Google OAuth
    Route::get('login/google/callback', [AuthController::class, 'handleGoogleCallback']);
    
    // Hiển thị form đăng ký
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    
    // Xử lý dữ liệu đăng ký
    Route::post('register', [AuthController::class, 'register']);
});

/**
 * ========================================
 * ROUTE ĐĂNG XUẤT
 * ========================================
 * 
 * POST /logout - Đăng xuất (không cần auth middleware vì controller tự kiểm tra)
 */
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

/**
 * ========================================
 * ROUTES CHO NGƯỜI DÙNG ĐÃ ĐĂNG NHẬP
 * ========================================
 * 
 * Middleware 'auth': Chỉ người dùng đã đăng nhập mới có thể truy cập
 * Bao gồm cả Admin và User thường
 */
Route::middleware('auth')->group(function () {
    /**
     * ========================================
     * DASHBOARD & PROFILE - TẤT CẢ NGƯỜI DÙNG
     * ========================================
     */
    
    // Bảng điều khiển (Dashboard)
    // - Admin: Xem tất cả thống kê
    // - User: Xem thống kê giới hạn
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile - Thông tin cá nhân
    // GET: Hiển thị form chỉnh sửa thông tin cá nhân
    Route::get('/profile', [AuthController::class, 'editProfile'])->name('profile.edit');
    
    // PUT: Cập nhật thông tin cá nhân
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

    /**
     * ========================================
     * ROUTES SÁCH - TẤT CẢ NGƯỜI DÙNG
     * ========================================
     * Tất cả người dùng có thể:
     * - Xem danh sách sách
     * - Xem chi tiết một cuốn sách
     * 
     * Chỉ Admin có thể:
     * - Tạo, chỉnh sửa, xóa sách (xem dưới phần Admin)
     */
    
    // Danh sách sách
    Route::get('books', [BookController::class, 'index'])->name('books.index');
    
    // Chi tiết một cuốn sách
    Route::get('books/{book}', [BookController::class, 'show'])->name('books.show')->whereNumber('book');

    /**
     * ========================================
     * ROUTES MƯỢN SÁCH - TẤT CẢ NGƯỜI DÙNG
     * ========================================
     * Tất cả người dùng có thể:
     * - Xem form tạo mượn sách
     * - Tạo yêu cầu mượn sách mới
     * - Xem danh sách mượn của mình
     * - Xem chi tiết một lần mượn
     * 
     * Chỉ Admin có thể:
     * - Xác nhận trả sách, xóa mượn, v.v. (xem dưới phần Admin)
     */
    
    // Form tạo mượn sách mới
    Route::get('borrows/create', [BorrowController::class, 'create'])->name('borrows.create');
    
    // Lưu yêu cầu mượn sách mới
    Route::post('borrows', [BorrowController::class, 'store'])->name('borrows.store');
    
    // Danh sách mượn sách
    Route::get('borrows', [BorrowController::class, 'index'])->name('borrows.index');
    
    // Chi tiết một lần mượn sách
    Route::get('borrows/{borrow}', [BorrowController::class, 'show'])->name('borrows.show');

    /**
     * ========================================
     * ROUTES THANH TOÁN - TẤT CẢ NGƯỜI DÙNG ĐÃ ĐĂNG NHẬP
     * ========================================
     */

    // Danh sách thanh toán
    Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');

    // Form thanh toán cho một cuốn sách (mua hoặc mượn)
    Route::get('books/{book}/payment', [PaymentController::class, 'create'])->name('payments.create');

    // Tạo yêu cầu thanh toán cho một cuốn sách
    Route::post('books/{book}/payment', [PaymentController::class, 'store'])->name('payments.store');

    /**
     * ========================================
     * ROUTES QUẢN TRỊ - CHỈ ADMIN
     * ========================================
     * 
     * Middleware 'admin': Kiểm tra xem người dùng có vai trò 'admin' không
     * Nếu không phải admin → Lỗi 403 Forbidden
     * 
     * Bao gồm:
     * - Tạo/Sửa/Xóa Sách
     * - Tạo/Sửa/Xóa Thể Loại
     * - Tạo/Sửa/Xóa Độc Giả
     * - Quản Lý Mượn Trả (xác nhận trả sách, v.v.)
     */
    Route::middleware('admin')->group(function () {
        /**
         * QUẢN LÝ SÁCH - Chỉ Admin
         * 
         * Resource routes: create, store, edit, update, destroy
         * except(['index', 'show']): Cấm admin ở routes index/show vì đã có ở trên
         */
        
        // Tạo/Sửa/Xóa sách
        Route::resource('books', BookController::class)->except(['index', 'show']);
        
        // Khôi phục sách đã xóa mềm (soft delete)
        Route::post('books/{id}/restore', [BookController::class, 'restore'])->name('books.restore');
        
        // Danh sách sách đã xóa (trash)
        Route::get('books-trashed', [BookController::class, 'trashed'])->name('books.trashed');
        
        // Xóa vĩnh viễn sách
        Route::delete('books/{id}/force-delete', [BookController::class, 'forceDelete'])->name('books.force-delete');

        /**
         * QUẢN LÝ THỂ LOẠI - Chỉ Admin
         * 
         * Resource: Tất cả CRUD operations
         * - create: Tạo thể loại mới
         * - store: Lưu thể loại mới
         * - index: Danh sách thể loại (đã có ở phía trên, không cấm)
         * - show: Chi tiết thể loại (tùy chọn)
         * - edit: Form chỉnh sửa thể loại
         * - update: Cập nhật thể loại
         * - destroy: Xóa thể loại
         */
        Route::resource('categories', CategoryController::class);

        /**
         * QUẢN LÝ MƯỢN TRẢ - Chỉ Admin
         * 
         * Xác nhận trả sách (post)
         * Xóa bản ghi mượn, cập nhật, v.v.
         */
        
        // Xác nhận trả sách
        Route::post('borrows/{borrow}/return', [BorrowController::class, 'returnBook'])->name('borrows.return');
        
        // Tất cả CRUD cho mượn (ngoại trừ index/create/store/show vì đã có ở trên)
        Route::resource('borrows', BorrowController::class)->except(['index', 'create', 'store', 'show']);

        // Cập nhật trạng thái thanh toán
        Route::patch('payments/{payment}/status', [PaymentController::class, 'updateStatus'])->name('payments.update-status');

        /**
         * QUẢN LÝ ĐỘC GIẢ - Chỉ Admin
         * 
         * Resource: Tất cả CRUD operations
         * - create: Tạo độc giả mới
         * - store: Lưu độc giả mới
         * - index: Danh sách độc giả
         * - show: Chi tiết độc giả
         * - edit: Form chỉnh sửa độc giả
         * - update: Cập nhật độc giả
         * - destroy: Xóa độc giả
         */
        Route::resource('readers', ReaderController::class);

        // New modules to meet requirement
        Route::resource('authors', \App\Http\Controllers\AuthorController::class)->except(['show']);
        Route::resource('publishers', \App\Http\Controllers\PublisherController::class)->except(['show']);
        Route::resource('shelves', \App\Http\Controllers\ShelfController::class)->except(['show']);
        Route::resource('reviews', \App\Http\Controllers\ReviewController::class)->only(['index', 'destroy']);
    });
});

/**
 * ========================================
 * GHI CHÚ VỀ MIDDLEWARE
 * ========================================
 * 
 * Cấp độ bảo vệ:
 * 1. Middleware kiểm tra vai trò ở tầng Route (web.php)
 * 2. Controller kiểm tra lại vai trò (bảo vệ thêm)
 * 3. Blade template ẩn UI dựa trên vai trò
 * 
 * Thứ tự kiểm tra:
 * guest -> auth -> admin
 * 
 * Nếu không đạt một middleware nào → 403 Forbidden
 */

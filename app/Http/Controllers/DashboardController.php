<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Category;
use App\Models\Reader;
use Illuminate\Http\Request;

<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
/**
 * Controller Bảng Điều Khiển (Dashboard)
 * Quản lý hiển thị bảng điều khiển dựa trên vai trò của người dùng:
 * - Admin: Xem tất cả thống kê (sách, độc giả, mượn, thể loại) và biểu đồ chi tiết
 * - User: Xem chỉ thống kê sách và danh sách sách được mượn nhiều nhất
 * 
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * Hiển thị bảng điều khiển với dữ liệu khác nhau tùy theo vai trò người dùng
     * 
     * Dashboard Admin bao gồm:
     * - Tổng số sách, độc giả, lần mượn, thể loại
     * - 5 sách được mượn nhiều nhất
     * - 5 sách mới nhất
     * - Biểu đồ mượn theo sách
     * - Biểu đồ mượn theo độc giả
     * 
     * Dashboard User bao gồm:
     * - Tổng số sách
     * - 5 sách được mượn nhiều nhất
     * - 5 sách mới nhất
     *
     * @return \Illuminate\View\View Trả về view dashboard với dữ liệu tương ứng
     */
    public function index()
    {
        // Lấy thông tin người dùng hiện tại đã đăng nhập
        $user = auth()->user();
        
        // ===== KIỂM TRA VAI TRÒ: ADMIN HAY USER? =====
        if ($user->isAdmin() || $user->isStaff()) {
            // ========================================
            // BẢNG ĐIỀU KHIỂN CHO QUẢN TRỊ VIÊN (ADMIN)
            // ========================================
            
            // 1. THỐNG KÊ CƠ BẢN - Tổng số các đối tượng trong hệ thống
            
            // Đếm tổng số sách trong thư viện
            $totalBooks = Book::count();
            
            // Đếm tổng số độc giả (Reader) đã đăng ký
            $totalReaders = Reader::count();
            
            // Đếm tổng số lần mượn sách (bao gồm cả mượn chưa trả)
            $totalBorrows = Borrow::count();
            
            // Đếm tổng số thể loại sách
            $totalCategories = Category::count();

            // 2. LẤY DANH SÁCH CÁC CUỐN SÁCH ĐƯỢC MƯỢN NHIỀU NHẤT
            // withCount('borrows'): Đếm số lần mượn của mỗi sách
            // orderBy('borrows_count', 'desc'): Sắp xếp theo số lần mượn (từ cao đến thấp)
            // take(5): Lấy top 5 cuốn sách
            $mostBorrowedBooks = Book::withCount('borrows')
                                    ->orderBy('borrows_count', 'desc')
                                    ->take(5)
                                    ->get();
            
            // 3. LẤY DANH SÁCH 5 CUỐN SÁCH MỚI NHẤT ĐƯỢC THÊM VÀO HỆ THỐNG
            // latest(): Sắp xếp theo ngày tạo, mới nhất trước
            $recentBooks = Book::latest()->take(5)->get();

            // 4. TÊN BIỂU ĐỒ: "MƯỢN THEO SÁCH"
            // Lấy danh sách tất cả sách được mượn (borrows_count > 0)
            // Cùng với số lần mượn của mỗi cuốn sách
            $borrowsByBook = Book::withCount('borrows')
                                ->having('borrows_count', '>', 0)
                                ->orderBy('borrows_count', 'desc')
                                ->get();
            
            // 5. TÊN BIỂU ĐỒ: "MƯỢN THEO ĐỘC GIẢ"
            // Lấy danh sách tất cả độc giả đã mượn (borrows_count > 0)
            // Cùng với số lần mượn của mỗi độc giả
            $borrowsByReader = Reader::withCount('borrows')
                                    ->having('borrows_count', '>', 0)
                                    ->orderBy('borrows_count', 'desc')
                                    ->get();

            // Trả về view dashboard với tất cả dữ liệu thống kê cho Admin
            return view('dashboard', compact(
                'totalBooks',       // Tổng sách
                'totalReaders',     // Tổng độc giả
                'totalBorrows',     // Tổng lần mượn
                'totalCategories',  // Tổng thể loại
                'mostBorrowedBooks',   // 5 sách mượn nhiều nhất
                'recentBooks',         // 5 sách mới nhất
                'borrowsByBook',       // Dữ liệu biểu đồ mượn theo sách
                'borrowsByReader'      // Dữ liệu biểu đồ mượn theo độc giả
            ));
        } else {
            // ==========================================
            // BẢNG ĐIỀU KHIỂN CHO NGƯỜI DÙNG THƯỜNG (USER)
            // ==========================================
            // User chỉ xem thông tin liên quan đến sách và mượn
            
            // Lấy tổng số sách trong hệ thống
            $totalBooks = Book::count();
            
            // Lấy 5 cuốn sách được mượn nhiều nhất (để độc giả biết sách nào phổ biến)
            $mostBorrowedBooks = Book::withCount('borrows')
                                    ->orderBy('borrows_count', 'desc')
                                    ->take(5)
                                    ->get();
            
            // Lấy 5 cuốn sách mới nhất (để độc giả khám phá sách mới)
            $recentBooks = Book::latest()->take(5)->get();

            // Trả về view dashboard với dữ liệu giới hạn cho User thường
            return view('dashboard', compact(
                'totalBooks',       // Tổng sách
                'mostBorrowedBooks',   // 5 sách mượn nhiều nhất
                'recentBooks'          // 5 sách mới nhất
            ));
        }
    }
}

=======
=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalReaders = Reader::count();
        $totalBorrows = Borrow::count();
        $totalCategories = Category::count();

        $mostBorrowedBooks = Book::withCount('borrows')->orderBy('borrows_count', 'desc')->take(5)->get();
        $recentBooks = Book::latest()->take(5)->get();

        $borrowsByBook = Book::withCount('borrows')->where('borrows_count', '>', 0)->orderBy('borrows_count', 'desc')->get();
        $borrowsByReader = Reader::withCount('borrows')->where('borrows_count', '>', 0)->orderBy('borrows_count', 'desc')->get();

        return view('dashboard', compact('totalBooks', 'totalReaders', 'totalBorrows', 'totalCategories', 'mostBorrowedBooks', 'recentBooks', 'borrowsByBook', 'borrowsByReader'));
    }
}
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)

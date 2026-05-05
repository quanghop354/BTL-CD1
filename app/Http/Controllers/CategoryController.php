<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
/**
 * Controller Thể Loại Sách - Quản Lý Danh Sách Thể Loại
 * 
 * Chỉ Admin mới có thể tạo, sửa, xóa thể loại
 * Tất cả người dùng có thể xem danh sách thể loại
 * 
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     * Hiển Thị Danh Sách Tất Cả Thể Loại
     * 
     * Lấy tất cả thể loại từ database và tính số lượng sách trong mỗi thể loại
     * withCount('books'): Đếm số sách thuộc thể loại đó
     * 
     * @return \Illuminate\View\View View hiển thị danh sách thể loại
     */
    public function index()
    {
        // Lấy tất cả thể loại kèm theo số lượng sách của mỗi thể loại
        $categories = Category::withCount('books')->get();
        
        // Trả về view với dữ liệu thể loại
=======
=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('books')->get();
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
        return view('categories.index', compact('categories'));
    }

    /**
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
     * Hiển Thị Form Tạo Thể Loại Mới
     * 
     * Chỉ Admin mới có thể tạo thể loại
     * Nếu user không phải admin → Lỗi 403 Forbidden
     * 
     * @return \Illuminate\View\View Form tạo thể loại mới
     */
    public function create()
    {
        // Kiểm tra xem người dùng có phải admin không
        if (!auth()->user()->isAdmin() && !auth()->user()->isStaff()) {
            // Nếu không phải admin → Từ chối truy cập
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        // Hiển thị form tạo thể loại mới
=======
=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
        return view('categories.create');
    }

    /**
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
     * Lưu Thể Loại Mới Vào Database
     * 
     * Chỉ Admin mới có thể lưu thể loại
     * Validate dữ liệu nhập vào (tên bắt buộc, mô tả tùy chọn)
     * 
     * @param \Illuminate\Http\Request $request Dữ liệu từ form
     * @return \Illuminate\Http\RedirectResponse Chuyển hướng về danh sách thể loại
     */
    public function store(Request $request)
    {
        // Kiểm tra xem người dùng có phải admin không
        if (!auth()->user()->isAdmin() && !auth()->user()->isStaff()) {
            // Nếu không phải admin → Từ chối truy cập
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        // Validate dữ liệu nhập vào:
        // - name: bắt buộc, kiểu string, tối đa 255 ký tự
        // - description: tùy chọn, kiểu string
        $request->validate([
            'name' => 'required|string|max:255',           // Tên thể loại (bắt buộc)
            'description' => 'nullable|string',             // Mô tả thể loại (tùy chọn)
        ]);

        // Lưu thể loại mới vào database
        Category::create($request->all());

        // Chuyển hướng về danh sách thể loại với thông báo thành công
        return redirect()
            ->route('categories.index')
            ->with('success', 'Thể loại đã được tạo thành công.');
    }

    /**
     * Hiển Thị Chi Tiết Một Thể Loại (Không sử dụng)
     * 
     * @param string $id ID của thể loại
     */
    public function show(string $id)
    {
        // Hàm này không được sử dụng trong ứng dụng
        // Có thể dùng trong tương lai nếu cần hiển thị chi tiết thể loại
    }

    /**
     * Hiển Thị Form Chỉnh Sửa Thể Loại
     * 
     * Chỉ Admin mới có thể sửa thể loại
     * Nếu user không phải admin → Lỗi 403 Forbidden
     * 
     * @param \App\Models\Category $category Đối tượng thể loại cần chỉnh sửa
     * @return \Illuminate\View\View Form chỉnh sửa thể loại
     */
    public function edit(Category $category)
    {
        // Kiểm tra xem người dùng có phải admin không
        if (!auth()->user()->isAdmin() && !auth()->user()->isStaff()) {
            // Nếu không phải admin → Từ chối truy cập
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        // Hiển thị form chỉnh sửa với dữ liệu thể loại hiện tại
=======
=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Thể loại đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
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
        return view('categories.edit', compact('category'));
    }

    /**
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
     * Cập Nhật Thông Tin Thể Loại Trong Database
     * 
     * Chỉ Admin mới có thể cập nhật thể loại
     * Validate dữ liệu mới trước khi lưu
     * 
     * @param \Illuminate\Http\Request $request Dữ liệu từ form
     * @param \App\Models\Category $category Đối tượng thể loại cần cập nhật
     * @return \Illuminate\Http\RedirectResponse Chuyển hướng về danh sách thể loại
     */
    public function update(Request $request, Category $category)
    {
        // Kiểm tra xem người dùng có phải admin không
        if (!auth()->user()->isAdmin() && !auth()->user()->isStaff()) {
            // Nếu không phải admin → Từ chối truy cập
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        // Validate dữ liệu nhập vào (tương tự như store)
        $request->validate([
            'name' => 'required|string|max:255',           // Tên thể loại (bắt buộc)
            'description' => 'nullable|string',             // Mô tả thể loại (tùy chọn)
        ]);

        // Cập nhật thông tin thể loại trong database
        $category->update($request->all());

        // Chuyển hướng về danh sách thể loại với thông báo thành công
        return redirect()
            ->route('categories.index')
            ->with('success', 'Thể loại đã được cập nhật thành công.');
    }

    /**
     * Xóa Thể Loại Khỏi Database
     * 
     * Chỉ Admin mới có thể xóa thể loại
     * Xóa sẽ xóa vĩnh viễn thể loại và tất cả dữ liệu liên quan
     * 
     * @param \App\Models\Category $category Đối tượng thể loại cần xóa
     * @return \Illuminate\Http\RedirectResponse Chuyển hướng về danh sách thể loại
     */
    public function destroy(Category $category)
    {
        // Kiểm tra xem người dùng có phải admin không
        if (!auth()->user()->isAdmin() && !auth()->user()->isStaff()) {
            // Nếu không phải admin → Từ chối truy cập
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        // Xóa thể loại khỏi database
        $category->delete();
        
        // Chuyển hướng về danh sách thể loại với thông báo thành công
        return redirect()
            ->route('categories.index')
            ->with('success', 'Thể loại đã được xóa thành công.');
    }
}


=======
=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Thể loại đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Thể loại đã được xóa thành công.');
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

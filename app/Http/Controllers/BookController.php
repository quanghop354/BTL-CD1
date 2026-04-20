<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Book::with('categories', 'borrows')->withCount('borrows');

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->has('category_id') && $request->category_id) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Filter by price range
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sort
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $books = $query->paginate(10);
        $categories = Category::all();

        return view('books.index', compact('books', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('books', 'public');
        }

        $book = Book::create($data);

        if ($request->has('category_ids')) {
            $categoryIds = array_slice($request->category_ids, 0, 2); // Tối đa 2
            $book->categories()->attach($categoryIds);
        }

        return redirect()->route('books.index')->with('success', 'Sách đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book->load(['categories', 'borrows.reader']);
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('books', 'public');
        }

        $book->update($data);

        if ($request->has('category_ids')) {
            $categoryIds = array_slice($request->category_ids, 0, 2); // Tối đa 2
            $book->categories()->sync($categoryIds);
        }

        return redirect()->route('books.index')->with('success', 'Sách đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        $book->delete();
        return redirect()->route('books.index')->with('success', 'Sách đã được xóa thành công.');
    }

    public function restore($id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        $book = Book::withTrashed()->findOrFail($id);
        $book->restore();
        return redirect()->route('books.index')->with('success', 'Sách đã được khôi phục thành công.');
    }

    public function trashed(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        $query = Book::onlyTrashed()->with('categories');

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        $trashedBooks = $query->paginate(10);

        return view('books.trashed', compact('trashedBooks'));
    }

    public function forceDelete($id)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        $book = Book::withTrashed()->findOrFail($id);
        $book->forceDelete();
        return redirect()->route('books.trashed')->with('success', 'Sách đã được xóa vĩnh viễn.');
    }
}

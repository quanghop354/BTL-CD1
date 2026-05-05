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
<<<<<<< HEAD
        $query = Book::with('categories', 'borrows')->withCount('borrows');
=======
<<<<<<< HEAD
        $query = Book::with('categories', 'borrows')->withCount('borrows');
=======
<<<<<<< HEAD
<<<<<<< HEAD
        $query = Book::with('categories', 'borrows', 'publisher')->withCount('borrows');
=======
        $query = Book::with('categories', 'borrows')->withCount('borrows');
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
        $query = Book::with('categories', 'borrows')->withCount('borrows');
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)

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

<<<<<<< HEAD
        $books = $query->paginate(10);
=======
<<<<<<< HEAD
        $books = $query->paginate(10);
=======
<<<<<<< HEAD
<<<<<<< HEAD
        $books = $query->paginate(8);
=======
        $books = $query->paginate(10);
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
        $books = $query->paginate(10);
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
        $categories = Category::all();

        return view('books.index', compact('books', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
<<<<<<< HEAD
        $categories = Category::all();
        return view('books.create', compact('categories'));
=======
<<<<<<< HEAD
        $categories = Category::all();
        return view('books.create', compact('categories'));
=======
<<<<<<< HEAD
<<<<<<< HEAD
        if (!auth()->user()->isAdmin() && !auth()->user()->isStaff()) {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        $categories = Category::all();
        $publishers = \App\Models\Publisher::all();
        return view('books.create', compact('categories', 'publishers'));
=======
        $categories = Category::all();
        return view('books.create', compact('categories'));
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
        $categories = Category::all();
        return view('books.create', compact('categories'));
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
        if (!auth()->user()->isAdmin() && !auth()->user()->isStaff()) {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
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
<<<<<<< HEAD
    public function show(string $id)
    {
        //
=======
<<<<<<< HEAD
    public function show(string $id)
    {
        //
=======
<<<<<<< HEAD
<<<<<<< HEAD
    public function show(Book $book)
    {
        $book->load(['categories', 'borrows.reader', 'publisher', 'reviews.user']);
        return view('books.show', compact('book'));
=======
    public function show(string $id)
    {
        //
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
    public function show(string $id)
    {
        //
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
<<<<<<< HEAD
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
=======
<<<<<<< HEAD
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
=======
<<<<<<< HEAD
<<<<<<< HEAD
        if (!auth()->user()->isAdmin() && !auth()->user()->isStaff()) {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

        $categories = Category::all();
        $publishers = \App\Models\Publisher::all();
        return view('books.edit', compact('book', 'categories', 'publishers'));
=======
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book)
    {
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
        if (!auth()->user()->isAdmin() && !auth()->user()->isStaff()) {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
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
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
        if (!auth()->user()->isAdmin() && !auth()->user()->isStaff()) {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Sách đã được xóa thành công.');
    }

    public function restore($id)
    {
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
        if (!auth()->user()->isAdmin() && !auth()->user()->isStaff()) {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
        $book = Book::withTrashed()->findOrFail($id);
        $book->restore();
        return redirect()->route('books.index')->with('success', 'Sách đã được khôi phục thành công.');
    }

    public function trashed(Request $request)
    {
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
        if (!auth()->user()->isAdmin() && !auth()->user()->isStaff()) {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
        $query = Book::onlyTrashed()->with('categories');

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

<<<<<<< HEAD
        $trashedBooks = $query->paginate(10);
=======
<<<<<<< HEAD
        $trashedBooks = $query->paginate(10);
=======
<<<<<<< HEAD
<<<<<<< HEAD
        $trashedBooks = $query->paginate(8);
=======
        $trashedBooks = $query->paginate(10);
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
        $trashedBooks = $query->paginate(10);
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)

        return view('books.trashed', compact('trashedBooks'));
    }

    public function forceDelete($id)
    {
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD
        if (!auth()->user()->isAdmin() && !auth()->user()->isStaff()) {
            abort(403, 'Bạn không có quyền truy cập trang này.');
        }

=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)
        $book = Book::withTrashed()->findOrFail($id);
        $book->forceDelete();
        return redirect()->route('books.trashed')->with('success', 'Sách đã được xóa vĩnh viễn.');
    }
}
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)

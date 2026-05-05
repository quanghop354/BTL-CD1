<?php

namespace App\Http\Controllers;

use App\Models\Reader;
use Illuminate\Http\Request;

class ReaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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
        $query = Reader::withCount('borrows');

        // Search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Sort
        $sortBy = $request->get('sort_by', 'created_at');
<<<<<<< HEAD
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);
=======
<<<<<<< HEAD
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);
=======
<<<<<<< HEAD
<<<<<<< HEAD
        $query->orderBy($sortBy, 'desc');
=======
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
=======
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);
>>>>>>> 7e128d690ff2135430cb675ec02b29e75681fedd
>>>>>>> d8c32b4 (hoanthanh)
>>>>>>> 02bf373 (hoanthanh)

        $readers = $query->paginate(10);

        return view('readers.index', compact('readers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
        return view('readers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:readers,email',
        ]);

        Reader::create($request->only(['name', 'email']));

        return redirect()->route('readers.index')->with('success', 'Độc giả đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reader $reader)
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
        $reader->load(['borrows.book']);
        return view('readers.show', compact('reader'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reader $reader)
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
        return view('readers.edit', compact('reader'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reader $reader)
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:readers,email,' . $reader->id,
        ]);

        $reader->update($request->only(['name', 'email']));

        return redirect()->route('readers.index')->with('success', 'Độc giả đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reader $reader)
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
        $reader->delete();
        return redirect()->route('readers.index')->with('success', 'Độc giả đã được xóa thành công.');
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

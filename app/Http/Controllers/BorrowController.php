<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Reader;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Borrow::with('book', 'reader');

        if ($request->has('book_id') && $request->book_id) {
            $query->where('book_id', $request->book_id);
        }

        if ($request->has('reader_id') && $request->reader_id) {
            $query->where('reader_id', $request->reader_id);
        }

        $borrows = $query->paginate(10);
        $books = Book::all();
        $readers = Reader::all();

        return view('borrows.index', compact('borrows', 'books', 'readers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Book::available()->get();
        return view('borrows.create', compact('books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'borrow_date' => 'required|date',
            'return_date' => 'nullable|date|after:borrow_date',
        ]);

        $reader = Reader::firstOrCreate(
            ['email' => $request->email],
            ['name' => $request->name]
        );

        Borrow::create([
            'book_id' => $request->book_id,
            'reader_id' => $reader->id,
            'borrow_date' => $request->borrow_date,
            'return_date' => $request->return_date,
            'status' => 'borrowed',
        ]);

        return redirect()->route('borrows.index')->with('success', 'Mượn sách thành công.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function returnBook(Borrow $borrow)
    {
        $borrow->update([
            'status' => 'returned',
            'return_date' => now()->toDateString(),
        ]);

        return redirect()->route('borrows.index')->with('success', 'Trả sách thành công.');
    }
}

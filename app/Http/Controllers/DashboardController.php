<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Category;
use App\Models\Reader;
use Illuminate\Http\Request;

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

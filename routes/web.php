<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReaderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (Auth::check()) {
        return view('welcome');
    }
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| AUTH (guest)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);

    Route::get('login/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('login/google/callback', [AuthController::class, 'handleGoogleCallback']);

    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| AUTH (user)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

    // BOOKS (user)
    Route::get('books', [BookController::class, 'index'])->name('books.index');
    Route::get('books/{book}', [BookController::class, 'show'])->name('books.show');

    // BORROWS (user)
    Route::get('borrows/create', [BorrowController::class, 'create'])->name('borrows.create');
    Route::post('borrows', [BorrowController::class, 'store'])->name('borrows.store');
    Route::get('borrows', [BorrowController::class, 'index'])->name('borrows.index');
    Route::get('borrows/{borrow}', [BorrowController::class, 'show'])->name('borrows.show');

    // PAYMENTS
    Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('books/{book}/payment', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('books/{book}/payment', [PaymentController::class, 'store'])->name('payments.store');

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */
    Route::middleware('admin')->group(function () {

        Route::resource('books', BookController::class)->except(['index', 'show']);
        Route::post('books/{id}/restore', [BookController::class, 'restore'])->name('books.restore');
        Route::get('books-trashed', [BookController::class, 'trashed'])->name('books.trashed');
        Route::delete('books/{id}/force-delete', [BookController::class, 'forceDelete'])->name('books.force-delete');

        Route::resource('categories', CategoryController::class);

        Route::post('borrows/{borrow}/return', [BorrowController::class, 'returnBook'])->name('borrows.return');
        Route::resource('borrows', BorrowController::class)->except(['index', 'create', 'store', 'show']);

        Route::patch('payments/{payment}/status', [PaymentController::class, 'updateStatus'])->name('payments.update-status');

        Route::resource('readers', ReaderController::class);
    });
});
<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReaderController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('books', BookController::class);
Route::post('books/{id}/restore', [BookController::class, 'restore'])->name('books.restore');
Route::get('books-trashed', [BookController::class, 'trashed'])->name('books.trashed');
Route::delete('books/{id}/force-delete', [BookController::class, 'forceDelete'])->name('books.force-delete');

Route::resource('categories', CategoryController::class);

Route::resource('borrows', BorrowController::class);

Route::resource('readers', ReaderController::class);

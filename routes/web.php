<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\WelcomeController;
use App\Models\Book;
use App\Http\Controllers\AdminMainPageController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

Route::get('/book/booklist', function () {
    return view('book.booklist');
});

Route::get('/book/booklist', [BookController::class, 'ListBook'])->name('book.booklist');

// Route for the book introduction page
Route::get('/book/{book_id}', [BookController::class, 'showBook'])->name('book.introduction_book');


Route::get('/admin', function () {
    return view('admin.bookManaging');
});

<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AdminBookManagingController;
use App\Http\Controllers\AdminContactFormController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\AdminManageAdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CategoryController;


// Public Routes
Route::get('/', [WelcomeController::class, 'welcome'])
    ->name('welcome')
    ->middleware('prevent.admin');


// Book Routes

Route::get('/book/booklist', [BookController::class, 'ListBook'])->name('book.booklist')->middleware('prevent.admin');
Route::get('/book/{id}', [BookController::class, 'showBook'])->name('book.introduction_book')->middleware('prevent.admin');
Route::get('/bookCategories', [CategoryController::class, 'ListCategories'])->name('book.bookCategories')->middleware('prevent.admin');
Route::get('/category/{category}', [CategoryController::class, 'ListBooksByCategory'])->name('book.list_by_category')->middleware('prevent.admin');
Route::get('/book/{book_id}', [BookController::class, 'showBook'])->name('book.introduction_book')->middleware('prevent.admin');


// Authentication Routes
Route::get('/auth/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/auth/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Signup Routes
Route::get('/auth/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/auth/register', [RegisterController::class, 'register']);

// Admin Protected Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/bookManaging', [AdminBookManagingController::class, 'listAllBook'])
        ->name('admin.bookManaging');
    
    Route::get('/updateBook/{id}', [AdminBookManagingController::class, 'showUpdate'])
        ->name('admin.showUpdate');
    Route::post('/updateBook', [AdminBookManagingController::class, 'updateBook'])->name('admin.updateBook');
    
    Route::post('/addBook', [AdminBookManagingController::class, 'addBook'])->name('admin.addBook');
    Route::get('/addBook', function () {
        return view('admin.addBook');
    })->name('admin.addBook');

    Route::get('/deleteBook/{id}', [AdminBookManagingController::class, 'deleteBook'])
        ->name('admin.deleteBook');
    
    Route::get('/contactForm', [AdminContactFormController::class, 'showContactForm'])
        ->name('admin.contactForm');
    Route::post('/contactForm/update/{id}', [AdminContactFormController::class, 'updateContactForm'])->name('admin.contactForm.update');

    Route::post('/admin/manageAdmin', [ProfileController::class, 'update'])->name('auth.profile.update');
    
});

// Authenticated User Routes
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/cart', [CartController::class, 'cart'])
        ->name('cart');
    Route::post('/cart/add', [CartController::class, 'addToCart'])
        ->name('cart.add');
    Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])
        ->name('cart.remove');
    Route::get('/cart/checkout', [CartController::class, 'checkout'])
        ->name('cart.checkout');
    Route::post('/cart/payment', [CartController::class, 'processPayment'])
        ->name('cart.processPayment');
    Route::view('/payment/success', 'user.payment-success')
        ->name('user.payment-success');

    Route::get('/contactUs', [ContactUsController::class, 'create'])->name('contact.create');
    Route::post('/contactUs', [ContactUsController::class, 'store'])->name('contact.store');

    Route::get('/contactUsResponses', [ContactUsController::class, 'index'])->name('user.contactUsResponses');
    Route::delete('/contact-us/{id}', [ContactUsController::class, 'delete'])->name('messages.delete');
    Route::get('/purchased_books', [BookController::class, 'purchasedBooks'])->name('book.purchased_books');
    Route::get('/profile', [ProfileController::class, 'show'])->name('auth.profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('auth.profile.update');
});

Route::get('/admin/manageAdmin', [AdminManageAdminController::class, 'showAdmin']);
Auth::routes();

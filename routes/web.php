<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AdminBookManagingController;
use App\Http\Controllers\AdminContactFormController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\AdminManageUsersController;

// Public Routes
Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

// Book Routes
Route::get('/book/booklist', [BookController::class, 'ListBook'])->name('book.booklist');
Route::get('/book/{id}', [BookController::class, 'showBook'])->name('book.introduction_book');

// Authentication Routes
Route::get('/auth/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/auth/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Protected Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/bookManaging', [AdminBookManagingController::class, 'listAllBook'])
        ->name('admin.bookManaging');
    
    Route::get('/updateBook/{id}', [AdminBookManagingController::class, 'showUpdate'])
        ->name('admin.showUpdate');
    Route::post('/updateBook/{id}', [AdminBookManagingController::class, 'updateBook']);
    
    Route::get('/addBook', [AdminBookManagingController::class, 'showAddForm'])
        ->name('admin.addBook');
    Route::post('/addBook', [AdminBookManagingController::class, 'addBook']);
    
    Route::get('/deleteBook/{id}', [AdminBookManagingController::class, 'deleteBook'])
        ->name('admin.deleteBook');
    
    Route::get('/contactForm', [AdminContactFormController::class, 'showContactForm'])
        ->name('admin.contactForm');
});

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/welcome', [WelcomeController::class, 'welcome'])
        ->name('welcome');
});

// Signup Routes
Route::get('/auth/signup', [SignupController::class, 'showSignupForm'])->name('signup');
Route::post('/auth/signup', [SignupController::class, 'signup']);

// Profile Routes
Route::middleware('auth')->prefix('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('auth.profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('auth.profile.update');
});
Route::get('/admin/contactForm', [AdminContactFormController::class, 'showContactForm'])->name('contactForm');

Route::get('/admin/manageUsers', [AdminManageUsersController::class, 'showUsers']);

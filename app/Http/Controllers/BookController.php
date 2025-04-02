<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\PurchasedBook;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function ListBook()
    {
        // Fetch all books efficiently
        $books = Book::all();

        return view('book.booklist', compact('books'));
    }

    public function showBook($id)
    {
        $book = Book::findOrFail($id); // Fetch book by ID
        return view('book.introduction_book', compact('book'));
    }

        public function purchasedBooks()
    {

        // Ensure user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'You need to log in to view purchased books.']);
        }

        $user = Auth::user();

        // Fetch purchased books with eager loading
        $purchasedBooks = PurchasedBook::where('user_id', $user->id)
            ->with('book') // Ensure related book data is fetched
            ->get();

        // Check if the user has purchased any books
        if ($purchasedBooks->isEmpty()) {
            return view('book.purchased_books', [
                'purchasedBooks' => [],
                'message' => 'No purchased books found in your inventory.'
            ]);
        }

        return view('book.purchased_books', compact('purchasedBooks'));
    }


}

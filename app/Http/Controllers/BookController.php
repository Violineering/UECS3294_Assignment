<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book; // Assuming you have a Book model

class BookController extends Controller
{
    public function ListBook()
    {
        // Fetch all books from the database
        $books = Book::all(); // Assuming you have a Book model for the `tbl_books` table

        // Pass the books data to the view
        return view('book.booklist', compact('books'));
    }

    // Method to display the book introduction page
    public function showBook($book_id)
    {
        $book = Book::findOrFail($book_id); // Fetch the book by ID
        return view('book.introduction_book', compact('book'));
    }
}
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

    public function welcome()
    {
        $books = Book::take(9)->get(); 

        // Pass books to the welcome page
        return view('welcome', compact('books'));
    }
}
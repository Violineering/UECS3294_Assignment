<?php

namespace App\Http\Controllers;

use App\Models\Book;

class CategoryController extends Controller
{
    public function ListCategories()
    {
        $categories = Book::select('genre')->distinct()->get();

        return view('book.bookCategories', compact('categories'));
    }

    public function ListBooksByCategory($category)
    {
        $books = Book::where('genre', $category)->get(); // Filter books by genre/category

        return view('book.bookList', compact('books')); // Pass the filtered books to the view
    }

}

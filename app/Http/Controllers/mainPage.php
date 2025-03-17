<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class mainPage extends Controller
{
    public function welcome()
    {
        $books = Book::take(9)->get(); 

        // Pass books to the welcome page
        return view('welcome', compact('books'));
    }
}

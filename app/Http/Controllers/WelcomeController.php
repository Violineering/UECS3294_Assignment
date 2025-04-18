<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class WelcomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
{
    // Fetch all books and fantasy books
    $books = Book::all(); // General books
    $fantacyBooks = Book::where('genre', 'fantasy')->get(); // Fantasy books

    // Pass both collections to the view
    return view('welcome', compact('books', 'fantacyBooks'));
}



}

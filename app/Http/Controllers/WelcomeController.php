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
        $books = Book::all(); 
        $fantacyBooks = Book::where('genre', 'fantasy')->get(); 

        return view('welcome', compact('books', 'fantacyBooks'));
    }

}

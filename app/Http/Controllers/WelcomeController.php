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
        $books = Book::take(9)->get(); 

        // Pass books to the welcome page
        return view('welcome', compact('books'));
    }

}

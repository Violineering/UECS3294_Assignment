<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Book;

class AdminBookManagingController extends Controller
{

    public function listAllBook()
    {
        $books = Book::paginate(8);
        return view('admin.bookManaging', ['books' => $books]);
    }

    // function updateBook(Request $req){
    //     $books = User::find($req->id);
    //     print $books;
    //     $books->name = $req->name;
    //     $books->email = $req->email;
    //     print $books;
    //     $books->save();

    //     return redirect("users");
    // }
}

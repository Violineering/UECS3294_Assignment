<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;


class AdminBookManagingController extends Controller
{

    public function listAllBook()
    {
        $books = Book::paginate(8);
        return view('admin.bookManaging', ['books' => $books]);
    }

    public function updateBook(Request $req){
        $book = Book::find($req->book_id);
        
        if (!$book) {
            return redirect()->back()->with('error', 'Book not found.');
        }
    
        // Update text fields
        $book->title = $req->title;
        $book->author = $req->author;
        $book->publisher = $req->publisher;
        $book->publication_year = $req->publication_year;
        $book->genre = $req->genre;
        $book->language = $req->language;
        $book->pages = $req->pages;
        $book->description = $req->description;
    
        // Handle Book Cover Image Upload
        if ($req->hasFile('cover_image')) {
            // Delete old image if exists
            if ($book->cover_image) {
                Storage::delete('public/' . $book->cover_image);
            }
            
            $coverImagePath = $req->file('cover_image')->store('images/book_cover', 'public');
            $book->cover_image = $coverImagePath;  // Now saved as 'images/book_cover/filename.jpg'
        }
    
        // Handle PDF File Upload
        if ($req->hasFile('pdf_file')) {
            // Delete old PDF if exists
            if ($book->pdf_file) {
                Storage::delete('public/' . $book->pdf_file);
            }
    
            $pdfFilePath = $req->file('pdf_file')->store('pdfs', 'public');
            $book->pdf_file = $pdfFilePath;  // Now saved as 'pdfs/filename.pdf'
        }
    
        $book->save();
    
        return redirect()->route('admin.bookManaging')->with('success', 'Book updated successfully.');
    }

    function showUpdate($book_id){
        $book = Book::find($book_id);
        return view("admin.updateBook", ['book' => $book]);
    }

}

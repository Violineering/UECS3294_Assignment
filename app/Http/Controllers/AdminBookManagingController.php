<?php

namespace App\Http\Controllers;

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

        $book = Book::find($req->id);
        
        if (!$book) {
            return redirect()->back()->with('error', 'Book not found.');
        }

        $validatedData = $req->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|regex:/^[A-Za-z\s\.]+$/|max:255',
            'isbn' => 'required|string|max:20|unique:tbl_books,isbn,' . $book->id,
            'publisher' => 'required|string|max:255',
            'publication_year' => 'required|integer|digits:4|between:1000,2099',
            'genre' => 'required|string|max:100',
            'language' => 'required|alpha|max:50',
            'pages' => 'required|integer|min:1',
            'description' => 'nullable|string|max:1000',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pdf_file' => 'nullable|mimes:pdf',
            'price' => 'required|numeric|min:0.01|regex:/^\d+(\.\d{1,2})?$/', 
        ]);
        
    
        // Update text fields
        $book->title = $req->title;
        $book->author = $req->author;
        $book->publisher = $req->publisher;
        $book->publication_year = $req->publication_year;
        $book->genre = $req->genre;
        $book->language = $req->language;
        $book->pages = $req->pages;
        $book->description = $req->description;
        $book->availability = $req->availability;
        $book->price = $req->price;
    
        // Handle Book Cover Image Upload
        if ($req->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::delete('public/' . $book->cover_image);
            }
            
            $coverImagePath = $req->file('cover_image')->store('images/book_cover', 'public');
            $book->cover_image = $coverImagePath; 
        }
    
        // Handle PDF File Upload
        if ($req->hasFile('pdf_file')) {
            if ($book->pdf_file) {
                Storage::delete('public/' . $book->pdf_file);
            }
    
            $pdfFilePath = $req->file('pdf_file')->store('pdfs', 'public');
            $book->pdf_file = $pdfFilePath; 
        }


        $book->save();
    
        return redirect()->route('admin.bookManaging')->with('success', 'Book updated successfully.');
    }

    function showUpdate($id){
        $book = Book::find($id);
        return view("admin.updateBook", ['book' => $book]);
    }


    public function addBook(Request $req)
    {
        // Validation rules
        $validatedData = $req->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|regex:/^[A-Za-z\s\.]+$/|max:255',
            'isbn' => 'required|string|max:20|unique:tbl_books,isbn',
            'publisher' => 'required|string|max:255',
            'publication_year' => 'required|integer|digits:4|between:1000,2099',
            'genre' => 'required|string|max:100',
            'language' => 'required|alpha|max:50',
            'pages' => 'required|integer|min:1',
            'description' => 'nullable|string|max:1000',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pdf_file' => 'required|mimes:pdf',
            'price' => 'required|numeric|min:0.01|regex:/^\d+(\.\d{1,2})?$/',  
        ]);

        $book = new Book;
        $book->title = $req->title;
        $book->author = $req->author;
        $book->isbn = $req->isbn;
        $book->publisher = $req->publisher;
        $book->publication_year = $req->publication_year;
        $book->genre = $req->genre;
        $book->language = $req->language;
        $book->pages = $req->pages;
        $book->description = $req->description;
        $book->availability = $req->availability;
        $book->price = $req->price;

        if ($req->hasFile('cover_image')) {
            $coverImagePath = $req->file('cover_image')->store('images/book_cover', 'public');
            $book->cover_image = $coverImagePath;
        }

        if ($req->hasFile('pdf_file')) {
            $pdfFilePath = $req->file('pdf_file')->store('pdfs', 'public');
            $book->pdf_file = $pdfFilePath;
        }

        $book->save();

        return redirect()->route('admin.bookManaging')->with('success', 'Book added successfully!');
    }

    public function deleteBook($id)
{
    $book = Book::find($id);

    if (!$book) {
        return redirect()->route('admin.bookManaging')->with('error', 'Book not found.');
    }

    // Delete book cover image from storage
    if ($book->cover_image) {
        Storage::delete('public/' . $book->cover_image);
    }

    // Delete PDF file from storage
    if ($book->pdf_file) {
        Storage::delete('public/' . $book->pdf_file);
    }

    // Delete the book record from the database
    $book->delete();

    return redirect()->route('admin.bookManaging')->with('success', 'Book deleted successfully.');
}


}

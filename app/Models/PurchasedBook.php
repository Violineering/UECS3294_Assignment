<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedBook extends Model
{
    use HasFactory;

    protected $table = 'purchased_books'; // Specify the table name
    protected $primaryKey = 'id'; // Define primary key

    protected $fillable = [
        'user_id',
        'book_id',
        'title',
        'cover_image',
        'pdf_file',
        'purchased_datetime',
    ];

    /**
     * Define the relationship with the User model.
     * A purchased book belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Define the relationship with the Book model (tbl_books).
     * A purchased book references a book, but the book can be deleted (set to null).
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'tbl_books'; // Specify the table name
    protected $primaryKey = 'id'; // Specify the primary key column
    
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'publisher',
        'publication_year',
        'genre',
        'language',
        'pages',
        'description',
        'cover_image',
        'availability',
        'stock',
        'pdf_file',
    ];

    // Each book can be added to many shopping carts.
    public function shoppingCarts()
    {
        return $this->hasMany(ShoppingCart::class);
    }
}
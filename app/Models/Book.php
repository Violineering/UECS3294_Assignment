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
        'pdf_file',
        'price',
    ];
}
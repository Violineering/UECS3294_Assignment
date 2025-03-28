<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchasedBooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchased_books')->insert([
            [
                'user_id' => 1, 
                'book_id' => 3, 
                'title' => '1984',
                'cover_image' => 'images/book_cover/1984.jpg',
                'pdf_file' => 'pdfs/1984.pdf',
                'purchased_datetime' => now(),
            ],
            [
                'user_id' => 1, 
                'book_id' => 6, 
                'title' => 'The Hobbit',
                'cover_image' => 'images/book_cover/the_hobbit.jpg',
                'pdf_file' => 'pdfs/hobbit.pdf',
                'purchased_datetime' => now(),
            ],
            [
                'user_id' => 2, 
                'book_id' => 8, 
                'title' => 'The Lord of the Rings',
                'cover_image' => 'images/book_cover/the_lord_of_the_rings.jpg',
                'pdf_file' => 'pdfs/lotr.pdf',
                'purchased_datetime' => now(),
            ],
        ]);
    }
}

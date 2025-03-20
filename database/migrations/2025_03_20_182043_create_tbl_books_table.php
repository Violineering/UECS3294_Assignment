<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblBooksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_books', function (Blueprint $table) {
            $table->id('book_id'); // Auto-incrementing primary key
            $table->string('title', 255)->nullable(false); // Title of the book
            $table->string('author', 255)->nullable(false); // Author of the book
            $table->string('isbn', 13)->unique()->nullable(false); // ISBN (unique)
            $table->string('publisher', 255)->nullable(); // Publisher
            $table->integer('publication_year')->nullable(); // Publication year
            $table->string('genre', 100)->nullable(); // Genre
            $table->string('language', 50)->nullable(); // Language
            $table->integer('pages')->nullable(); // Number of pages
            $table->text('description')->nullable(); // Description
            $table->string('cover_image', 255)->nullable(); // Cover image path/URL
            $table->enum('availability', ['available', 'out of stock'])->default('available'); // Availability status
            $table->timestamp('created_at')->useCurrent(); // Timestamp when the book was added
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); // Timestamp when the book was last updated
            $table->integer('stock')->nullable(); // Stock of the book
            $table->string('pdf_file', 255)->nullable(); // URL to the ebook PDF file
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_books');
    }
}
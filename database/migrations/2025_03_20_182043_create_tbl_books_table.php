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
            $table->id('id'); 
            $table->string('title', 255)->nullable(false); 
            $table->string('author', 255)->nullable(false); 
            $table->string('isbn', 13)->unique()->nullable(false); 
            $table->string('publisher', 255)->nullable(); 
            $table->integer('publication_year')->nullable(); 
            $table->string('genre', 100)->nullable(); 
            $table->string('language', 50)->nullable(); 
            $table->integer('pages')->nullable(); 
            $table->text('description')->nullable(); 
            $table->string('cover_image', 255)->nullable(); 
            $table->enum('availability', ['Available', 'Not Available'])->default('Available');
            $table->timestamp('created_at')->useCurrent(); 
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate(); 
            $table->string('pdf_file', 255)->nullable(); 
            $table->decimal('price', 8, 2); 
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
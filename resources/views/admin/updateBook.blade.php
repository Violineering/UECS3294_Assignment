<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
</head>
<body>

<h1>Update Book</h1>

<form action="updateBook" method="POST" enctype="multipart/form-data">

    @csrf
    <input type = "hidden" name = "book_id" value="{{ $book['book_id'] }}" ><br><br>
    <label>Title: </label>
    <input type = "text" name = "title" value="{{ $book['title'] }}" ><br><br>
    <label>Author: </label>
    <input type = "text" name = "author" value="{{ $book['author'] }}" ><br><br>
    <label>Publisher: </label>
    <input type = "text" name = "publisher" value="{{ $book['publisher'] }}" ><br><br>
    <label>Publication Year: </label>
    <input type = "text" name = "publication_year" value="{{ $book['publication_year'] }}" ><br><br>
    <label>Genre: </label>
    <input type = "text" name = "genre" value="{{ $book['genre'] }}" ><br><br>
    <label>Language: </label>
    <input type = "text" name = "language" value="{{ $book['language'] }}" ><br><br>
    <label>Pages: </label>
    <input type = "text" name = "pages" value="{{ $book['pages'] }}" ><br><br>
    <label>Description: </label>
    <input type = "text" name = "description" value="{{ $book['description'] }}" ><br><br>
    <label>Availability: </label>
    <input type = "text" name = "availability" value="{{ $book['availability'] }}" ><br><br>

    <!-- Book Cover Upload -->
    <label>Book Cover: </label>
    <input type="file" name="cover_image"><br><br>
    @if ($book->cover_image)
        <img src="{{ asset('storage/' . $book->cover_image) }}" width="100" height="150" alt="Book Cover">
    @endif
    <br><br>

    <!-- PDF File Upload -->
    <label>Content (PDF): </label>
    <input type="file" name="pdf_file"><br><br>
    @if ($book->pdf_file)
        <a href="{{ asset('storage/' . $book->pdf_file) }}" download>Download Current PDF</a>
    @endif
    <br><br>

    <button type = "submit">Update Book</button>
</form>

</body>
</html>

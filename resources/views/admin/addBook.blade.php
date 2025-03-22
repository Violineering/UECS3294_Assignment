<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
</head>
<body>

<h1>add book page!!!</h1>

<form action = "addBook" method = "POST">
@csrf
    <input type = "hidden" name = "book_id" placeholder = "Enter"><br><br>
    <label>Title: </label>
    <input type = "text" name = "title" placeholder = "Enter"><br><br>
    <label>Author: </label>
    <input type = "text" name = "author" placeholder = "Enter"><br><br>
    <label>Publisher: </label>
    <input type = "text" name = "publisher" placeholder = "Enter"><br><br>
    <label>Publication Year: </label>
    <input type = "text" name = "publication_year" placeholder = "Enter"><br><br>
    <label>Genre: </label>
    <input type = "text" name = "genre" placeholder = "Enter"><br><br>
    <label>Language: </label>
    <input type = "text" name = "language" placeholder = "Enter"><br><br>
    <label>Pages: </label>
    <input type = "text" name = "pages" placeholder = "Enter"><br><br>
    <label>Description: </label>
    <input type = "text" name = "description" placeholder = "Enter"><br><br>
    <label>Book Cover: </label>
    <input type="file" name="cover_image"><br><br>
    @if ($book->cover_image)
        <img src="{{ asset('storage/' . $book->cover_image) }}" width="100" height="150" alt="Book Cover">
    @endif
    <br><br>
    <label>Content (PDF): </label>
    <input type="file" name="pdf_file"><br><br>
    @if ($book->pdf_file)
        <a href="{{ asset('storage/' . $book->pdf_file) }}" download>Download Current PDF</a>
    @endif
    <br><br>

    <button type = "submit">add book</button>
</form>

</body>
</html>


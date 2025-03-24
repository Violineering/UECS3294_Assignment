<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
</head>
<body>

<h1>add book page!!!</h1>

<form action="{{ route('admin.addBook') }}" method="POST" enctype="multipart/form-data">
@csrf
    <label>Title: </label>
    <input type = "text" name = "title" placeholder = "Enter"><br><br>
    <label>Author: </label>
    <input type = "text" name = "author" placeholder = "Enter"><br><br>
    <label>ISBN: </label>
    <input type = "text" name = "isbn" placeholder = "Enter"><br><br>
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
    @if (isset($book) && $book->cover_image)
        <img src="{{ asset('storage/' . $book->cover_image) }}" width="100" height="150" alt="Book Cover">
    @endif

    <br><br>

    <label>Content (PDF): </label>
    <input type="file" name="pdf_file"><br><br>
    @if (isset($book) && $book->pdf_file)
        <a href="{{ asset('storage/' . $book->pdf_file) }}" download>Download Current PDF</a>
    @endif
    <br><br>

    <input type = "hidden" name = "availability" value = "available" ><br><br>

    <button type = "submit">add book</button>

    <button type="button" onclick="window.location.href='{{ route('admin.bookManaging') }}'">
        Cancel
    </button>
</form>

</body>
</html>


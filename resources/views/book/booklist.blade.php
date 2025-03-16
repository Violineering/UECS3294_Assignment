<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bliss - Book List</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        /* Ensure the html and body take up the full height of the viewport */
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f0eb;
            color: #1d1d1f;
            flex: 1; /* Allow the body to grow and fill the available space */
        }

        header {
            background-color: #fff;
            padding: 20px;
            display: flex;
            justify-content: center;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 80%;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .nav-links li a {
            text-decoration: none;
            color: #1d1d1f;
            font-weight: 500;
        }

        .search-bar input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .create-account {
            background-color: transparent;
            border: 2px solid #1d1d1f;
            padding: 8px 15px;
            cursor: pointer;
            font-weight: bold;
        }

        .book-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 40px;
            flex: 1; /* Allow the book list to grow and fill the available space */
        }

        .book-card {
            background-color: white;
            width: 300px;
            margin: 20px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .book-card img {
            width: 200px; /* Fixed width */
            height: 300px; /* Fixed height */
            object-fit: cover; /* Ensure the image fills the space without distortion */
            margin-bottom: 15px;
            border-radius: 8px; /* Optional: Add rounded corners */
        }

        .book-card h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .book-card p {
            font-size: 14px;
            color: #333;
            margin-bottom: 15px;
        }

        .read-more-btn {
            background-color: #1d1d1f;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        footer {
            background-color: #1d1d1f;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto; /* Push the footer to the bottom */
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    @include('includes.navigationbar') <!-- Include the navigation bar -->

    <section class="book-list">
        @foreach($books as $book)
            <div class="book-card">
                <img src="{{ asset($book->cover_image) }}" alt="{{ $book->title }}">
                <h2>{{ $book->title }}</h2>
                <p>Author: {{ $book->author }}</p>
                <p>{{ $book->description }}</p>
                <button class="read-more-btn" onclick="window.location.href='{{ route('book.introduction_book', $book->book_id) }}'">Read More →</button>
            </div>
        @endforeach
    </section>

    @include('includes.footer') <!-- Include the footer -->

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
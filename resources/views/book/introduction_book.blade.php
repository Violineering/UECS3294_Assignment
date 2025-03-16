<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bliss - {{ $book->title }}</title>
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

        .book-intro {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px;
            gap: 40px;
        }

        .book-cover {
            flex: 1;
            max-width: 400px;
        }

        .book-cover img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .book-details {
            flex: 2;
            max-width: 600px;
        }

        .book-details h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .book-details p {
            font-size: 16px;
            color: #333;
            margin-bottom: 15px;
        }

        .book-details .availability {
            font-size: 18px;
            font-weight: bold;
            color: {{ $book->availability === 'available' ? 'green' : 'red' }};
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

    <section class="book-intro">
        <div class="book-cover">
            <img src="{{ asset($book->cover_image) }}" alt="{{ $book->title }}">
        </div>
        <div class="book-details">
            <h1>{{ $book->title }}</h1>
            <p><strong>Author:</strong> {{ $book->author }}</p>
            <p><strong>Publisher:</strong> {{ $book->publisher }}</p>
            <p><strong>Publication Year:</strong> {{ $book->publication_year }}</p>
            <p><strong>Genre:</strong> {{ $book->genre }}</p>
            <p><strong>Language:</strong> {{ $book->language }}</p>
            <p><strong>Pages:</strong> {{ $book->pages }}</p>
            <p><strong>Description:</strong> {{ $book->description }}</p>
            <p class="availability">
                <strong>Availability:</strong> {{ ucfirst($book->availability) }}
            </p>
        </div>
    </section>

    @include('includes.footer') <!-- Include the footer -->

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
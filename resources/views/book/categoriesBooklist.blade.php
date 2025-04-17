<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unpopular. - Book List</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        
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
            flex: 1; 
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
            flex: 1; 
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
            width: 200px; 
            height: 300px; 
            object-fit: cover; 
            margin-bottom: 15px;
            border-radius: 8px; 
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
            margin-top: auto;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    @include('includes.navigationbar')

    <!-- Category Filter Section -->
    <section class="category-filter">
        <h2>Filter by Category</h2>
        <ul class="category-list">
            @foreach ($categories as $category)
                <li><a href="{{ route('book.list_by_category', $category->genre) }}" class="category-link">{{ $category->genre }}</a></li>
            @endforeach
        </ul>
    </section>

    <!-- Book List Section -->

    <section class="book-list">
        @foreach($books as $book)
            <div class="book-card">
                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}">
                <h2>{{ $book->title }}</h2>
                <p>Author: {{ $book->author }}</p>
                <p>{{ $book->description }}</p>
                <button class="read-more-btn" onclick="window.location.href='{{ route('book.introduction_book', $book->id) }}'">Read More →</button>
            </div>
        @endforeach
    </section>                                           

    @include('includes.footer')

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
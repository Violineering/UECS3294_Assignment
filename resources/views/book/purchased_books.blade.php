<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unpopular. - Purchased Books</title>
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

        .download-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            display: block;
            margin-top: 10px;
            text-decoration: none;
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

    <section class="book-list">
        <h1 style="text-align: center; width: 100%;">Your Purchased Books</h1>

        @if(collect($purchasedBooks)->isEmpty())
            <p style="text-align: center; width: 100%;">You haven't purchased any books yet.</p>
        @else
        @foreach($purchasedBooks as $purchasedBook)
            <div class="book-card">
                <img src="{{ asset('storage/images/book_cover' . $purchasedBook->book->cover_image) }}" alt="{{ $purchasedBook->book->title }}">
                <h2>{{ $purchasedBook->book->title }}</h2>
                <p>Purchased on: {{ $purchasedBook->purchased_datetime }}</p>

                <button class="read-more-btn" onclick="window.location.href='{{ route('book.introduction_book', $purchasedBook->book->id) }}'">Read More →</button>

                @if($purchasedBook->book->pdf_file)
                    <a href="{{ asset('storage/' . $purchasedBook->book->pdf_file) }}" class="download-btn" target="_blank">Download PDF</a>
                @endif
            </div>
        @endforeach
        @endif
    </section>

    @include('includes.footer') 

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unpopular. - Book List</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/book/booklist.css') }}">
    </style>
</head>
<body>
    @include('includes.navigationbar')
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bliss - Online Bookstore</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f0eb;
            color: #1d1d1f;
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

        .main-canvas {
            display: flex;
            margin: -30px 100px 20px 100px;
        }

        .hero {
            text-align: left;
            padding: 50px;
            width: 80%;
            flex: 0.9;
            margin-right: 100px;
        }

        .hero h1 {
            font-size: 80px;
            font-weight: bold;
            margin-bottom: 10px;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', fantasy;
        }

        .hero p {
            font-size: 16px;
            color: #333;
        }

        .explore-btn {
            background-color: #1d1d1f;
            color: white;
            padding: 12px 24px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
        }

        /* Book Showcase */
        .book-showcase {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-top: 40px;
        }

        .books-container {
            overflow: hidden;
            display: flex;
            justify-content: center;
            height: 350px;
            margin-top: 80px;
            width: 600px;
        }

        .books {
            display: flex;
            justify-content: center;
            transition: opacity 0.5s ease-in-out;
            gap: 10px;
        }

        .books img:nth-child(1) {
            position: relative;
            top: 0px;
            left: -20px;
        }

        .books img:nth-child(2) {
            position: relative;
            top: 80px;
            left: 10px;
        }

        .books img:nth-child(3) {
            position: relative;
            top: 160px;
            left: 30px;
        }

        .books img {
            height: 200px;
            width: 120px;
            margin: 0 20px;
            transition: opacity 0.3s;
            
        }

        .nav-btn {
            cursor: pointer;
            font-size: 24px;
            margin-top: 10px;
            background: none;
            border: none;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 10px;
        }

        .stats {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            margin-top: 10px;
        }

        /* Best Seller */
        .best-seller {
            background-color: white;
            padding: 20px;
            margin: 100px auto 0 auto;
            text-align: center;
            width: 80%;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .best-seller .badge {
            background-color: yellow;
            color: black;
            font-weight: bold;
            padding: 5px;
            position: absolute;
            left: 10px;
            top: 10px;
        }

        .best-seller img {
            width: 200px;
        }

        .best-seller p {
            font-size: 18px;
        }
    </style>
</head>
<body>
    @include('includes.navigationbar')

    <div class="main-canvas">
        <section class="hero">
            <h1>TO SUCCEED YOU MUST READ</h1>
            <p><strong>Not sure what to read next?</strong> Explore our catalog of public domain books with our editors.</p>
            <a href="{{ url('/book/booklist') }}" class="explore-btn">Explore Now →</a>
        </section>

        <section class="book-showcase">
            <div class="books-container">
            <div class="books">
                @foreach($books->take(3) as $book)
                    <img src="{{ asset($book->cover_image) }}" alt="{{ $book->title }}">
                @endforeach
            </div>

            </div>
            <div class="button-container">
                <button class="nav-btn left-btn">◀</button>
                <button class="nav-btn right-btn">▶</button>
            </div>
        </section>
    </div>

    <div class="stats">20k+ Books</div>

    <section class="best-seller">
        <div class="badge">Best Seller</div>
        <img src="psychology-of-money.jpg" alt="The Psychology of Money">
        <p>Our most popular and trending <strong>eBooks</strong> perfect for any reading mood.</p>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const booksContainer = document.querySelector(".books");
            const leftBtn = document.querySelector(".left-btn");
            const rightBtn = document.querySelector(".right-btn");

            const bookSets = [
                @foreach($books->chunk(3) as $chunk) 
                    [
                        @foreach($chunk as $book) "{{ asset($book->cover_image) }}", @endforeach
                    ],
                @endforeach
            ];

            let currentSet = 0;

            function updateBooks() {
                booksContainer.style.opacity = 0; 
                setTimeout(() => {
                    booksContainer.innerHTML = bookSets[currentSet].map(book => 
                        `<img src="${book}" alt="Book">`
                    ).join('');
                    booksContainer.style.opacity = 1;
                }, 300);
            }

            rightBtn.addEventListener("click", () => {
                currentSet = (currentSet + 1) % bookSets.length;
                updateBooks();
            });

            leftBtn.addEventListener("click", () => {
                currentSet = (currentSet - 1 + bookSets.length) % bookSets.length;
                updateBooks();
            });
        });
    </script>

@include('includes.footer')
</body>
</html>

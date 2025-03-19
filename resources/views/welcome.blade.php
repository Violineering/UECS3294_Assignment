<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unpopular. - Online Bookstore</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        html, body {
            height: auto;
            min-height: 100%; 
            margin: 0;
            display: block;
            overflow-y: auto; 
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f0eb;
            color: #1d1d1f;
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
            margin-top: 20px;
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
            margin-top: 60px;
        }

        /* Best Seller */
        .best-seller {
            background-color: white;
            padding: 20px;
            margin: 100px auto 0 auto;
            text-align: center;
            width: 80%;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }
        
        .bestSellerBook {
            display: flex;
            transition: transform 0.5s ease-in-out;
            width: max-content; /* Ensures it expands based on content */s
        }

        .bestSellerBookContainer {
            position: relative;
            width: 80%;
            margin: auto;
            overflow: hidden; /* Hide overflowing books */
        }

        .book-slide {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 40px;
        }

        .book-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            width: 180px;
        }

        .book-item img {
            width: 150px;
            height: 220px;
            object-fit: cover;
            border-radius: 5px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
        }

        .best-seller .title {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-left: 20px;
        }

        .badge {
            font-size: 30px;
            margin-left: 10px;
            font-weight: bold;
        }

        /* Dots for Pagination */
        .dots {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .dot {
            width: 12px;
            height: 12px;
            margin: 5px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .dot.active {
            background-color: #1d1d1f;
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
            <div class="stats">20k+ Books</div>
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

    <section class="best-seller">
        <div class="title">
            <img class="hotIcon" src="{{ asset('icon/hot.png') }}" height="30px">
            <h2 class="badge">Best Seller</h2>
        </div>
        
        <div class="bestSellerBookContainer">
            <div class="bestSellerBook">
                @foreach($books->chunk(5) as $chunk)
                    <div class="book-slide">
                        @foreach($chunk as $book)
                            <div class="book-item">
                                <img src="{{ asset($book->cover_image) }}" alt="{{ $book->title }}">
                                <h2>{{ $book->title }}</h2>
                                <p>Author: {{ $book->author }}</p>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>


        <!-- Dots for Navigation -->
        <div class="dots">
            @for ($i = 0; $i < ceil($books->count() / 5); $i++)
                <span class="dot" onclick="moveToSlide({{ $i }})"></span>
            @endfor
        </div>

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

        document.addEventListener("DOMContentLoaded", function () {
            const bestSellerBook = document.querySelector(".bestSellerBook");
            const dots = document.querySelectorAll(".dot");
            let currentIndex = 0;
            const totalSlides = document.querySelectorAll(".book-slide").length;

            function updateSlider() {
                const offset = -currentIndex * 100;
                bestSellerBook.style.transform = `translateX(${offset}%)`;
                dots.forEach((dot, i) => {
                    dot.classList.toggle("active", i === currentIndex);
                });
            }

            function moveToSlide(index) {
                currentIndex = index;
                updateSlider();
            }

            function autoScroll() {
                currentIndex = (currentIndex + 1) % totalSlides;
                updateSlider();
            }

            let slideInterval = setInterval(autoScroll, 5000);

            dots.forEach((dot, index) => {
                dot.addEventListener("click", () => {
                    moveToSlide(index);
                    clearInterval(slideInterval);
                    slideInterval = setInterval(autoScroll, 5000);
                });
            });

            updateSlider();
        });
    </script>

@include('includes.footer')
</body>
</html>

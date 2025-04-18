<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unpopular. - Online Bookstore</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="{{ asset('css/mainpage.css') }}">

</head>
<body>

<div class = mainpage>
    @include('includes.navigationbar')

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

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
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}">
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
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}">
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

    </section>

    <section class="best-seller">
        <div class="title">
            <h2 class="badge">Fantasy</h2>
        </div>
        <div class="bestSellerBookContainer">
            <div class="bestSellerBook">
                @foreach($fantacyBooks->chunk(5) as $chunk)
                    <div class="book-slide">
                        @foreach($chunk as $book)
                            <div class="book-item">
                                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}">
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
            @for ($i = 0; $i < ceil($fantacyBooks->count() / 5); $i++)
                <span class="dot" onclick="moveToSlide({{ $i }})"></span>
            @endfor
        </div>
        <br>
        <p>Our most popular and trending <strong>eBooks</strong> perfect for any reading mood.</p>
    </section>
    <br><br>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const booksContainer = document.querySelector(".books");
            const leftBtn = document.querySelector(".left-btn");
            const rightBtn = document.querySelector(".right-btn");

            const bookSets = [
                @foreach($books->chunk(3) as $chunk) 
                    [
                        @foreach($chunk as $book) "{{ asset('storage/' . $book->cover_image) }}", @endforeach
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
        const totalSlides = document.querySelectorAll(".book-slide").length-1;

        function updateSlider() {
            bestSellerBook.style.transform = `translateX(${-currentIndex * 100}%)`;
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

<div>
@include('includes.footer')

</body>
</html>

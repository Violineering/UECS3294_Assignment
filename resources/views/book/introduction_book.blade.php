<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unpopular. - {{ $book->title }}</title>
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
            overflow-y: scroll;
        }

        .book-intro {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px;
            gap: 40px;
            opacity: 0; /* Start hidden for fade-in animation */
            animation: fadeIn 1.5s ease forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        .book-cover {
            flex: 1;
            max-width: 400px;
            transition: transform 0.3s ease;
        }

        .book-cover:hover {
            transform: scale(1.05);
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
            animation: slideIn 1s ease forwards;
        }

        @keyframes slideIn {
            from {
                transform: translateX(-20px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .book-details p {
            font-size: 16px;
            color: #333;
            margin-bottom: 15px;
            animation: fadeInUp 1s ease forwards;
        }

        @keyframes fadeInUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .book-details .availability {
            font-size: 18px;
            font-weight: bold;
            color: {{ $book->availability === 'available' ? 'green' : 'red' }};
            animation: fadeIn 1s ease forwards;
        }

        footer {
            background-color: #1d1d1f;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto; /* Push the footer to the bottom */
            opacity: 0; /* Start hidden for fade-in animation */
            animation: fadeIn 1.5s ease forwards;
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
            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}">
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
            <p><strong>Price:</strong> RM{{ $book->price }}</p>
            <p class="availability">
                <strong>Availability:</strong> {{ ucfirst($book->availability) }}
            </p>
            <button onclick="addToCart({{ $book->id }})" class="add-to-cart-btn" {{ $book->availability === 'out of stock' ? 'disabled' : '' }}>
                Add to Cart
            </button>
            
            <script>
                function addToCart(bookId) {
                    @if(auth()->check())
                        fetch("{{ route('cart.add') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({ book_id: bookId })
                        })
                        .then(response => response.json())
                        .then(data => {
                            alert(data.message);
                            if (data.success) {
                                // Redirects to the cart page
                                window.location.href = "{{ route('cart') }}";
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            alert("An error occurred. Please try again.");
                        });
                    @else
                        // Redirect to login if user is not authenticated
                        window.location.href = "{{ route('login') }}";
                    @endif
                }
            </script>
                   
        </div>
    </section>

    @include('includes.footer') <!-- Include the footer -->

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
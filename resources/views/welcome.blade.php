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

        .main-canvas{
            display: flex;
            margin: -30px 100px 20px 100px;
        }

        .hero {
            text-align: left;
            padding: 50px;
            width: 80%;
            flex: 1;
            margin-right: 50px;
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
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            margin-top: 20px;
        }

        /* Book Showcase */
        .book-showcase {
            margin-top: 40px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 40px;
        }

        .books img {
            height: 200px;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.2);
        }

        .books .book1 {
            margin-bottom: 100px;
            margin-left: 25px;  
            margin-right: 25px; 
        }

        .books .book2 {
            margin-bottom: 0px;
            margin-left: 25px;  
            margin-right: 25px; 
        }

        .books .book3 {
            margin-bottom: -100px;
            margin-left: 25px;  
            margin-right: 25px; 
        }

        .stats {
            font-size: 20px;
            font-weight: bold;
        }

        /* Best Seller */
        .best-seller {
            background-color: white;
            padding: 20px;
            margin: 100px 100px 0 100px;
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
    @include('includes.navigationbar') <!-- Include the navigation bar -->

    <div class = "main-canvas">
    <section class="hero">
        <h1>TO SUCCEED YOU MUST READ</h1>
        <p><strong>Not sure what to read next?</strong> Explore our catalog of public domain books with our editors.</p>
        <button class="explore-btn">Explore Now →</button>
    </section>

    <section class="book-showcase">
        <div class="books">
            <img class = "book1" src="{{ asset('bookCover/book1.jpg') }}" alt="The First 90 Days">
            <img class = "book2" src="{{ asset('bookCover/book2.jpg') }}" alt="Hooked">
            <img class = "book3" src="{{ asset('bookCover/book3.jpg') }}" alt="The Subtle Art of Not Giving a F*ck">
        </div>
        <div class="stats">20k+ Books</div>
    </section>
    </div>

    <section class="best-seller">
        <div class="badge">Best Seller</div>
        <img src="psychology-of-money.jpg" alt="The Psychology of Money">
        <p>Our most popular and trending <strong>eBooks</strong> perfect for any reading mood.</p>
    </section>

    <script src="script.js"></script>
</body>
</html>
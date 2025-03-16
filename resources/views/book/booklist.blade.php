<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bliss - Book List</title>
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

        .book-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 40px;
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
            width: 100%;
            height: auto;
            margin-bottom: 15px;
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
            margin-top: 40px;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    @include('includes.navigationbar') <!-- Include the navigation bar -->

    <section class="book-list">
        <div class="book-card">
            <img src="{{ asset('bookCover/book1.jpg') }}" alt="The First 90 Days">
            <h2>The First 90 Days</h2>
            <p>Author: Michael D. Watkins</p>
            <p>This book provides a roadmap for taking charge in the first 90 days of a new job, offering strategies to help you transition smoothly and effectively.</p>
            <button class="read-more-btn">Read More →</button>
        </div>

        <div class="book-card">
            <img src="{{ asset('bookCover/book2.jpg') }}" alt="Hooked">
            <h2>Hooked</h2>
            <p>Author: Nir Eyal</p>
            <p>Learn how to build habit-forming products that keep users engaged and coming back for more.</p>
            <button class="read-more-btn">Read More →</button>
        </div>

        <div class="book-card">
            <img src="{{ asset('bookCover/book3.jpg') }}" alt="The Subtle Art of Not Giving a F*ck">
            <h2>The Subtle Art of Not Giving a F*ck</h2>
            <p>Author: Mark Manson</p>
            <p>A counterintuitive approach to living a good life, focusing on what truly matters and letting go of the rest.</p>
            <button class="read-more-btn">Read More →</button>
        </div>

        <div class="book-card">
            <img src="{{ asset('bookCover/book4.jpg') }}" alt="Atomic Habits">
            <h2>Atomic Habits</h2>
            <p>Author: James Clear</p>
            <p>Discover how small changes can lead to remarkable results and learn practical strategies for building good habits and breaking bad ones.</p>
            <button class="read-more-btn">Read More →</button>
        </div>

        <div class="book-card">
            <img src="{{ asset('bookCover/book5.jpg') }}" alt="The Psychology of Money">
            <h2>The Psychology of Money</h2>
            <p>Author: Morgan Housel</p>
            <p>Explore the complex relationship between money and human behavior, and learn how to make better financial decisions.</p>
            <button class="read-more-btn">Read More →</button>
        </div>

        <div class="book-card">
            <img src="{{ asset('bookCover/book6.jpg') }}" alt="Deep Work">
            <h2>Deep Work</h2>
            <p>Author: Cal Newport</p>
            <p>Learn how to focus intensely and produce high-quality work in a distracted world.</p>
            <button class="read-more-btn">Read More →</button>
        </div>
    </section>

    <footer>
        <p>&copy; 2023 Bliss. All rights reserved.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
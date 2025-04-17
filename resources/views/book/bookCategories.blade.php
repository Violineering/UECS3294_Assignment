<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Categories</title>
    <style>

        .container{
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f0eb;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Ensure it fills the viewport */
            flex-direction: column; /* To stack content vertically */
            
        }

        .category-list {
            list-style-type: none;
            padding: 0;
        }

        .category-item {
            margin: 5px 0;
        }

        .category-button {
            display: inline-block;
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .category-button:hover {
            background-color: #45a049;
        }

        .title {
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
        }

        .bookcategoryContainer {
            background-color: white;
            width: 500px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
            margin-top: -150px;
        }
        
    </style>
</head>
<body>

<!-- Include the navigation bar -->
@include('includes.navigationbar')

<!-- Centered Content Container -->
<div class="container">
    <div class="bookcategoryContainer">
        <h1 class="title">Book Categories</h1>

        <ul class="category-list">
            @foreach ($categories as $category)
                <li class="category-item">
                    <a href="{{ route('book.list_by_category', ['category' => $category->genre]) }}">
                        <button class="category-button">{{ $category->genre }}</button>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@include('includes.footer')

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Categories</title>
    <link rel="stylesheet" href="{{ asset('css/book/bookCategoriesList.css') }}">
</head>
<body>
@include('includes.navigationbar')

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

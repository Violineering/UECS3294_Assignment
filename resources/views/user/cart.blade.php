<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unpopular</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    @include('includes.navigationbar') <!-- Include the navigation bar -->

    <h1> Shopping Cart</h1>
    <div class="cart-container">
        @if($cartItems->count() > 0)
        <ul>
            @foreach($cartItems as $item)
                <li>
                    <div class="cart-item">
                        <span>{{ $item->title }}</span><br>
                    
                        <!-- Display the book cover image -->
                        <img src="{{ asset('storage/' . $item->cover_image) }}" alt="Cover of {{ $item->title }}" style="width: 100px; height: auto;">
                    
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="remove-btn">Remove</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p>Your cart is empty.</p>
    @endif
    </div>
    @include('includes.footer') <!-- Include the footer -->

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
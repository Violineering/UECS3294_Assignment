<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unpopular</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
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
            flex: 1;
        }

        footer {
            background-color: #1d1d1f;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>

<body>
    @include('includes.navigationbar') <!-- Include the navigation bar -->
    <form action="{{ route('cart.checkout') }}" method="POST">
        @csrf
        <h1> Shopping Cart</h1>
        <div class="cart-container">
            @if($cartItems->count() > 0)
            <ul>
                @foreach($cartItems as $item)
                    <li>
                        <div class="cart-item">
                            <input type="checkbox" name="selected_items[]" value="{{ $item->id }}">
                            <span>{{ $item->title }}</span><br>
                            <span>{{ $item->price }}</span><br>
                            <!-- Display the book cover image -->
                            <img src="{{ asset('storage/' . $item->cover_image) }}" alt="Cover of {{ $item->title }}" style="width: 100px; height: auto;"><br>
                        
                            <!-- Pass additional data as hidden inputs -->
                            <input type="hidden" name="cart_data[{{ $item->id }}][price]" value="{{ $item->price }}">
                            <input type="hidden" name="cart_data[{{ $item->id }}][title]" value="{{ $item->title }}">
                            <input type="hidden" name="cart_data[{{ $item->id }}][cover_image]" value="{{ $item->cover_image }}">

                            <!-- Remove button -->
                            <button type="button" class="remove-btn" onclick="removeFromCart({{ $item->id }})">Remove</button>
                        </div>
                    </li>
                @endforeach
            </ul>
            <button type="submit" class="checkout-btn">Checkout Selected Items</button>
        @else
            <p>Your cart is empty.</p>
        @endif
        </div>
    </form>

    <!-- JavaScript for handling the "Remove" button -->
    <script>
        function removeFromCart(itemId) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `{{ url('cart/remove') }}/${itemId}`;
            form.style.display = 'none';

            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';

            form.appendChild(csrfInput);
            document.body.appendChild(form);
            form.submit();
        }
    </script>

    @include('includes.footer') <!-- Include the footer -->
</body>
</html>
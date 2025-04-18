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
            background-color: #f5f0eb;
            font-family: 'Montserrat', sans-serif;
            color: #1d1d1f;
            display: flex;
            flex-direction: column;
        }

        body{
            overflow-y: scroll;
        }

        h1 {
            color: #474544;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: 7px;
            text-align: center;
            text-transform: uppercase;
            margin-top: 40px;
        }

        .cart-container {
            max-width: 768px;
            margin: 0 auto 60px;
            background-color: white;
            border: 3px solid #474544;
            padding: 37.5px;
        }

        .cart-item {
            margin-bottom: 30px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 15px;
        }

        .cart-flex {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 10px;
        }

        .cart-flex input[type="checkbox"] {
            margin-top: 3px;
        }

        .item-details {
            line-height: 1.4;
            color: #474544;
        }

        .item-details span:first-child {
            font-weight: bold;
        }

        .img-remove-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 10px;
        }

        .img-remove-wrapper img {
            width: 100px;
            height: auto;
        }

        .remove-btn {
            background: none;
            border: solid 2px #474544;
            color: #474544;
            cursor: pointer;
            font-size: 0.875em;
            font-weight: bold;
            padding: 10px 20px;
            text-transform: uppercase;
            transition: all 0.3s;
        }

        .remove-btn:hover {
            background: #474544;
            color: #f5f0eb;
        }

        .checkout-btn {
            background: none;
            border: solid 2px #474544;
            color: #474544;
            cursor: pointer;
            font-size: 0.875em;
            font-weight: bold;
            padding: 15px 30px;
            text-transform: uppercase;
            transition: all 0.3s;
            margin-top: 20px;
        }

        .checkout-btn:hover {
            background: #474544;
            color: #f5f0eb;
        }

        @media screen and (max-width: 768px) {
            .cart-container {
                width: 95%;
                padding: 20px;
            }

            .img-remove-wrapper {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    @include('includes.navigationbar') 

    <form action="{{ route('cart.checkout') }}" method="GET">
        @csrf
        <h1>&bull; Shopping Cart ({{session('cart_count')}}) &bull;</h1><br>

        <div class="cart-container">
            <!-- Display cart items -->
            @if($cartItems->count() > 0)
                <ul>
                @foreach($cartItems as $item)
                    <div class="cart-item">
                        <div class="cart-flex">
                            <input type="checkbox" name="selected_items[]" value="{{ $item->id }}">
                            <div class="item-details">
                                <span>{{ $item->book->title }}</span><br>
                                <span>RM {{ $item->book->price }}</span>
                            </div>
                        </div>

                        <div class="img-remove-wrapper">
                            <img src="{{ asset('storage/' . $item->book->cover_image) }}" alt="Cover of {{ $item->book->title }}">
                            <button type="button" class="remove-btn" onclick="removeFromCart({{ $item->id }})">Remove</button>
                        </div>

                        <input type="hidden" name="cart_data[{{ $item->id }}][price]" value="{{ $item->book->price }}">
                        <input type="hidden" name="cart_data[{{ $item->id }}][title]" value="{{ $item->book->title }}">
                        <input type="hidden" name="cart_data[{{ $item->id }}][cover_image]" value="{{ $item->book->cover_image }}">
                    </div>
                @endforeach
                </ul>
                <button type="submit" class="checkout-btn">Checkout Selected Items</button>
            @else
                <p>Your cart is empty.</p>
            @endif
        </div>
    </form>
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

    @include('includes.footer') 
</body>
</html>

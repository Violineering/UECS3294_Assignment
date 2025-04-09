<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
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

        .checkout-container {
            display: flex;
            gap: 20px;
        }
        .checkout-left, .checkout-right {
            flex: 1;
        }
        .checkout-left {
            border-right: 1px solid #ccc;
            padding-right: 20px;
        }
        .checkout-right {
            padding-left: 20px;
        }
    </style>
</head>

<body>
    @include('includes.navigationbar') <!-- Include the navigation bar -->
    <h1>Checkout</h1>

    <div class="checkout-container">
        <!-- Left Section: List of Checkout Items -->
        <div class="checkout-left">
            @if($selectedItems->count() > 0)
                @foreach($selectedItems as $item)
                    <div class="checkout-item" style="margin-bottom: 20px; border-bottom: 1px solid #ccc; padding-bottom: 10px;">
                        <h3>{{ $item['title'] }}</h3>
                        <p>Price: RM{{ $item['price'] }}</p>
                        <img src="{{ asset('storage/' . $item['cover_image']) }}" alt="Cover of {{ $item['title'] }}" style="width: 100px; height: auto;">
                    </div>
                @endforeach
                <div class="total-price" style="margin-top: 20px;">
                    <h3>Total Price: RM{{ $selectedItems->sum('price') }}</h3>
                </div>
                <div style="margin-top: 20px;">
                    <a href="{{ route('cart.showPaymentForm') }}" style="display: inline-block; background-color: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Pay Now</a>
                </div>
            @else
                <p>No items selected for checkout.</p>
            @endif
        </div>
    </div>

    @include('includes.footer') <!-- Include the footer -->
</body>
</html>
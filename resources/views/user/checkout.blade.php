<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout & Payment</title>
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
            padding: 20px;
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

        .checkout-item {
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }

        .checkout-item img {
            width: 100px;
            height: auto;
        }

        .total-price {
            margin-top: 20px;
        }

        .payment-form {
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .payment-form h3 {
            margin-top: 0;
        }

        .payment-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .payment-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .payment-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    @include('includes.navigationbar')

    <h1 style="padding-left: 20px;">Checkout & Payment</h1>

    <div class="checkout-container">
        <!-- Left Section: List of Checkout Items -->
        <div class="checkout-left">
            @php
                $selectedItems = session('checkout_items', collect());
            @endphp

            @if($selectedItems->count() > 0)
                @foreach($selectedItems as $item)
                    <div class="checkout-item">
                        <h3>{{ $item['title'] }}</h3>
                        <p>Price: RM{{ $item['price'] }}</p>
                        <img src="{{ asset('storage/' . $item['cover_image']) }}" alt="Cover of {{ $item['title'] }}">
                    </div>
                @endforeach

                <div class="total-price">
                    <h3>Total Price: RM{{ $selectedItems->sum('price') }}</h3>
                </div>
            @else
                <p>No items selected for checkout.</p>
            @endif
        </div>

        <!-- Right Section: Payment Form -->
        <div class="checkout-right">
            <div class="payment-form">
                <h3>Enter Your Credit Card Information</h3>
                <form action="{{ route('cart.processPayment') }}" method="POST">
                    @csrf

                    <label for="card_number">Card Number</label>
                    <input type="text" id="card_number" name="card_number" placeholder="e.g. 1234 5678 9012 3456">
                    <span style="color:red">@error('card_number'){{ $message }}@enderror</span><br><br>

                    <label for="expiry_month">Expiry Date</label><br>
                    <input type="text" id="expiry_month" name="expiry_month" placeholder="MM" maxlength="2" style="width: 50px;">
                    <input type="text" id="expiry_year" name="expiry_year" placeholder="YY" maxlength="2" style="width: 50px;"><br>
                    <span style="color:red">@error('expiry_month'){{ $message }}@enderror</span><br>
                    <span style="color:red">@error('expiry_year'){{ $message }}@enderror</span><br>

                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" name="cvv" placeholder="e.g. 123">
                    <span style="color:red">@error('cvv'){{ $message }}@enderror</span><br><br>

                    <label for="cardholder_name">Cardholder Name</label>
                    <input type="text" id="cardholder_name" name="cardholder_name" placeholder="e.g. Emma Charlotte Duerre Watson">
                    <span style="color:red">@error('cardholder_name'){{ $message }}@enderror</span><br><br>

                    <button type="submit" class="payment-btn">Confirm Payment</button>
                </form>
            </div>
        </div>
    </div>

    @include('includes.footer')
</body>
</html>

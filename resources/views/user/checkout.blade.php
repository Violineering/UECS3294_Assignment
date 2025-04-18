<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout & Payment</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
            background-color: #f5f0eb;
            color: #474544;
        }

        h1 {
            text-align: center;
            text-transform: uppercase;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: 7px;
            margin-top: 40px;
        }

        .checkout-container {
            max-width: 768px;
            margin: 30px auto;
            background-color: #fff;
            border: solid 3px #474544;
            padding: 37.5px;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .checkout-top, .checkout-bottom {
            width: 100%;
        }

        .checkout-item {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #ddd;
        }

        .checkout-item img {
            width: 80px;
            height: auto;
            border-radius: 4px;
        }

        .checkout-details h3 {
            font-size: 1em;
            font-weight: bold;
            margin: 0;
        }

        .checkout-details p {
            margin: 5px 0 0 0;
            font-size: 0.9em;
        }

        .total-price {
            margin-top: 20px;
            font-weight: bold;
            font-size: 1.1em;
        }

        .payment-form h3 {
            font-size: 1.1em;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .payment-form label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        .payment-form input {
            width: 100%;
            padding: 0.875em 0;
            margin-bottom: 10px;
            font-size: 1em;
            background: none;
            border: none;
            border-bottom: solid 2px #474544;
            color: #474544;
            transition: all 0.3s;
        }

        .payment-form input:focus {
            outline: none;
        }

        .payment-btn {
            background: none;
            border: solid 2px #474544;
            color: #474544;
            cursor: pointer;
            display: inline-block;
            font-size: 0.875em;
            font-weight: bold;
            padding: 20px 35px;
            text-transform: uppercase;
            transition: all 0.3s;
            margin-top: 15px;
        }

        .payment-btn:hover {
            background: #474544;
            color: #F2F3EB;
        }

        .error {
            color: red;
            font-size: 0.85em;
        }

        @media screen and (max-width: 768px) {
            .checkout-container {
                width: 95%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    @include('includes.navigationbar')

    <h1>&bull; Checkout & Payment &bull;</h1><br>

    <div class="checkout-container">
        <!-- Display checkout items -->
        <div class="checkout-top">
            @php
                $selectedItems = session('checkout_items', collect());
            @endphp
            
            @if($selectedItems->count() > 0)
                @foreach($selectedItems as $item)
                    <div class="checkout-item">
                        <img src="{{ asset('storage/' . $item['cover_image']) }}" alt="Cover of {{ $item['title'] }}">
                        <div class="checkout-details">
                            <h3>{{ $item['title'] }}</h3>
                            <p>Price: RM{{ $item['price'] }}</p>
                        </div>
                    </div>
                @endforeach
                <div class="total-price">
                    Total Price: RM{{ $selectedItems->sum('price') }}
                </div>
            @else
                <p>No items selected for checkout.</p>
            @endif
        </div>
        <!-- Display payment form -->
        <div class="checkout-bottom">
            <div class="payment-form">
                <h3>Enter Your Credit Card Information</h3>
                <form action="{{ route('cart.processPayment') }}" method="POST">
                    @csrf
                    <label for="card_number">Card Number</label>
                    <input type="text" id="card_number" name="card_number" placeholder="e.g. 1234 5678 8765 4321">
                    <span class="error">@error('card_number'){{ $message }}@enderror</span>

                    <label for="expiry_month">Expiry Date</label>
                    <div style="display: flex; gap: 10px;">
                        <input type="text" id="expiry_month" name="expiry_month" placeholder="MM" maxlength="2" style="width: 60px;">
                        <input type="text" id="expiry_year" name="expiry_year" placeholder="YY" maxlength="2" style="width: 60px;">
                    </div>
                    <span class="error">@error('expiry_month'){{ $message }}@enderror</span>
                    <span class="error">@error('expiry_year'){{ $message }}@enderror</span>

                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" name="cvv" placeholder="e.g. 123">
                    <span class="error">@error('cvv'){{ $message }}@enderror</span>

                    <label for="cardholder_name">Cardholder Name</label>
                    <input type="text" id="cardholder_name" name="cardholder_name" placeholder="e.g. Emma Charlotte Duerre Watson">
                    <span class="error">@error('cardholder_name'){{ $message }}@enderror</span><br>

                    <button type="submit" class="payment-btn">Confirm Payment</button>
                </form>
            </div>
        </div>
    </div>

    @include('includes.footer')
</body>
</html>

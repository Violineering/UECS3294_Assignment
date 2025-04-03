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
                <ul>
                    @foreach($selectedItems as $item)
                        <li>
                            <div class="checkout-item">
                                <span>{{ $item['title'] }}</span><br>
                                <img src="{{ asset('storage/' . $item['cover_image']) }}" alt="Cover of {{ $item['title'] }}" style="width: 100px; height: auto;">
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No items selected for checkout.</p>
            @endif
        </div>

        <!-- Right Section: Payment Form -->
        <div class="checkout-right">
            <form>
                @csrf
                <div>
                    <label for="card-number">Card Number:</label><br>
                    <input type="text" id="card-number" name="card_number" required>
                </div>
                <div>
                    <label for="expiry-date">Expiry Date:</label><br>
                    <input type="text" id="expiry-date" name="expiry_date" placeholder="MM/YY" required>
                </div>
                <div>
                    <label for="cvv">CVV:</label><br>
                    <input type="text" id="cvv" name="cvv" required>
                </div>
                <div>
                    <label for="name-on-card">Name on Card:</label><br>
                    <input type="text" id="name-on-card" name="name_on_card" required>
                </div>
                <button type="submit">Pay Now</button>
            </form>
        </div>
    </div>

    @include('includes.footer') <!-- Include the footer -->
</body>
</html>
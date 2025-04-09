<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Payment</title>
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

        .payment-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 20px;
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
    @include('includes.navigationbar') <!-- Include the navigation bar -->
    <h1>Payment</h1>

    <div class="payment-container">
        <!-- Payment Form -->
        <div class="payment-form">
        <h3>Enter Your Credit Card Information</h3>
        <form action="{{ route('cart.processPayment') }}" method="POST">
            @csrf
            <input type="text" name="card_number" placeholder="Card Number" required><br>
            <input type="text" name="expiry_date" placeholder="MM/YY" required><br>
            <input type="text" name="cvv" placeholder="CVV" required><br>
            <input type="text" name="cardholder_name" placeholder="Cardholder Name" required><br>
            <button type="submit" class="payment-btn">Confirm Payment</button>
        </form>
        </div>


    </div>

    @include('includes.footer') <!-- Include the footer -->
</body>
</html>

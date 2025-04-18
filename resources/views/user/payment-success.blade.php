<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
         html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f5f0eb;
            color: #1d1d1f;
            flex: 1;
            display: flex;
            flex-direction: column;
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

        .payment-success {
            text-align: center;
            margin-top: 40px;
            padding: 0 20px;
        }

        .payment-success h2 {
            font-size: 2em;
            font-weight: 700;
            color: #474544;
            margin-bottom: 15px;
        }

        .payment-success p {
            font-size: 1em;
            color: #474544;
            margin-bottom: 20px;
        }

        .btn-green {
            display: inline-block;
            padding: 12px 25px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
            text-transform: uppercase;
            font-weight: bold;
            transition: all 0.3s;
        }

        .btn-green:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    @include('includes.navigationbar')  
    <!-- Display payment success message -->
    <div class="payment-success">
        <h2>Payment Successful!</h2>
        <p>Thank you, Your payment has been processed successfully. You can now view your ebook in the "My Books" section!</p>
        <a href="{{ route('book.purchased_books') }}" class="btn-green">View My Books</a>
    </div>

    @include('includes.footer') 
</body>
</html>

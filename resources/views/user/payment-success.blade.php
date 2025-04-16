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
    @include('includes.navigationbar')  <!-- Navigation Bar -->

    <div class="payment-success">
        <h2>Payment Successful!</h2>
        <p>Thank you, Your payment has been processed successfully. You can now view your ebook in "My Books" section!</p>
    </div>

    @include('includes.footer')  <!-- Footer -->
</body>
</html>

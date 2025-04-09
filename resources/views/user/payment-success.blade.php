<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
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

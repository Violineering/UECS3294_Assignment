<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Bookstore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}"> 
</head>
<body>

<div class="page">
    <!-- Error Alert Positioned at the Top of the Page -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0" style="list-style-type: none; padding-left: 0; margin: 0;">
                @foreach($errors->all() as $error)
                    <li style="margin-bottom: 5px;">• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <div class="left">
            <div class="login">Sign Up</div>
            <div class="eula">
                Join us and explore a wide range of books.<br>
                Already have an account? 
                <a href="{{ route('login') }}" style="color: #8a6d4b; font-weight: bold;">Log in</a>
            </div>
        </div>

        <div class="right">
            <form class="form" method="POST" action="{{ route('register') }}">
                @csrf

                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>

                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required minlength="8">

                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>

                <button id="submit" type="submit">Create Account</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>

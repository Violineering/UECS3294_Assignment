<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">    
  <link rel="stylesheet" href="{{ asset('css/contactUs/contactForm.css') }}">
</head>
<body>

@include('includes.navigationbar')
<div class = "contactForm">

  

  <div class="content-wrapper">
    @if(session('success'))
      <div class="alert-success">
        {{ session('success') }}
      </div>
    @endif
    @if(session('error'))
      <div class="alert-error">
        {{ session('error') }}
      </div>
    @endif

    <div id="container">
      <h1>&bull; Contact Us &bull;</h1>
      <div class="underline"></div>

      <form method="POST" action="{{ route('contact.store') }}">
        @csrf
        <label for="issue" style="display: block; margin-bottom: 40px;">Your Message</label>
        <textarea name="issue" id="issue" placeholder="Write your issue here..." required></textarea>
        <button id="form_button" type="submit">Send</button>
      </form>
    </div>
  </div>

</div>
  @include('includes.footer')

</body>
</html>

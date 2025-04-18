<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
  <style>
    html, body {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
      background-color: #f5f0eb;
      font-family: 'Montserrat', sans-serif;
    }

    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      overflow-y: scroll;
    }

    .content-wrapper {
      flex: 1;
      max-width: 1200px;
      margin: 0 auto;
      width: 100%;
      padding: 20px;
      display: flex;
      flex-direction: column;
    }

    #container {
      border: solid 3px #474544;
      max-width: 768px;
      width: 90%;
      margin: 60px auto;
      background-color: white;
      padding: 37.5px;
      box-sizing: border-box;
    }

    h1 {
      color: #474544;
      font-size: 32px;
      font-weight: 700;
      letter-spacing: 7px;
      text-align: center;
      text-transform: uppercase;
    }

    .underline {
      border-bottom: solid 2px #474544;
      margin: -0.512em auto 2em;
      width: 80px;
    }

    textarea {
      width: 100%;
      background: none;
      border: none;
      border-bottom: solid 2px #474544;
      color: #474544;
      font-size: 1em;
      padding: 0.875em 0;
      resize: none;
      transition: all 0.3s;
    }

    textarea:focus {
      outline: none;
    }

    #form_button {
      background: none;
      border: solid 2px #474544;
      color: #474544;
      cursor: pointer;
      font-size: 0.875em;
      font-weight: bold;
      padding: 20px 35px;
      text-transform: uppercase;
      transition: all 0.3s;
      margin-top: 20px;
    }

    #form_button:hover {
      background: #474544;
      color: #F2F3EB;
    }

    .alert-success, .alert-error {
      text-align: center;
      margin: 20px 0;
      font-weight: bold;
    }

    .alert-success {
      color: green;
    }

    .alert-error {
      color: red;
    }

    @media screen and (max-width: 768px) {
      #container {
        margin: 20px auto;
      }
    }

    
  </style>
</head>
<body>

  @include('includes.navigationbar') <!-- Full width navbar -->

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
        <label for="issue" style="display: block; margin-bottom: 10px;">Your Message</label>
        <textarea name="issue" id="issue" placeholder="Write your issue here..." required></textarea>
        <button id="form_button" type="submit">Send</button>
      </form>
    </div>
  </div>

  @include('includes.footer') <!-- Full width footer -->

</body>
</html>

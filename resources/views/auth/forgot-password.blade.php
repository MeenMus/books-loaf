<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password - BooksLoaf</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="icon" href="{{ asset('favicon-booksloaf.ico') }}" type="image/x-icon">

    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            font-family: Arial, sans-serif;
        }

        .left-side {
            flex: 1;
            background-image: url('/images/books.jpeg');
            background-size: cover;
            background-position: center;
        }

        .right-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .forgot-box {
            width: 100%;
            max-width: 400px;
        }

        .forgot-box h2 {
            margin-bottom: 20px;
        }

        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: #a75f09;
            color: white;
            border: none;
        }

        .login-link {
            text-align: center;
            margin-top: 10px;
        }

        .login-link a {
            color: #a75f09;
            text-decoration: none;
        }
    </style>
</head>

<body>

    @include('sweetalert::alert')

    <div class="left-side"></div>
    <div class="right-side">
        <div class="forgot-box">
            <img src="/images/logo.png" alt="LoafBooks Logo" width="120" style="display:block; margin:auto;">
            <h2>Forgot Your Password?</h2>
            <form method="POST" action="{{ url('/forgot-password') }}">
                @csrf
                <label for="email">Enter your email address</label>
                <input type="email" name="email" id="email" placeholder="you@email.com" required>

                <button type="submit" class="btn">Send Reset Link</button>
            </form>

            <div class="login-link">
                <p><a href="{{ route('login') }}">Back to login</a></p>
            </div>
        </div>
    </div>

</body>

</html>

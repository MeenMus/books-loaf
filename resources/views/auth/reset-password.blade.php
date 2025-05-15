<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reset Password - BooksLoaf</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">\
    <link rel="icon" href="{{ asset('favicon-booksloaf.ico') }}" type="image/x-icon">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fefbf6;
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
            background-color: #fff7ed;
        }

        .forgot-box {
            width: 100%;
            max-width: 400px;
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .forgot-box img {
            display: block;
            margin: 0 auto 20px;
        }

        .forgot-box h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #a75f09;
        }

        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: #a75f09;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #8a4b05;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
        }

        .login-link a {
            color: #a75f09;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    @include('sweetalert::alert')

    <div class="left-side"></div>

    <div class="right-side">
        <div class="forgot-box">
            <img src="/images/logo.png" alt="BooksLoaf Logo" width="120">
            <h2>Reset Your Password</h2>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <input type="password" name="password" placeholder="New Password" required>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

                <button type="submit" class="btn">Reset Password</button>
            </form>

            <div class="login-link">
                <a href="{{ route('login') }}">Back to Login</a>
            </div>
        </div>
    </div>

</body>

</html>

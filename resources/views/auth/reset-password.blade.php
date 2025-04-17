<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password - BooksLoaf</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
            <img src="/images/logo.jpg" alt="LoafBooks Logo" width="120" style="display:block; margin:auto;">
            <h2>Forgot Your Password?</h2>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="password" name="password" placeholder="New Password" required><br>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required><br>

                <button type="submit">Reset Password</button>
            </form>
        </div>
    </div>

</body>

</html>
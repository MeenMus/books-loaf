<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>BooksLoaf</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- optional, for styling -->
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
            /* Put your image in public/images */
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

        .register-box {
            width: 100%;
            max-width: 400px;
        }

        .register-box h2 {
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
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
        <div class="register-box">
            <img src="/images/logo.jpg" alt="LoafBooks Logo" width="120" style="display:block; margin:auto;">
            <h2>Create an Account</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" placeholder="Your Name" required>

                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="you@email.com" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>

                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>

                <button type="submit" class="btn">Register</button>
            </form>

            <div class="login-link">
                <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
            </div>
        </div>
    </div>
</body>

</html>
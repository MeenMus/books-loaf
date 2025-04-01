<!DOCTYPE html>
<html lang="en">
    
@include('layouts.header')

<head>
    <meta charset="UTF-8">
    <title>Login - LoafBooks</title>
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
            background-image: url('images/books.jpeg');
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

        .login-box {
            width: 100%;
            max-width: 400px;
        }

        .login-box h2 {
            margin-bottom: 20px;
        }

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

        .register-link {
            text-align: center;
            margin-top: 10px;
        }

        .register-link a {
            color: #a75f09;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="left-side"></div>
    <div class="right-side">
        <div class="login-box">
            <img src="images/logo.jpg" alt="LoafBooks Logo" width="120" style="display:block; margin:auto;">
            <h2>Welcome back!</h2>
            <form method="POST" action="">
                @csrf
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" placeholder="you@email.com" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>

                <div>
                    <input type="checkbox" name="remember"> Remember Me
                </div>

                <button type="submit" class="btn">Login</button>
            </form>

            <div class="register-link">
                <p>Don't have an account? <a href="">Register</a></p>
            </div>
        </div>
    </div>
</body>

</html>
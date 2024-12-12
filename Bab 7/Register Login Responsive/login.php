<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: url('login.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding-top: 100px;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #C4D7FF;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
        }

        header nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .nav-links li {
            display: inline;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #ff6b6b;
        }

        .sign-up {
            background-color: #ff6b6b;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .sign-up:hover {
            background-color: #ff4c4c;
        }

        .wrapper {
            width: 420px;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(20px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: #fff;
            border-radius: 10px;
            padding: 30px 40px;
        }

        .wrapper h1 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 20px;
        }

        .input-box {
            margin-bottom: 15px;
            position: relative;
        }

        .input-box input {
            width: 100%;
            padding: 10px;
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid #fff;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            outline: none;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            color: white;
            font-size: 14px;
            margin-bottom: 20px;
        }

        button.button {
            width: 100%;
            padding: 10px;
            background-color: #ff6b6b;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button.button:hover {
            background-color: #ff4c4c;
        }

        .register-link {
            margin-top: 20px;
            color: white;
            text-align: center;
        }

        .register-link a {
            color: #ff6b6b;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <div class="logo">Hallo, Selamat Datang</div>
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">Courses</a></li>
                <li><a href="#">Register</a></li>
            </ul>
            <a href="#" class="sign-up">Sign Up</a>
        </nav>
    </header>

    <div class="wrapper">
    <form action="login-proses.php" method="post">
            <h1>Login</h1>

            <div class="input-box">
                <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" name="password" required>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox" name="remember"> Remember me</label>
                <a href="#">Forgot password</a>
            </div>

            <button type="submit" class="button">Login</button>

            <div class="register-link">
                <p>Don't have an account? <a href="#">Register</a></p>
            </div>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $users = [
                "admin" => "admin123",
                "user1" => "password1",
                "user2" => "password2"
            ];

            $username = $_POST['username'];
            $password = $_POST['password'];

            if (array_key_exists($username, $users) && $users[$username] === $password) {
                echo "<p style='color: green; text-align: center;'>Login berhasil! Selamat datang, $username.</p>";
            } else {
                echo "<p style='color: red; text-align: center;'>Username atau password salah!</p>";
            }
        }
        ?>
    </div>
</body>
</html>

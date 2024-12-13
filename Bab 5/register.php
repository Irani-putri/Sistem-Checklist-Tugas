<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* Reset and main styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: url('img.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding-top: 70px;
            color: #fff;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #C4D7FF;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            color: black;
            font-size: 24px;
            font-weight: bold;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .nav-links li a {
            text-decoration: none;
            color: black;
            font-size: 16px;
        }

        .sign-up {
            background-color: #ff6b6b;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .sign-up:hover {
            background-color: #ff4c4c;
        }

        .wrapper {
            width: 420px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 30px 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, .2);
        }

        .wrapper h1 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 20px;
        }

        .input-box {
            position: relative;
            margin-bottom: 15px;
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

        .input-box input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .button {
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

        .button:hover {
            background-color: #ff4c4c;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            color: #ff6b6b;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        @media screen and (max-width: 480px) {
            .nav-links {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <?php
    // Process form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize and validate input data
        $username = htmlspecialchars(trim($_POST['username']));
        $email = htmlspecialchars(trim($_POST['email']));
        $password = htmlspecialchars(trim($_POST['password']));

        // Basic email validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format.";
        } else {
            // Display success message (remove password display for security)
            echo "<div class='wrapper'><h2>Registration Successful!</h2>";
            echo "<p>Username: $username</p>";
            echo "<p>Email: $email</p></div>";
        }
    }
    ?>

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
        <h1>Register</h1>

        <?php if (isset($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="input-box">
                <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="input-box">
                <input type="text" placeholder="Email" name="email" required>
            </div>
            <div class="input-box">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <button type="submit" class="button">Register</button>
        </form>
        <div class="register-link">
            <p>Already have an account? <a href="#">Login here</a></p>
        </div>
    </div>
</body>

</html>

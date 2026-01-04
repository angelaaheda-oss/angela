<?php
session_start();
include "db.php";

$error = "";

if (isset($_POST['login'])) {

    $username = trim($_POST['username']); 
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {

        $query = mysqli_query(
            $conn,
            "SELECT * FROM users WHERE username='$username' OR email='$username' LIMIT 1"
        );

        if (mysqli_num_rows($query) === 1) {

            $user = mysqli_fetch_assoc($query);

            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user['username'];
                $_SESSION['order_id'] = $user['id'];

                header("Location: head.php");
                exit();
            } else {
                $error = "❌ Incorrect password";
            }

        } else {
            $error = "❌ Account not found";
        }
    } else {
        $error = "❌ Please fill in all fields";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Coffee Shop Login</title>
    <link rel="stylesheet" href="styling.css">
    <style>
        body.login-page {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(to right, #2c1a12, #4b2e24);
        }

        .login-box {
            max-width: 360px;
            width: 100%;
            background: rgba(255,255,255,0.12);
            padding: 35px 30px;
            border-radius: 22px;
            text-align: center;
            box-shadow: 10px 10px 0 rgba(0,0,0,0.5);
            backdrop-filter: blur(12px);
        }

        .login-box h2 {
            margin-bottom: 20px;
            color: #ffddc1;
        }

        .login-box input {
            width: 100%;
            padding: 12px 16px;
            margin: 12px 0;
            border-radius: 30px;
            border: none;
            font-size: 14px;
        }

        .login-box button {
            width: 100%;
            margin-top: 15px;
            background: linear-gradient(135deg, #ffb703, #fb8500);
            border: none;
            padding: 12px;
            border-radius: 30px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 4px 4px 0 rgba(0,0,0,0.5);
        }

        .login-box button:hover {
            transform: scale(1.05);
        }

        .error {
            color: #ff6b6b;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .signup-link {
            margin-top: 15px;
            font-size: 14px;
            color: #ffddc1;
        }

        .signup-link a {
            color: #ffb703;
            font-weight: bold;
            text-decoration: none;
        }
    </style>
</head>

<body class="login-page">

<div class="login-box">
    <h2>☕ Coffee Shop Login</h2>

    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username or Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>

    <p class="signup-link">
        Not registered yet?
        <a href="signup.php">Create an account</a>
    </p>
</div>

</body>
</html>

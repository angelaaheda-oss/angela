<?php
session_start();
include "db.php"; 

$error = "";
$success = "";

if (isset($_POST['signup'])) {

    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($email) || empty($username) || empty($password)) {
        $error = "❌ All fields are required";
    } else {

        
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR username = ?");
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "❌ Email or Username already exists";
        } else {

            $hashed = password_hash($password, PASSWORD_DEFAULT);

            
            $insert = $conn->prepare(
                "INSERT INTO users (email, username, password) VALUES (?, ?, ?)"
            );
            $insert->bind_param("sss", $email, $username, $hashed);

            if ($insert->execute()) {
                $success = "✅ Account created! You can now log in.";
            } else {
                $error = "❌ Registration failed. Try again.";
            }

            $insert->close();
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up - Coffee Shop</title>
    <link rel="stylesheet" href="styling.css">
</head>

<body class="login-page">

<div class="login-box">
    <h2>☕ Create Account</h2>

    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <p class="success"><?= htmlspecialchars($success); ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="signup">Sign Up</button>
    </form>

    <p style="margin-top:15px;">
        <a href="login.php" class="back-link">⬅ Back to Login</a>
    </p>
</div>

</body>
</html>

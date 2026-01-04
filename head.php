<?php

session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}


$cartCount = !empty($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Coffee Shop Ordering System</title>
    <link rel="stylesheet" href="styling.css">
</head>
<body>

<!-- Header -->
<header class="site-header">
    <h1>☕ Coffee Shop Ordering System</h1>

    <nav>
        <a href="product.php">Menu</a> |
        <a href="cart.php">Cart (<?php echo $cartCount; ?>)</a> 
    </nav>
</header>

<!-- Welcome Section -->
<section class="welcome-section">
    <?php include 'wc.php'; ?>
</section>

<!-- Sticker Section -->
<section class="sticker-section">
    <?php include 'sticker.php'; ?>
</section>
<div style="text-align:center; margin-top: 30px;">
    <a href="login.php"><button>⬅ Back</button></a>
</div>

</body>
</html>




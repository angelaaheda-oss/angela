<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cartCount = 0;
if (!empty($_SESSION['cart'])) {
    $cartCount = array_sum(array_column($_SESSION['cart'], 'quantity'));
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Coffee Shop Ordering System</title>
    <link rel="stylesheet" href="styling.css">
</head>
<body>

<nav>
    <a href="index.php">Menu</a> |
    <a href="cart.php">Cart (<?php echo $cartCount; ?>)</a>
</nav>

<hr>

</body>
</html>

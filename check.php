<?php
session_start();
include "dbconn.php"; 


if (empty($_SESSION['cart'])) {
    $_SESSION['message'] = "Your cart is empty!";
    header("Location: product.php");
    exit();
}


$grand = 0;
foreach ($_SESSION['cart'] as $item) {
    $grand += $item['price'] * $item['quantity'];
}


$stmt = $conn->prepare("INSERT INTO orders (total) VALUES (?)");
$stmt->bind_param("d", $grand);
$stmt->execute();


$order_id = $stmt->insert_id;
$stmt->close();


$item_stmt = $conn->prepare("INSERT INTO orders (order_id, product, price, quantity, total) VALUES (?, ?, ?, ?, ?)");

foreach ($_SESSION['cart'] as $item) {
    $product = $item['name'];
    $price = $item['price'];
    $qty = $item['quantity'];
    $total = $price * $qty;

    $item_stmt->bind_param("isidd", $order_id, $product, $price, $qty, $total);
    $item_stmt->execute();
}

$item_stmt->close();


$_SESSION['cart'] = [];


header("Location: checkout_success.php");
exit();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout - Coffee Shop</title>
    <link rel="stylesheet" href="styling.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="checkout-container">
    <h2>✅ Order Placed!</h2>
    <p>Your order has been successfully placed.</p>
    <p><strong>Grand Total:</strong> ₱<?= number_format($grand, 2); ?></p>

    <a href="product.php" class="btn">Back to Menu</a>
    <a href="logout.php" class="btn" style="margin-left:10px;">Logout</a>
</div>

<?php include 'footer.php'; ?>

</body>
</html>

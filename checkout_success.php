<?php
session_start();
include "dbconn.php"; 



$stmt = $conn->prepare("SELECT total FROM orders WHERE order_id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$stmt->bind_result($grand_total);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout Success - Coffee Shop</title>
    <link rel="stylesheet" href="styling.css">
    <style>
        .checkout-container {
            max-width: 500px;
            margin: 50px auto;
            background: rgba(255,255,255,0.12);
            padding: 35px 30px;
            border-radius: 22px;
            text-align: center;
            box-shadow: 10px 10px 0 rgba(0,0,0,0.5);
            backdrop-filter: blur(12px);
        }

        .checkout-container h2 {
            color: #ffddc1;
            margin-bottom: 25px;
            font-size: 32px;
        }

        .checkout-container p {
            color: #ffd166;
            font-size: 18px;
            margin: 15px 0;
        }

        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #ffb703, #fb8500);
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            font-weight: bold;
            cursor: pointer;
            color: #2c1a12;
            transition: all 0.3s ease;
            box-shadow: 4px 4px 0 rgba(0,0,0,0.5);
            text-decoration: none;
            margin: 10px 5px;
        }

        .btn:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #fb8500, #ffb703);
        }

        .logout-link {
            display: inline-block;
            margin-top: 20px;
            font-size: 16px;
            color: #ff6b6b;
            text-decoration: none;
        }

        .logout-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="checkout-container">
    <h2>✅ Order Placed Successfully!</h2>
    <p>Thank you for your order ☕</p>
    </p>

    <a href="product.php" class="btn">Back to Menu</a>
    <a href="logout.php" class="logout-link">Logout</a>
</div>

<?php include 'footer.php'; ?>

</body>
</html>

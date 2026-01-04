<?php
$host = "localhost";      // Usually localhost
$user = "root";           // Your MySQL username
$pass = "";               // Your MySQL password
$db   = "order_items";       // Your database name

// Create connection
$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Optional: set charset to UTF-8
mysqli_set_charset($conn, "utf8");
?>

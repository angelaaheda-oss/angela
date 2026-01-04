<?php 
include 'header.php'; 
?>

<?php

$products = [
    1 => ["name" => "Americano", "price" => 49, "image" => "americano.jpg"],
    2 => ["name" => "Latte", "price" => 49, "image" => "latte.jpg"],
    3 => ["name" => "Cappuccino", "price" => 49, "image" => "cappuccino.jpg"],
    4 => ["name" => "Mocha", "price" => 49, "image" => "mocha.jpg"],
];
?>

<h2>☕ Coffee Menu</h2>

<div class="menu">
<?php foreach ($products as $id => $p): ?>
    <div class="card">
        <!-- Product Image -->
        <img src="<?= htmlspecialchars($p['image']); ?>" alt="<?= htmlspecialchars($p['name']); ?>">

        <h3><?= htmlspecialchars($p['name']); ?></h3>
        <p class="price">₱<?= number_format($p['price'], 2); ?></p>

        <!-- Fixed Form -->
        <form action="cart.php" method="POST">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <input type="number" name="qty" value="1" min="1">
            <button type="submit" name="add">Add to Cart</button>
        </form>
    </div>
<?php endforeach; ?>
</div>

<!-- Back Button -->
<div style="text-align:center; margin-top: 30px;">
    <a href="head.php"><button>⬅ Back</button></a>
</div>

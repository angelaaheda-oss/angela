<?php

include 'header.php'; 
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['add'])) {
    $id = $_POST['id'];
    $qty = isset($_POST['qty']) ? (int)$_POST['qty'] : 1;

    
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += $qty;
    } else {
        
        $products = [
            1 => ["name" => "Americano", "price" => 49],
            2 => ["name" => "Latte", "price" => 49],
            3 => ["name" => "Cappuccino", "price" => 49],
            4 => ["name" => "Mocha", "price" => 49],
        ];

        if (isset($products[$id])) {
            $_SESSION['cart'][$id] = [
                "name" => $products[$id]['name'],
                "price" => $products[$id]['price'],
                "quantity" => $qty
            ];
        }
    }
}


if (isset($_POST['remove'])) {
    $id = $_POST['id'];
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }
}
?>

<h2>🛒 Your Cart</h2>

<?php if (empty($_SESSION['cart'])): ?>
    <p>Your cart is empty.</p>
    <p><a href="product.php"><button>☕ Back to Menu</button></a></p>
<?php else: ?>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Coffee</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Action</th>
        </tr>

        <?php
        $grandTotal = 0;
        foreach ($_SESSION['cart'] as $id => $item):
            $total = $item['price'] * $item['quantity'];
            $grandTotal += $total;
        ?>
            <tr>
                <td><?= htmlspecialchars($item['name']); ?></td>
                <td>₱<?= number_format($item['price'], 2); ?></td>
                <td><?= $item['quantity']; ?></td>
                <td>₱<?= number_format($total, 2); ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <button name="add">➕</button>
                    </form>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <button name="remove">❌</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>

        <tr>
            <td colspan="3"><b>Grand Total</b></td>
            <td colspan="2"><b>₱<?= number_format($grandTotal, 2); ?></b></td>
        </tr>
    </table>

    <p>
        <a href="product.php"><button>☕ Add More Coffee</button></a>
        <a href="check.php"><button>✅ Proceed to Checkout</button></a>
    </p>
<?php endif; ?>


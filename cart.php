<?php
session_start();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart</title>
</head>
<body>
  <h1>Your Cart</h1>
  <?php if (!empty($cart)): ?>
    <table>
      <thead>
        <tr>
          <th>Item</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($cart as $id => $item): ?>
          <tr>
            <td><?= htmlspecialchars($item['amulet_pre_name']) ?></td>
            <td><?= number_format($item['amulet_pre_price']) ?> ກີບ</td>
            <td><?= $item['quantity'] ?></td>
            <td><?= number_format($item['amulet_pre_price'] * $item['quantity']) ?> ກີບ</td>
          </tr>
          <?php $total += $item['amulet_pre_price'] * $item['quantity']; ?>
        <?php endforeach; ?>
      </tbody>
    </table>
    <h2>Total: <?= number_format($total) ?> ກີບ</h2>
    <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
  <?php else: ?>
    <p>Your cart is empty.</p>
  <?php endif; ?>
</body>
</html>

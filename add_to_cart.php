<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $itemId = $_POST['id'];
  $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

  if ($userId && $itemId) {
    // Retrieve the item details from your database
    include("config.php");
    $sql = "SELECT * FROM preorderdetails WHERE amulet_pre_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $itemId);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();

    if ($item) {
      // Initialize cart if not already set
      if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
      }

      // Add item to cart
      if (isset($_SESSION['cart'][$itemId])) {
        $_SESSION['cart'][$itemId]['quantity'] += 1;
      } else {
        $_SESSION['cart'][$itemId] = [
          'amulet_pre_name' => $item['amulet_pre_name'],
          'amulet_pre_price' => $item['amulet_pre_price'],
          'quantity' => 1
        ];
      }

      echo "Item added to cart successfully.";
    } else {
      echo "Item not found.";
    }

    $stmt->close();
    $conn->close();
  } else {
    echo "User not logged in or invalid item.";
  }
}
?>

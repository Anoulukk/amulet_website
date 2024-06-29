<?php
session_start();
include("config.php");

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cart = $_SESSION['cart'];
$id = $_POST['id'];
$action = $_POST['action'];
$user_id = $_SESSION['user_id']; // Assuming you store the user ID in session

// Check the total number of preorders for the user
$sql = "SELECT SUM(amulet_user_pre_amount) as total_preorders FROM preorderlist WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$totalPreorders = $row['total_preorders'];

$amuletss = getAmuletById($id);
$stockQuantity = $amuletss['stock']; // Using 'stock' column from the table


if ($action == 'increase') {
    // Check total quantity in cart
    $totalQuantity = 0;
    foreach ($cart as $item) {
        $totalQuantity += $item['quantity'];
    }
    
    // If total quantity exceeds 10, return a message
    if($totalQuantity + $totalPreorders < 10){
        if ($totalQuantity >= $stockQuantity) {
            echo "You can only add up to 10 items in total.";
            exit;
        }
    }else{
        echo "You can only add up to 10 items in total.";
        exit;
    }

    // Increase quantity
    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        // Assuming you have a function getAmuletById to get amulet details by ID
        $amulet = getAmuletById($id);
        $cart[$id] = [
            'amulet_pre_id' => $amulet['amulet_pre_id'],
            'amulet_pre_name' => $amulet['amulet_pre_name'],
            'amulet_pre_price' => $amulet['amulet_pre_price'],
            'quantity' => 1
        ];
    }
} elseif ($action == 'decrease') {
    // Decrease quantity
    if (isset($cart[$id])) {
        $cart[$id]['quantity']--;
        if ($cart[$id]['quantity'] <= 0) {
            unset($cart[$id]);
        }
    }
}

// Update the session cart
$_SESSION['cart'] = $cart;

// Check if the item is in the cart and return appropriate response
if (isset($cart[$id])) {
    echo json_encode(['quantity' => $cart[$id]['quantity']]);
} else {
    echo json_encode(['quantity' => 0]);
}

function getAmuletById($id) {
    // Implement your logic to fetch amulet details by ID from the database
    // Example:
    include("config.php");
    $sql = "SELECT amulet_pre_id, amulet_pre_name, amulet_pre_price, stock FROM preorderdetails WHERE amulet_pre_id = $id";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}
?>

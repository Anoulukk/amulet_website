<?php
session_start();
include('config.php');

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$user_id = $_SESSION['user_id']; // Assuming you have stored the user ID in session after login
$preorder_address = $_POST['preorder_address'];
$payment_proof = $_FILES['payment_proof'];

// Validate the uploaded file
if ($payment_proof['error'] === UPLOAD_ERR_OK) {
    $target_dir = "transfersSlip/";
    $target_file = $target_dir . basename($payment_proof["name"]);
    move_uploaded_file($payment_proof["tmp_name"], $target_file);
} else {
    die("Error uploading file.");
}

// Save order details to the database
foreach ($cart as $id => $item) {
    // Fetch the preorder_id from the preorder table
    $sql = "SELECT preorder_id FROM preorderdetails WHERE amulet_pre_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $item['amulet_pre_id']);
    $stmt->execute();
    $stmt->bind_result($preorder_id);
    $stmt->fetch();
    $stmt->close();

    if (empty($preorder_id)) {
        die("Preorder ID not found for the item.");
    }

    $amulet_pre_id = $item['amulet_pre_id'];
    $amulet_user_pre_amount = $item['quantity'];
    $amulet_pre_price = $item['amulet_pre_price'];
    $preorder_status = "Pending"; // Initial status of the preorder
    $preorder_transfer_image = $target_file; // Path to the uploaded image

    $sql = "INSERT INTO preorderlist (preorderlist_id, preorder_id, amulet_pre_id, amulet_user_pre_amount, amulet_pre_price, user_id, preorder_status, preorder_address, preorder_transfer_image)
            VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiiissss", $preorder_id, $amulet_pre_id, $amulet_user_pre_amount, $amulet_pre_price, $user_id, $preorder_status, $preorder_address, $preorder_transfer_image);
    $stmt->execute();
    $stmt->close();
}

// Clear the cart after successful submission
unset($_SESSION['cart']);

header("Location: success.php");
exit();
?>

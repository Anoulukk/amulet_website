<?php
session_start();
include("config.php");

$user_id = $_SESSION['user_id']; // Assuming you store the user ID in session
$item_id = $_POST['id'];

// Check the total number of preorders for the user
$sql = "SELECT SUM(amulet_user_pre_amount) as total_preorders FROM preorderlist WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['total_preorders'] >= 10) {
    echo "limit_reached";
} else {
    echo "ok";
}
?>

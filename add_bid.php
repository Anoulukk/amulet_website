<?php
// add_bid.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "amuletdb";

// Get the data from the AJAX request
$user_id = $_POST['user_id'];
$auction_id = $_POST['auction_id'];
$auction_price = $_POST['auction_price'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO auctionlist (user_id, auction_id, auction_date, auction_price) VALUES (?, ?, CURRENT_TIMESTAMP, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $user_id, $auction_id, $auction_price);

$response = array();
if ($stmt->execute()) {
  $response['status'] = 'success';
} else {
  $response['status'] = 'error';
  $response['message'] = $stmt->error;
}

echo json_encode($response);

$stmt->close();
$conn->close();
?>

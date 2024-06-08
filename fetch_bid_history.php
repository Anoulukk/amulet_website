<?php
// fetch_bid_history.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "amuletdb";

$auction_id = $_GET['auction_id'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT a.auctionlist_id, u.username, a.auction_price, a.auction_date 
        FROM auctionlist a 
        JOIN user u ON a.user_id = u.user_id 
        WHERE a.auction_id = ?
        ORDER BY a.auction_price DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $auction_id);
$stmt->execute();
$result = $stmt->get_result();

$bid_history = array();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $bid_history[] = $row;
  }
}

echo json_encode($bid_history);

$stmt->close();
$conn->close();
?>

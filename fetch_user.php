<?php
// fetch_user.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "amuletdb";

$user_id = $_GET['user_id'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT username FROM user WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();

echo json_encode(array("username" => $username));

$stmt->close();
$conn->close();
?>

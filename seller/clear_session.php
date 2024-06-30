<?php
session_start();

// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();
$_SESSION['role'] = 'user';

// Get the auction_id from the query parameter
$auction_id = isset($_GET['auction_id']) ? intval($_GET['auction_id']) : 0;

// Redirect to the auction detail page
header("Location: ../auction_detail.php?auction_id=$auction_id");
exit();
?>

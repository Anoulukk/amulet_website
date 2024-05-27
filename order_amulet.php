<?php
// Start the session and include database configuration
include("config.php");
session_start();

// Check if user is logged in and if the form is submitted via POST method
if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: login.php');
    exit();
}

// Retrieve form data
$amulet_sell_id = intval($_POST['amulet_sell_id']);
$seller_id = intval($_POST['seller_id']);
$user_id = intval($_POST['user_id']);
$orderamulet_qty = intval($_POST['orderamulet_qty']);
$orderamulet_date = date('Y-m-d H:i:s');
// Check if the user has already ordered the same amulet
$sql_check_order = "SELECT COUNT(*) AS num_orders FROM orderamulet WHERE amulet_sell_id = ? AND user_id = ?";
$stmt_check_order = $conn->prepare($sql_check_order);
$stmt_check_order->bind_param("ii", $amulet_sell_id, $user_id);
$stmt_check_order->execute();
$result_check_order = $stmt_check_order->get_result();
$row_check_order = $result_check_order->fetch_assoc();

if ($row_check_order['num_orders'] > 0) {
    echo "You have already ordered this amulet.";
    header('Location: index.php');

    exit();
}
// Insert the order details into the orderamulet table
$sql = "INSERT INTO orderamulet (amulet_sell_id, user_id, orderamulet_qty, orderamulet_date, seller_id) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Check if the prepare() call succeeded
if (!$stmt) {
    // Handle the error appropriately
    echo "Error: " . $conn->error;
} else {
    // Bind parameters
    $stmt->bind_param("iiisi", $amulet_sell_id, $user_id, $orderamulet_qty, $orderamulet_date, $seller_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Order placed successfully
        echo "<script>
        Swal.fire({
            title: 'Success!',
            text: 'Order placed successfully.',
            icon: 'success',
            showConfirmButton: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'success.php'; // Redirect to success page
            }
        });
        </script>";
        // Redirect to user activity page
        header('Location: user_activity.php');
        exit(); // Stop further execution
    } else {
        // Display an error message
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();

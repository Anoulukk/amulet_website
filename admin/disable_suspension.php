<?php
include("../config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $suspension_id = intval($_POST['suspension_id']);
    $seller_id = intval($_POST['seller_id']);

    // Update the suspension status to 'disabled' for all records with the same seller_id
    $updateSuspensionQuery = "UPDATE suspensionlist SET suspension_status = 'disabled' WHERE seller_id = ?";
    $stmt1 = $conn->prepare($updateSuspensionQuery);
    $stmt1->bind_param("i", $seller_id);

    // Update the seller's active status to 'false'
    $updateSellerQuery = "UPDATE user SET active = 'false' WHERE user_id = (SELECT user_id FROM seller WHERE seller_id = ?)";
    $stmt2 = $conn->prepare($updateSellerQuery);
    $stmt2->bind_param("i", $seller_id);

    if ($stmt1->execute() && $stmt2->execute()) {
        echo "ອັບເດດສະຖານະສຳເລັດ.";
    } else {
        echo "Error updating status: " . $conn->error;
    }

    $stmt1->close();
    $stmt2->close();
    $conn->close();
}
?>

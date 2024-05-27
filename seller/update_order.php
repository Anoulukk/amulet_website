<?php
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orderId = $_POST['order_id'];
    $userId = $_POST['user_id'];

    // Get amulet_sell_id for the clicked order
    $amuletSellIdSql = "SELECT amulet_sell_id FROM orderamulet WHERE orderamulet_id = $orderId";
    $amuletSellIdResult = $conn->query($amuletSellIdSql);
    $amuletSellIdRow = $amuletSellIdResult->fetch_assoc();
    $amuletSellId = $amuletSellIdRow['amulet_sell_id'];

    // Update new_owner_amulet in the orderamulet table for all orders with the same amulet_sell_id
    $updateSql = "UPDATE orderamulet SET new_owner_amulet = $userId WHERE amulet_sell_id = $amuletSellId";

    if ($conn->query($updateSql) === TRUE) {
        echo "Records updated successfully";
    } else {
        echo "Error updating records: " . $conn->error;
    }
}
?>

<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reportDetail = mysqli_real_escape_string($conn, $_POST['reportDetail']);
    $reporter_id = intval($_POST['reporter_id']);
    $seller_id = intval($_POST['seller_id']);
    $suspensionStatus = 'waiting'; // Default status

    $sql = "INSERT INTO suspensionlist (feedback_detail, suspension_status, reporter_id, seller_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $reportDetail, $suspensionStatus, $reporter_id, $seller_id);

    if ($stmt->execute()) {
        echo "Report submitted successfully.";
        header("Location: store.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

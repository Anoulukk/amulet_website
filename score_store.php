<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rateScore = intval($_POST['scoreNumber']);
    $rateDetail = mysqli_real_escape_string($conn, $_POST['scoreDetail']);
    $rater_id = intval($_POST['rater_id']);
    $receiver_id = intval($_POST['receiver_id']);

    // Prepare and bind
    $sql = "INSERT INTO rate (rate_score, rate_detail, rater_id, receiver_id, rate_date) VALUES (?, ?, ?, ?, CURDATE())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isii", $rateScore, $rateDetail, $rater_id, $receiver_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Rating submitted successfully.";
        header("Location: store.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

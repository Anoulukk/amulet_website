<?php
include('header.php');
include('../config.php');

// Check if the user is logged in and user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    // If user_id is not set, redirect to the login page
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch the seller_id using the user_id
$sellerQuery = "SELECT seller_id FROM seller WHERE user_id = $userId";
$sellerResult = mysqli_query($conn, $sellerQuery);
if (mysqli_num_rows($sellerResult) > 0) {
    $sellerRow = mysqli_fetch_assoc($sellerResult);
    $sellerId = $sellerRow['seller_id'];
} else {
    // If seller_id is not found, handle the error (e.g., redirect or display an error message)
    echo "Seller not found.";
    exit();
}

// Fetch feedback where receiver_id matches the seller_id
$feedbackQuery = "SELECT r.rate_score, r.rate_date, r.rate_detail, r.rater_id, r.receiver_id, u.username, u.lastname
                  FROM rate r
                  JOIN user u ON r.rater_id = u.user_id
                  WHERE r.receiver_id = $sellerId";
$feedbackResult = $conn->query($feedbackQuery);

$feedbackData = [];
if ($feedbackResult->num_rows > 0) {
    while ($row = $feedbackResult->fetch_assoc()) {
        $feedbackData[] = [
            'name' => $row['username'] . ' ' . $row['lastname'],
            'score' => $row['rate_score'],
            'detail' => $row['rate_detail'],
            'date' => $row['rate_date']
        ];
    }
}

// Fetch suspension details where seller_id matches the seller_id
$suspensionQuery = "SELECT s.suspension_id, s.feedback_detail, s.feedback_date, s.suspension_status, 
                    u.username AS reporter_username, u.lastname AS reporter_lastname
                    FROM suspensionlist s
                    JOIN user u ON s.reporter_id = u.user_id
                    WHERE s.seller_id = $sellerId";
$suspensionResult = $conn->query($suspensionQuery);

$suspensionData = [];
if ($suspensionResult->num_rows > 0) {
    while ($row = $suspensionResult->fetch_assoc()) {
        $suspensionData[] = [
            'suspension_id' => $row['suspension_id'],
            'detail' => $row['feedback_detail'],
            'date' => $row['feedback_date'],
            'status' => $row['suspension_status'],
            'reporter_name' => $row['reporter_username'] . ' ' . $row['reporter_lastname']
        ];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback and Suspension Details</title>
    <style>
        .feedback-card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            position: relative;
            background-color: #f0f0f0;
            width: calc(50% - 20px);
            float: left;
            margin-right: 20px;
        }

        .feedback-card:nth-child(2n) {
            margin-right: 0;
        }

        .feedback-card p {
            margin: 5px 0;
        }

        .feedback-card strong {
            font-weight: bold;
        }

        .feedback-card .date {
            position: absolute;
            top: 5px;
            right: 5px;
            font-size: 15px;
            color: #000;
        }

        .suspension-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .suspension-table th, .suspension-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .suspension-table th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>

<body>

    <div class="container col-8">
        <h2>ລາຍງານຈາກລູກຄ້າ</h2>
        <h4>ລີວີວຮ້ານຄ້າ: <span class="text-primary" id="summaryScore"></span> ຄະແນນ</h4>

        <div id="feedbackList">
            <?php
                $totalScore = 0;
                $feedbackCount = count($feedbackData);
                foreach ($feedbackData as $feedback) {
                    $totalScore += $feedback['score'];
                    echo '<div class="feedback-card">';
                    echo '<p><span class="date mt-3">ວັນທີ ' . $feedback['date'] . '</span></p>';
                    echo '<p><strong>ຊື່:</strong> ' . $feedback['name'] . '</p>';
                    echo '<p><strong>ຄະແນນ:</strong> ' . $feedback['score'] . ' Stars</p>';
                    echo '<p><strong>ລາຍລະອຽດ:</strong> ' . $feedback['detail'] . '</p>';
                    echo '</div>';
                }

                $averageScore = $feedbackCount > 0 ? $totalScore / $feedbackCount : 0;
            ?>
        </div>

        <h2>ລາຍລະອຽດການຖືກລາຍງານ</h2>
        <table class="suspension-table">
            <thead>
                <tr>
                    <th>ລຳດັບ</th>
                    <th>ລາຍລະອຽດ</th>
                    <th>ວັນທີ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $index = 1;
                foreach ($suspensionData as $suspension) {
                    echo '<tr>';
                    echo "<td scope='row'>" . $index++ . "</td>";
                    echo '<td>' . htmlspecialchars($suspension['detail']) . '</td>';
                    echo '<td>' . htmlspecialchars(date('Y-m-d', strtotime($suspension['date']))) . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('summaryScore').textContent = "<?php echo number_format($averageScore, 1); ?>";
    </script>
</body>

</html>

<?php
// fetch_feedback.php
include('../config.php');

$sql = "SELECT r.rate_score, r.rate_date, r.rate_detail, r.rater_id, r.receiver_id, u.username, u.lastname
        FROM rate r
        JOIN user u ON r.rater_id = u.user_id";
$result = $conn->query($sql);

$feedbackData = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $feedbackData[] = [
            'name' => $row['username'] . ' ' . $row['lastname'],
            'score' => $row['rate_score'],
            'detail' => $row['rate_detail'],
            'date' => $row['rate_date']
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
    <title>Feedback and Score</title>
    <style>
        .feedback-card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            position: relative;
            background-color: #f0f0f0;
            width: calc(50% - 20px); /* Adjust the width here */
            float: left;
            margin-right: 20px; /* Adjust the margin between cards */
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
    </style>
</head>

<body>
    <?php include('header.php'); ?>

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
    </div>

    <script>
        document.getElementById('summaryScore').textContent = "<?php echo number_format($averageScore, 1); ?>";
    </script>
</body>

</html>

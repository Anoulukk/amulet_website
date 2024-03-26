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
        <h4>ລີວີວຮ້ານຄ້າ: <span id="summaryScore"></span> ຄະແນນ</h4>

        <div id="feedbackList">
            <!-- Feedback items will be dynamically inserted here -->
        </div>
    </div>

    <script>
        // Sample feedback data (you can replace this with your actual data)
        var feedbackData = [
            { name: "ມີໄຊ", score: 5, date: "2024-03-25" },
            { name: "ຈັນທິພອນ", score: 4, date: "2024-03-24" },
            { name: "ມີໄຊ", score: 5, date: "2024-03-25" },
            { name: "ຈັນທິພອນ", score: 4, date: "2024-03-24" },
            { name: "ມີໄຊ", score: 5, date: "2024-03-25" },
            { name: "ຈັນທິພອນ", score: 4, date: "2024-03-24" },
            // Add more feedback items as needed
        ];

        // Calculate summary score
        var totalScore = feedbackData.reduce(function(acc, feedback) {
            return acc + feedback.score;
        }, 0);
        var averageScore = totalScore / feedbackData.length;
        document.getElementById('summaryScore').textContent = averageScore.toFixed(1);

        // Display feedback items
        var feedbackList = document.getElementById('feedbackList');
        feedbackData.forEach(function(feedback) {
            var feedbackItem = document.createElement('div');
            feedbackItem.classList.add('feedback-card');
            feedbackItem.innerHTML = `<p><span class="date mt-3">ວັນທີ ${feedback.date}</span></p>
                                      <p><strong>ຊື່:</strong> ${feedback.name}</p>
                                      <p><strong>ຄະແນນ:</strong> ${feedback.score} Stars</p>`;
            feedbackList.appendChild(feedbackItem);
        });
    </script>
</body>

</html>

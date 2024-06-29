<?php
// Start the session
include("config.php");
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
$reporter_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

// SQL query to fetch data from the seller table and calculate the average rating, sorted by avg_score
$sql = "SELECT s.*, IFNULL(AVG(r.rate_score), 0) as avg_score 
        FROM seller s
        LEFT JOIN rate r ON s.seller_id = r.receiver_id
        GROUP BY s.seller_id
        ORDER BY avg_score DESC";
$result = $conn->query($sql);

// Check for SQL errors
if (!$result) {
    die("Error in SQL query: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="sweetalert2@11.js"></script>
    <style>
        .stars {
            font-size: 25px;
            color: #ccc;
        }
        .stars.filled {
            color: gold;
        }
    </style>
</head>

<body>
    <?php include('header.php'); ?>
    <div class="container" style="height: 65.5vh;">
        <div class="row">
            <div class="col"></div>
            <div class="col-8" style="margin-top: 20px"></div>
            <div class="col"></div>
        </div>
        <div class="row">
            <div class="col"></div>
            <div class="col-12 box">
                <?php
                // Check if there are rows returned from the query
                if ($result->num_rows > 0) {
                    // Loop through each row of the result set
                    while ($row = $result->fetch_assoc()) {
                        $avg_score = round($row['avg_score']);
                        echo '<div class="col-2 text-center store-box">';
                        echo '<a href="store_detail.php?seller_id=' . $row["seller_id"] . '&user_id=' . $reporter_id . '">';
                        echo '<img class="market-img" src="./img/amulet_pre.png" alt="">';
                        echo '</a>';
                        echo '<div class="store-details">';
                        echo '<h6>' . $row["store_name"] . '</h6>';
                        echo '<div class="rating" data-store-id="' . $row["seller_id"] . '">';
                        for ($i = 1; $i <= 5; $i++) {
                            $filled = $i <= $avg_score ? 'filled' : '';
                            echo '<span class="stars ' . $filled . '">★</span>';
                        }
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>No sellers found</p>";
                }
                ?>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>
<?php include('footer.php'); ?>
</html>

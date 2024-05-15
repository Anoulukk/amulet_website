<?php
// Start the session
include("config.php");
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;



// SQL query to fetch data from the seller table
$sql = "SELECT * FROM seller";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="sweetalert2@11.js"></script>

</head>

<body>
    <?php include('header.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col">
            </div>
            <div class="col-8" style="margin-top: 20px">
                
            </div>

            <div class="col">
            </div>
        </div>
        <div class="row">
            <div class="col">
            </div>

            <div class="col-12 box">
            <?php
                // Check if there are rows returned from the query
                if ($result->num_rows > 0) {
                    // Loop through each row of the result set
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="col-2 text-center store-box">';
                        echo '<a href="store_detail.php">';
                        echo '<img class="market-img" src="./img/store.jpeg" alt="">';
                        echo '</a>';
                        echo '<div class="store-details">';
                        echo '<h6>' . $row["store_name"] . '</h6>';
                        echo '<div class="rating" data-store-id="' . $row["seller_id"] . '">';
                        for ($i = 1; $i <= 5; $i++) {
                            echo '<span class="star" data-rating="' . $i . '">★</span>';
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
</body><br>
<?php include('footer.php') ?>

</html>
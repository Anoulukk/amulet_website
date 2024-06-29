<?php
// Start the session
include("config.php");
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

// Fetch history data from the database
$sql = "SELECT * FROM history";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include('header.php'); ?>
    <div class="container justify-content-center align-items-center mb-5 mt-3">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="row">
                    <div class="col-3">
                        <?php
                        echo '<img src="../amulet_website/owner/' . $row["amulet_his_img1"] . '" alt="Image 1" width="300px" class="mb-3 mt-5">';
                        echo '<img src="../amulet_website/owner/' . $row["amulet_his_img2"] . '" alt="Image 2" width="300px" class="mb-3">';
                        echo '<img src="../amulet_website/owner/' . $row["amulet_his_img3"] . '" alt="Image 3" width="300px" class="mb-3">';
                        ?>
                    </div>
                    <div class="col-8">
                        <?php
                        echo '<h3 class="text-left"><b>' . $row["history_title"] . '</b></h3>';
                        echo '<h6 class="text-left"><b>' . $row["created_temple"] . '</b></h6>';
                        echo '<p>' . $row["amulet_his_detail"] . '</p>';
                        $formatted_date = date("Y-m-d", strtotime($row["created_date"]));
                        echo '<p class="text-left fw-bold">ວັນທິສ້າງ: ' . $formatted_date . '</p>';
                        echo '<p class="text-left fw-bold">ສ້າງທີ່ວັດ: ' . $row["created_temple"] . '</p>';
                        ?>
                    </div>
                </div>
                <hr>
            <?php }
        } else {
            echo '<p>No history found.</p>';
        }
        ?>
    </div>

    <?php include('footer.php'); ?>
</body>

</html>

<?php
// Close connection
mysqli_close($conn);
?>

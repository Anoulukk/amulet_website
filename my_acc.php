<?php
// Start the session
include("config.php");
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

// Check if the user is logged in
if ($role === "user") {
    // Retrieve the username from the session
    $username = $_SESSION['username'];
    $lastname = $_SESSION['lastname'];
    $tel = $_SESSION['tel'];
    $status = $_SESSION['active'];
    if ($status == "true") {
        $status="Approved";
    }else{
        $status="Pending";
    }
    // Query to check if the user has an active status
    $query = "SELECT * FROM user WHERE username = '$username' AND active = 'false'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        include("account_inactive.php");
        exit(); // Stop further execution of the script
    } else {
        // User is logged in but does not have an active status
        include("account_approved.php");
        exit(); // Stop further execution of the script
    }
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my account</title>
</head>

<body>
    <?php include('header.php'); ?>

    <div class="container col-8 text-center mt-3">
        <h2 class="">ຍັງບໍ່ທັນລົງທະບຽນ</h2>

        <div class="card">
            <div class="card-header text-center">
                <h3>ຂໍ້ມູນສ່ວນຕົວ</h3>

            </div>
            <div class="card-body">
                <p class="form-label">ຊື່: <span><b></b> </span></p>
                <p class="form-label">ນາມສະກຸນ: <span><b></b> </span></p>
                <p class="form-label">ເບີໂທ: <span><b></b> </span></p>
                <p class="form-label">ສະຖານະ: <span><b></b> </span></p>


                <div class="form-group text-center mt-3">
                    <a href="logout.php" class="btn btn-warning">ອອກຈາກລະບົບ</a>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
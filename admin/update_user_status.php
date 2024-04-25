<?php
include('../config.php');

// Check if user_id is set in the POST request
if (isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    $adminId = $_POST['admin_id'];
    $role = $_POST['role'];
    echo($role);
    // Update user table to set active to true
    $updateUserSql = "UPDATE user SET active = 'true', admin_id = '$adminId', status = '$role' WHERE user_id = '$userId'";


    $updateUserResult = mysqli_query($conn, $updateUserSql);

    // Update register table to set status to Active
    $updateRegisterSql = "UPDATE register SET status = 'Active' WHERE user_id = '$userId'";
    $updateRegisterResult = mysqli_query($conn, $updateRegisterSql);

    // Check if both updates were successful
    if ($updateUserResult && $updateRegisterResult) {
        // Close the database connection
        mysqli_close($conn);

        // Redirect back to the page where the form was submitted from
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        // Handle the case where one or both updates failed
        echo "Error updating database.";
    }
} else {
    // Handle the case where user_id is not set
    echo "User ID not set.";
}
?>
//update seller status
$update_sql = "UPDATE `user` SET status = 'seller' WHERE user_id = '$userId'";
mysqli_query($conn, $update_sql);
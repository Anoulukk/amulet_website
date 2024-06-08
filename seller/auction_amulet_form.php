<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller management</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<style>
    /* Style for the date picker */
    .date-picker {

        padding: 8px;
        /* Adjust padding as needed */
        border: 1px solid #ccc;
        /* Add a border */
        border-radius: 5px;
        /* Add border radius */
        outline: none;
        /* Remove default focus outline */
        font-size: 14px;
        /* Adjust font size */
        width: 480px;
    }

    /* Optional: Style for when the input is focused */
    .date-picker:focus {
        border-color: #007bff;
        /* Change border color on focus */
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        /* Add a shadow on focus */
    }
</style>

<body>
    <?php include('header.php'); ?>
    <?php include('../config.php'); ?>
    <div class="container col-8">
        <h4 class="mt-3 mb-3">ຟອມເປີດປະມູນພຣະເຄື່ອງ</h4>

        <form method="post" enctype="multipart/form-data">
    <div class="form-group mt-3">
        <label for="amulet_name">ຊື່ພຣະເຄື່ອງ</label>
        <input type="text" class="form-control" id="amulet_name" name="amulet_name" required>
    </div>
    <div class="form-group">
        <label for="amulet_details">ລາຍລະອຽດ</label>
        <textarea class="form-control" id="amulet_details" name="amulet_details" required></textarea>
    </div>
    <div class="form-group mt-3">
        <label for="count_days">ຈຳນວນມື້ທີ່ທ່ານຈະປະມູນ</label><br>
        <input type="number" class="form-control" id="count_days" name="count_days" required>
    </div>
    <div class="form-group mt-2">
        <label for="start_bid">ລາຄາເປີດປະມູນ (ກີບ)</label>
        <input type="number" class="form-control" style="width: 480px;" id="start_bid" name="start_bid" required>
    </div>
    <div class="form-group mt-2">
        <label for="minimum_bid">ເຄາະຂັ້ນຕ່ຳລາຄາ (ກີບ)</label>
        <input type="number" class="form-control" style="width: 480px;" id="minimum_bid" name="minimum_bid" required>
    </div>

    <div class="form-group mt-3">
        <label class="form-label">ເລືອກຮູບພາບພຣະເຄື່ອງຂອງທ່ານ</label>
        <input type="file" class="form-control" id="customFile1" name="image1" accept="image/*" required>
    </div>

    <button type="submit" class="btn btn-warning mt-3" name="submit">ຢືນຢັນ</button>
</form>

    </div>

    <?php
if(isset($_POST['submit'])) {
    $amuletName = $_POST['amulet_name'];
    $amuletDetails = $_POST['amulet_details'];
    $countDays = $_POST['count_days'];
    $startBid = $_POST['start_bid'];
    $minimumBid = $_POST['minimum_bid'];
    $userId = $_SESSION['user_id']; // Retrieve user ID from session
    
    // Query to retrieve seller ID based on user ID
    $sellerIdQuery = "SELECT seller_id FROM seller WHERE user_id = '$userId'";

    // Execute the query
    $sellerIdResult = mysqli_query($conn, $sellerIdQuery);

    // Check if the query was successful
    if($sellerIdResult) {
        // Fetch the seller ID from the result
        $row = mysqli_fetch_assoc($sellerIdResult);
        $sellerId = $row['seller_id'];
    // File upload handling
    if(isset($_FILES["image1"]) && $_FILES["image1"]["size"] > 0) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES["image1"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        if(move_uploaded_file($_FILES["image1"]["tmp_name"], $targetFilePath)) {
            // Insert data into database
            // Adjust your database query accordingly
            $sql = "INSERT INTO auction (amulet_auction_name, amulet_auction_detail, auction_status, countdown_days, start_bid, minimum_bid, amulet_auction_img, seller_id) 
                    VALUES ('$amuletName', '$amuletDetails', 'ກຳລັງປະມູນ', '$countDays', '$startBid', '$minimumBid', '$targetFilePath', '$sellerId')";
            // Execute the query4
            if(mysqli_query($conn, $sql)){
                echo "Records inserted successfully.";
            } else{
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    }
}
?>

</body>

</html>
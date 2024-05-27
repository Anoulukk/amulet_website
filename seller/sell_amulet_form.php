<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller management</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <?php include('header.php'); ?>
    <?php include('../config.php'); ?>

    <div class="container col-8">
    <h4 class="mt-3 mb-3">ຟອມເປີດຂາຍພຣະເຄື່ອງ</h4>

        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="amulet_name">ຊື່ພຣະເຄື່ອງ</label>
                <input type="text" class="form-control" id="amulet_name" name="amulet_name" required>
            </div>
            <div class="form-group">
                <label for="amulet_details">ລາຍລະອຽດ</label>
                <textarea class="form-control" name="amulet_details" id="amulet_details" required></textarea>
            </div>
                <div>
                    <p class="mt-2">ສະຖານະ</p>
                    <div class="d-flex">

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="amulet_status" id="exampleRadios1" value="ForSale" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                ພ້ອມເຊົ່າ
                            </label>
                        </div>
                        <div class="form-check ms-3">
                            <input class="form-check-input" type="radio" name="amulet_status" id="exampleRadios2" value="ForShow">
                            <label class="form-check-label" for="exampleRadios2">
                                ພຣະໂຊ
                            </label>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="mt-2 ">ເລືອກໝວດໝູ່ພຣະເຄື່ອງ</p>
                    <select class="form-control" style="width: 400px;" id="amulet_group" name="amulet_group">
                        <option>ພຣະຫຼຽນ</option>
                        <option>ພຣະບູຊາ</option>
                        <option>ພຣະກິ່ງ</option>
                        <option>ຕະກຸດ</option>
                        <option>ຜ້າຍັນ</option>
                        <option>ອົງລອຍ</option>
                        <option>ພຣະເນື້ອຜົງ</option>
                    </select>
                </div>


            <div class="form-group mt-2">
                <label for="amulet_price">ລາຄາ</label>
                <div class="d-flex">
                    <input type="number" class="form-control me-3" style="width: 500px;" id="amulet_price" name="amulet_price" required>
                    <h6 class="mt-2">ກີບ</h6>
                </div>
            </div>

            <label class="form-label mt-3">ເລືອກຮູບພາບພຣະເຄື່ອງຂອງທ່ານ</label>
            <div class="d-flex">

                <div class="me-3">
                    <input type="file" class="form-control" id="customFile1" name="image1" accept="image/*" />
                </div>
                
            </div>


            <button type="submit" class="btn btn-warning mt-3" name="submit">ຢືນຢັນ</button>
        </form>
    </div>



    <?php
// Check if user ID is set in the session
if(isset($_SESSION['user_id'])) {
    // Retrieve user ID
    $userId = $_SESSION['user_id'];

    // Database connection assuming you've already established it

    // Query to retrieve seller ID based on user ID
    $sellerIdQuery = "SELECT seller_id FROM seller WHERE user_id = '$userId'";

    // Execute the query
    $sellerIdResult = mysqli_query($conn, $sellerIdQuery);

    // Check if the query was successful
    if($sellerIdResult) {
        // Fetch the seller ID from the result
        $row = mysqli_fetch_assoc($sellerIdResult);
        $sellerId = $row['seller_id'];

        // Handle form submission
        if(isset($_POST['submit'])) {
            // Retrieve form data
            $amuletName = $_POST['amulet_name'];
            $amuletDetails = $_POST['amulet_details'];
            $amuletPrice = $_POST['amulet_price'];
            $amuletStatus = $_POST['amulet_status'];
            $amuletGroup = $_POST['amulet_group'];
            // File upload handling
            if ($_FILES["image1"]["size"] > 0) {
                $targetDir = "uploads/";
                $fileName = basename($_FILES["image1"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                if (move_uploaded_file($_FILES["image1"]["tmp_name"], $targetFilePath)) {
                    // Insert data into database
                    $sql = "INSERT INTO amuletsell (seller_id, amulet_sell_name, amulet_sell_detail, amulet_sell_price, amulet_sell_img, amulet_sell_status, amuletGroup) 
                            VALUES ('$sellerId', '$amuletName', '$amuletDetails', '$amuletPrice', '$targetFilePath', '$amuletStatus', '$amuletGroup')";
                    if(mysqli_query($conn, $sql)){
                        echo "Records inserted successfully.";
                        header("Location: seller/index.php");

                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    } else {
        echo "Failed to retrieve seller ID.";
    }
} else {
    echo "User ID not found in session.";
}
?>

</body>

</html>
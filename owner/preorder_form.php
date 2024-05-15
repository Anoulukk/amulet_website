<?php
// Start the session
session_start();

if (!isset($_SESSION['logged_in']) && $_SESSION['role'] !== "owner") {
    header("Location: ../login.php");
} 
?>
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
        <h4 class="mt-3 mb-3">ຟອມເປີດຈອງພຣະເຄື່ອງ</h4>

        <form method="post" enctype="multipart/form-data">
            <div class="form-group mb-2">
                <label for="amulet_name">ຊື່ລຸ້ນ</label>
                <input type="text" class="form-control" id="preorder_amulet_name" name="preorder_amulet_name" required>
            </div>
            <div class="form-group">
                <label for="amulet_details">ລາຍລະອຽດ (ປະຫວັດຄວາມເປັນມາ)</label>
                <textarea class="form-control" name="preorder_detail" id="preorder_detail" required></textarea>
            </div>
            <h5 class="form-label mt-3">1. ເນື້ອທອງຄຳ</h5>
            <label for="type1">ສ້າງທັງໝົດ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-25" id="gold_group" max="10"  >
            <label for="type1">ອົງ</label>
            <label for="price" class="ms-5">ລາຄາ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-50" id="price">

            <h5 class="form-label mt-3">2. ເນື້ອເງີນໜ້າກາກຄຳ</h5>
            <label for="type1">ສ້າງທັງໝົດ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-25" id="silver_gold_group" name="silver_gold_group" max="25" >
            <label for="type1">ອົງ</label>
            <label for="price" class="ms-5">ລາຄາ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-50" id="price">

            <h5 class="form-label mt-3">3. ເນື້ອເງີນ</h5>
            <label for="type1">ສ້າງທັງໝົດ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-25" id="silver_group" name="silver_group" max="30" >
            <label for="type1">ອົງ</label>
            <label for="price" class="ms-5">ລາຄາ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-50" id="price">
            
            <h5 class="form-label mt-3">4. ຊຸດກຳມະການ</h5>
            <label for="type1">ສ້າງທັງໝົດ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-25" id="director_group" name="director_group" max="10" >
            <label for="type1">ອົງ</label>
            <label for="price" class="ms-5">ລາຄາ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-50" id="price">

            <h5 class="form-label mt-3">5. ອົງບູຊາຂະໜາດ 9 ນິ້ວ</h5>
            <label for="type1">ສ້າງທັງໝົດ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-25" id="buddha_9_group" name="buddha_9_group" max="10" >
            <label for="type1">ອົງ</label>
            <label for="price" class="ms-5">ລາຄາ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-50" id="price">

            <h5 class="form-label mt-3">6. ອົງບູຊາຂະໜາດ 5 ນິ້ວ</h5>
            <label for="type1">ສ້າງທັງໝົດ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-25" id="buddha_5_group" name="buddha_5_group" max="10" >
            <label for="type1">ອົງ</label>
            <label for="price" class="ms-5">ລາຄາ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-50" id="price">

            <h5 class="form-label mt-3">7. ລຸ້ນເນື້ອ</h5>
            <label for="type1">ສ້າງທັງໝົດ</label>
            <input type="number" class="border rounded p-1 mb-3 w-25" id="random" name="random" max="300">
            <label for="type1">ອົງ</label>
            <label for="price" class="ms-5">ລາຄາ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-50" id="price">



            
            <h5 class="form-label mt-3">ເລືອກຮູບພາບຕົວຢ່າງຫຼຽນ</h5>
            <div class="d-flex">

                <div class="me-3">
                    <label for="customFile1" class="form-label">ຮູບທີ 1</label>
                    <input type="file" class="form-control" id="customFile1" name="amulet_pre_img1" accept="image/*" />
                </div>
                <div class="me-3">
                    <label for="customFile2" class="form-label">ຮູບທີ 2</label>
                    <input type="file" class="form-control" id="customFile2" name="amulet_pre_img2" accept="image/*" />
                </div>
                <div class="me-3">
                    <label for="customFile3" class="form-label">ຮູບທີ 3</label>
                    <input type="file" class="form-control" id="customFile3" name="amulet_pre_img3" accept="image/*" />
                </div>
                <div class="me-3">
                    <label for="customFile4" class="form-label">ຮູບທີ 4</label>
                    <input type="file" class="form-control" id="customFile4" name="amulet_pre_img4" accept="image/*" />
                </div>
                <div class="me-3">
                    <label for="customFile5" class="form-label">ຮູບທີ 5</label>
                    <input type="file" class="form-control" id="customFile5" name="amulet_pre_img5" accept="image/*" />
                </div>
            </div>


            <button type="submit" class="btn btn-warning mt-5 mb-5">ຢືນຢັນ</button>
        </form>
    </div>

    <?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $amulet_name = mysqli_real_escape_string($conn, $_POST['preorder_amulet_name']);
    $preorder_detail = mysqli_real_escape_string($conn, $_POST['preorder_detail']);
    // Similarly, escape other form inputs...

    // Image upload directory
    $target_dir = "uploads/";

    // Function to upload image and return the uploaded file path
    function uploadImage($file, $target_dir) {
        $target_file = $target_dir . basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($file["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($file["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                return $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        return "";
    }

    // Upload each image and get their paths
    $amulet_pre_img1_path = uploadImage($_FILES["amulet_pre_img1"], $target_dir);
    $amulet_pre_img2_path = uploadImage($_FILES["amulet_pre_img2"], $target_dir);
    $amulet_pre_img3_path = uploadImage($_FILES["amulet_pre_img3"], $target_dir);
    $amulet_pre_img4_path = uploadImage($_FILES["amulet_pre_img4"], $target_dir);
    $amulet_pre_img5_path = uploadImage($_FILES["amulet_pre_img5"], $target_dir);
    $goldGroup = $_POST['gold_group'];
    $silverGoldGroup = $_POST['silver_gold_group'];
    $silverGroup = $_POST['silver_group'];
    $directorGroup = $_POST['director_group'];
    $buddha9Group = $_POST['buddha_9_group'];
    // You may want to do similar for other fields like amulet name and details

    // Construct SQL query
    $sql1 = "INSERT INTO preorderdetails (preorder_id, amulet_pre_id, amulet_pre_name, amulet_pre_group, amulet_pre_price, totalquantity)
            VALUES ('$preorderId', '$amuletPreId', '$amuletPreName', '$amuletPreGroup', '$amuletPrePrice', '$totalQuantity')";

    // Execute SQL query
    if (mysqli_query($conn, $sql1)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
    }
    // Insert query
    $sql2 = "INSERT INTO preorder (preorder_amulet_name, preorder_detail, preorder_status, amulet_pre_img1, amulet_pre_img2, amulet_pre_img3, amulet_pre_img4, amulet_pre_img5)
            VALUES ('$amulet_name', '$preorder_detail', 'open', '$amulet_pre_img1_path', '$amulet_pre_img2_path', '$amulet_pre_img3_path', '$amulet_pre_img4_path', '$amulet_pre_img5_path')";

    if (mysqli_query($conn, $sql2)) {
        // Display a success message
        echo '<script>console.log("Data inserted successfully!")</script>';
    } else {
        // Display an error message
        echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
    }
}
// Close connection
mysqli_close($conn);
?>


</body>
<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        var fileInputs = document.querySelectorAll('input[type="file"]');
        var isEmpty = false;
        
        fileInputs.forEach(function(input) {
            if (input.files.length === 0) {
                isEmpty = true;
            }
        });

        if (isEmpty) {
            event.preventDefault();
            alert('ກະລຸນາເລືອກຮູບພາບຕົວຢ່າງຫຼຽນໃຫ້ຄົບ ແລະ ບໍ່ຊ້ຳກັນ');
        }
    });
    
</script>

</html>
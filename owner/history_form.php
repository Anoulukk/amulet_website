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
        <h4 class="mt-3 mb-3">ຟອມສ້າງປະຫວັດພຣະເຄື່ອງ</h4>

        <form method="post" enctype="multipart/form-data">
            <div class="form-group mb-2">
                <label for="amulet_name">ຊື່ຫົວຂໍ້</label>
                <input type="text" class="form-control" name="history_title" required>
            </div>
            <div class="form-group">
                <label for="amulet_details">ລາຍລະອຽດ (ປະຫວັດຄວາມເປັນມາ)</label>
                <textarea class="form-control" name="amulet_his_detail" rows="10" required></textarea>
            </div>
            <div class="d-flex">
                <div>
                    <h5 class="form-label mt-3">ມື້ທີ່ສ້າງພຣະເຄື່ອງ</h5>
                    <input type="date" class="form-control" name="created_date">
                </div>
                <div class="ms-5">
                    <h5 class="form-label mt-3">ຊື່ວັດທີ່ສ້າງ</h5>
                    <input type="text" class="form-control" style="width: 50vw;" name="created_temple">
                </div>
            </div>

            <h5 class="form-label mt-3">ເລືອກຮູບພາບ</h5>
            <div class="d-flex">
                <div class="me-3">
                    <label for="customFile1" class="form-label">ຮູບທີ 1</label>
                    <input type="file" class="form-control" id="customFile1" name="amulet_his_img1" accept="image/*" />
                </div>
                <div class="me-3">
                    <label for="customFile2" class="form-label">ຮູບທີ 2</label>
                    <input type="file" class="form-control" id="customFile2" name="amulet_his_img2" accept="image/*" />
                </div>
                <div class="me-3">
                    <label for="customFile3" class="form-label">ຮູບທີ 3</label>
                    <input type="file" class="form-control" id="customFile3" name="amulet_his_img3" accept="image/*" />
                </div>
            </div>

            <button type="submit" class="btn btn-warning mt-5 mb-5">ຢືນຢັນ</button>
        </form>
    </div>

    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Escape user inputs for security
        $history_title = mysqli_real_escape_string($conn, $_POST['history_title']);
        $amulet_his_detail = mysqli_real_escape_string($conn, $_POST['amulet_his_detail']);
        $created_date = mysqli_real_escape_string($conn, $_POST['created_date']);
        $created_temple = mysqli_real_escape_string($conn, $_POST['created_temple']);

        // Image upload directory
        $target_dir = "uploads/";

        // Function to upload image and return the uploaded file path
        function uploadImage($file, $target_dir)
        {
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
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
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
        $amulet_his_img1_path = uploadImage($_FILES["amulet_his_img1"], $target_dir);
        $amulet_his_img2_path = uploadImage($_FILES["amulet_his_img2"], $target_dir);
        $amulet_his_img3_path = uploadImage($_FILES["amulet_his_img3"], $target_dir);

        // Construct SQL query
        $sql = "INSERT INTO history (history_title, amulet_his_detail, amulet_his_img1, amulet_his_img2, amulet_his_img3, created_date, created_temple)
                VALUES ('$history_title', '$amulet_his_detail', '$amulet_his_img1_path', '$amulet_his_img2_path', '$amulet_his_img3_path', '$created_date', '$created_temple')";

        // Execute SQL query
        if (mysqli_query($conn, $sql)) {
            echo '<script>
            Swal.fire({
                title: "Success",
                text: "Data inserted successfully!",
                icon: "success"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "index.php";
                }
            });
          </script>';

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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

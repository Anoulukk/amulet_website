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
    <div class="container col-8">
        <h4 class="mt-3 mb-3">ຟອມເປີດຈອງພຣະເຄື່ອງ</h4>

        <form method="post" enctype="multipart/form-data" id="preorderForm">
            <div class="form-group mb-2">
                <label for="preorder_amulet_name">ຊື່ລຸ້ນ</label>
                <input type="text" class="form-control" id="preorder_amulet_name" name="preorder_amulet_name" required >
            </div>
            <div class="form-group">
                <label for="preorder_detail">ລາຍລະອຽດ (ປະຫວັດຄວາມເປັນມາ)</label>
                <textarea class="form-control" name="preorder_detail" id="preorder_detail" required></textarea>
            </div>

            <!-- Form fields for different amulets -->
            <?php
            $amulets = [
                ['id' => 'gold_group', 'name' => 'ເນື້ອທອງຄຳ'],
                ['id' => 'silver_group', 'name' => 'ເນື້ອເງີນ'],
                ['id' => 'director_group', 'name' => 'ຊຸດກຳມະການ'],
                ['id' => 'buddha_9_group', 'name' => 'ອົງບູຊາຂະໜາດ 9 ນິ້ວ'],
                ['id' => 'buddha_5_group', 'name' => 'ອົງບູຊາຂະໜາດ 5 ນິ້ວ'],
                ['id' => 'random', 'name' => 'ລຸ້ນເນື້ອ']
            ];
            foreach ($amulets as $amulet) {
                echo "
                <h5 class='form-label mt-3'>{$amulet['name']}</h5>
                <label for='{$amulet['id']}'>ສ້າງທັງໝົດ</label>
                <input type='number' class='border rounded p-1 mb-3 type-input w-25' id='{$amulet['id']}' name='{$amulet['id']}_total' required >
                <label for='{$amulet['id']}'>ອົງ</label>
                <label for='price' class='ms-5'>ລາຄາ</label>
                <input type='number' class='border rounded p-1 mb-3 type-input w-50' id='{$amulet['id']}_price' name='{$amulet['id']}_price' step='100000' >
                ";
            }
            ?>

            <h5 class="form-label mt-3">ເລືອກຮູບພາບຕົວຢ່າງຫຼຽນ</h5>
            <div class="d-flex">
                <?php for ($i = 1; $i <= 5; $i++) : ?>
                    <div class="me-3">
                        <label for="customFile<?= $i ?>" class="form-label">ຮູບທີ <?= $i ?></label>
                        <input type="file" class="form-control" id="customFile<?= $i ?>" name="amulet_pre_img<?= $i ?>" accept="image/*" />
                    </div>
                <?php endfor; ?>
            </div>

            <button type="submit" class="btn btn-warning mt-5 mb-5">ຢືນຢັນ</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include('../config.php');
        if (isset($_POST['preorder_amulet_name'])) {

        $amulet_name = mysqli_real_escape_string($conn, $_POST['preorder_amulet_name']);
        $preorder_detail = mysqli_real_escape_string($conn, $_POST['preorder_detail']);
        $target_dir = "uploads/";

        function uploadImage($file, $target_dir)
        {
            $target_file = $target_dir . basename($file["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            $check = getimagesize($file["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                return "File is not an image.";
                $uploadOk = 0;
            }

            if (file_exists($target_file)) {
                return "Sorry, file already exists.";
                $uploadOk = 0;
            }

            if ($file["size"] > 1000000) {
                return "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                return "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($file["tmp_name"], $target_file)) {
                    return $target_file;
                } else {
                    return "Sorry, there was an error uploading your file.";
                }
            }
        }
    }

        $image_paths = [];
        $upload_failed = false;
        $error_messages = [];

        for ($i = 1; $i <= 5; $i++) {
            $upload_result = uploadImage($_FILES["amulet_pre_img$i"], $target_dir);
            if (strpos($upload_result, "Sorry") !== false) {
                $upload_failed = true;
                $error_messages[] = "Image $i: $upload_result";
            }
            $image_paths[] = $upload_result;
        }

        if ($upload_failed) {
            echo '<script>Swal.fire("Error", "'.implode('<br>', $error_messages).'", "error");</script>';
        } else {
            $stmt1 = $conn->prepare("INSERT INTO preorder (preorder_amulet_name, preorder_detail, preorder_status, amulet_pre_img1, amulet_pre_img2, amulet_pre_img3, amulet_pre_img4, amulet_pre_img5) VALUES (?, ?, 'open', ?, ?, ?, ?, ?)");
            $stmt1->bind_param("sssssss", $amulet_name, $preorder_detail, $image_paths[0], $image_paths[1], $image_paths[2], $image_paths[3], $image_paths[4]);

            if ($stmt1->execute()) {
                $preorder_id = $stmt1->insert_id;

                $stmt2 = $conn->prepare("INSERT INTO preorderdetails (preorder_id, amulet_pre_name, amulet_pre_group, amulet_pre_price, totalquantity, stock) VALUES (?, ?, ?, ?, ?, ?)");
                foreach ($amulets as $amulet) {
                    $amulet_pre_name = $amulet['name'];
                    $amulet_pre_group = $amulet['id'];
                    $amulet_pre_price = mysqli_real_escape_string($conn, $_POST["{$amulet['id']}_price"]);
                    $totalquantity = mysqli_real_escape_string($conn, $_POST["{$amulet['id']}_total"]);
                    $stmt2->bind_param("issiii", $preorder_id, $amulet_pre_name, $amulet_pre_group, $amulet_pre_price, $totalquantity, $totalquantity);
                    $stmt2->execute();

                    // Get the last inserted preorderdetails_id
                    $preorderdetails_id = $stmt2->insert_id;

                    // Update the amulet_pre_id to be the same as preorderdetails_id
                    $stmt3 = $conn->prepare("UPDATE preorderdetails SET amulet_pre_id = ? WHERE preorderdetails_id = ?");
                    $stmt3->bind_param("ii", $preorderdetails_id, $preorderdetails_id);
                    $stmt3->execute();
                    $stmt3->close();
                }

                echo '<script>Swal.fire("Success", "Data inserted successfully!", "success");</script>';

                $stmt2->close();
            } else {
                echo '<script>Swal.fire("Error", "Data insertion failed!", "error");</script>';
            }

            $stmt1->close();
        }

        $conn->close();
    }
    ?>

</body>

<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        var fileInputs = document.querySelectorAll('input[type="file"]');
        var isEmpty = false;

        fileInputs.forEach(function(input) {
            if (input.files.length === 0) {
                isEmpty = true;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (isEmpty) {
            event.preventDefault();
            Swal.fire('Error', 'Please select all required images.', 'error');
        }
    });
</script>

<style>
    .is-invalid {
        border-color: #dc3545;
    }
</style>

</html>

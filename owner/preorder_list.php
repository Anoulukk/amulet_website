<?php
// Start the session
include('../config.php'); // Ensure you have a database connection file

$query = "
SELECT 
    pl.preorderlist_id,
    pl.amulet_pre_id,
    pl.amulet_user_pre_amount,
    pd.amulet_pre_name,
    u.username,
    u.telephone,
    pl.preorder_status,
    pl.preorder_transfer_image 
FROM 
    preorderlist pl
JOIN 
    preorderdetails pd ON pl.amulet_pre_id = pd.amulet_pre_id
JOIN 
    user u ON pl.user_id = u.user_id
";
if ($stmt = $conn->prepare($query)) {
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    echo "Error: " . $conn->error;
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PreOrder List</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .modal-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        /* CSS for zoom effect */
        .modal-body img {
            transition: transform 0.25s ease;
            cursor: zoom-in;
        }

        .modal-body img.zoomed {
            transform: scale(5); /* Adjust the scale as needed */
            cursor: zoom-out;
        }
        #zoom-slider {
            width: 80%;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <?php include('header.php'); ?>

    <div class="container">
        <div class="row">
            <h4 class="mt-3">ລາຍງານຍອດຈອງ</h4>
            <h5 class="text-danger">ຍອດຈອງທັງໝົດມີ <?php echo $result->num_rows; ?> ລາຍການ</h5>
        </div>
        <div class="row">
            <hr>
            <div class="row">
                <h4 class="">ລາຍການຈອງ</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ລຳດັບ</th>
                            <th scope="col">ລະຫັດຫລຽນ</th>
                            <th scope="col">ຊື່ຫລຽນ</th>
                            <th scope="col">ຈຳນວນ (ອົງ)</th>
                            <th scope="col">ຊື່ຜູ້ສັ່ງຈອງ</th>
                            <th scope="col">ເບີໂທຜູ້ສັ່ງຈອງ</th>
                            <th scope="col">ລາຍລະອຽດ</th>
                            <!-- <th scope="col">ອະນຸມັດການຈອງ</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $index = 1;
                        while($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <th scope="row"><?php echo $index++; ?></th>
                                <td><?php echo $row['amulet_pre_id']; ?></td>
                                <td><?php echo $row['amulet_pre_name']; ?></td>
                                <td><?php echo $row['amulet_user_pre_amount']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['telephone']; ?></td>
                                <td>
                                    <button class="btn btn-sm btn-light view-details" data-toggle="modal" data-target="#detailsModal" 
                                            data-id="<?php echo $row['preorderlist_id']; ?>" 
                                            data-status="<?php echo $row['preorder_status'] == 'Pending' ? 'ຍັງບໍ່ທັນອະນຸມັດ' : 'ອະນຸມັດແລ້ວ'; ?>" 
                                            data-image="../<?php echo $row['preorder_transfer_image']; ?>">
                                        ລາຍລະອຽດ
                                    </button>
                                </td>
                                <!-- <td><button class="btn btn-sm btn-warning close-sale">ອອກໃບບິນ</button></td> -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for displaying order details -->
    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">ລາຍລະອຽດການສັ່ງຈອງ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>ສະຖານະ:</strong> <span id="order-status"></span></p>
                    <p><strong>ຮູບພາບການໂອນ:</strong></p>
                    <img id="order-image" src="" alt="ຮູບພາບການໂອນ" class="img-fluid" width="150px">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ປິດ</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for displaying full image -->
    <div class="modal fade" id="fullImageModal" tabindex="-1" role="dialog" aria-labelledby="fullImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fullImageModalLabel">ຮູບພາບຂະໜາດໃຫຍ່</h5>
                 
                    <input type="range" class="mb-2 ms-5" id="zoom-slider" min="1" max="5" value="1" step="0.1">
                    <button type="button" id="close_full" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="full-image" src="" alt="Full Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.body.addEventListener('click', function(event) {
                if(event.target.matches('.view-details')) {
                    const status = event.target.getAttribute('data-status');
                    const image = event.target.getAttribute('data-image');

                    document.getElementById('order-status').textContent = status;
                    document.getElementById('order-image').src = image;
                }
            });

            const orderImage = document.getElementById('order-image');
            orderImage.addEventListener('click', function () {
                const fullImageModal = document.getElementById('fullImageModal');
                const fullImage = document.getElementById('full-image');
                fullImage.src = this.src;
                $(fullImageModal).modal('show');
            });
            const close_full = document.getElementById('close_full');
            close_full.addEventListener('click', function () {
                const fullImageModal = document.getElementById('fullImageModal');
                const fullImage = document.getElementById('full-image');
                fullImage.src = this.src;
                $(fullImageModal).modal('hide');
            });

            const zoomSlider = document.getElementById('zoom-slider');
            const fullImage = document.getElementById('full-image');
            zoomSlider.addEventListener('input', function () {
                fullImage.style.transform = `scale(${this.value})`;
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>

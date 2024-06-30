<?php
// Start the session
include("../config.php");
// SQL query to fetch data from the suspensionlist table
$sql = "SELECT s.*, u.username AS reporter_name, u.telephone AS reporter_phone
        FROM suspensionlist s
        JOIN user u ON s.reporter_id = u.user_id
        WHERE suspension_status != 'active'";
$result = $conn->query($sql);

// Check for SQL errors
if (!$result) {
    die("Error in SQL query: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>suspensions</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include('header.php'); ?>

    <div class="container">
        <div class="row">
            <h4 class="mt-3">ລາຍງານການເຮັດຜິດກົດ</h4>
            <h5 class="text-danger">ການເຮັດຜິດກົດທັງໝົດມີ <?php echo $result->num_rows; ?> ລາຍການ</h5>
        </div>
        <div class="row">
            <hr>
            <div class="row">
                <h4 class="">ລາຍການເຮັດຜິດກົດ</h4>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ລຳດັບ</th>
                            <th scope="col">ລະຫັດຮ້ານຄ້າຖືກລາຍງານ</th>
                            <th scope="col">ລາຍລະອຽດຄຳຕິຊົມ</th>
                            <th scope="col">ວັນທີ່ລາຍງານ</th>
                            <th scope="col">ສະຖານະ</th>
                            <th scope="col">ຊື່ຜູ້ລາຍງານ</th>
                            <th scope="col">ເບີໂທຜູ້ລາຍງານ</th>
                            <th scope="col">ການດຳເນີນການ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            $index = 1;
                            
                            while ($row = $result->fetch_assoc()) {
                                if ($row['suspension_status'] != 'active') {
                                echo "<tr>";
                                echo "<th scope='row'>{$index}</th>";
                                echo "<td>{$row['seller_id']}</td>";
                                echo "<td>{$row['feedback_detail']}</td>";
                                echo "<td>{$row['feedback_date']}</td>";
                                echo "<td>{$row['suspension_status']}</td>";
                                echo "<td>{$row['reporter_name']}</td>";
                                echo "<td>{$row['reporter_phone']}</td>";
                                if ($row['suspension_status'] != 'disabled') {
                                    echo "<td><button class='btn btn-sm btn-warning' onclick='disableSuspension({$row['suspension_id']}, {$row['seller_id']})'>ລະງັບການໃຊ້ງານ</button></td>";
                                } else {
                                    echo "<td><button class='btn btn-sm btn-success' onclick='activeSuspension({$row['suspension_id']}, {$row['seller_id']})'>ເປີດການໃຊ້ງານ</button></td>";
                                }
                                echo "</tr>";
                                $index++;
                            }
                        }

                        } else {
                            echo "<tr><td colspan='8'>No suspensions found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

  <script>
    function disableSuspension(suspensionId, sellerId) {
        Swal.fire({
            title: 'ລະງັບຜູ້ໃຊ້!',
            text: "ທ່ານຕ້ອງການທີ່ຈະລະງັບຜູ້ໃຊ້ນີ້ແທ້ ຫຼື ບໍ່",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ແມ່ນແລ້ວ',
            cancelButtonText: 'ບໍ່'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'disable_suspension.php',
                    type: 'POST',
                    data: {
                        suspension_id: suspensionId,
                        seller_id: sellerId
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'ສຳເລັດ!',
                            text: response,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while disabling the suspension.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    }
    function activeSuspension(suspensionId, sellerId) {
        Swal.fire({
            title: 'ຍົກເລີກລະງັບຜູ້ໃຊ້!',
            text: "ທ່ານຕ້ອງການທີ່ຈຍົກເລີກະລະງັບຜູ້ໃຊ້ນີ້ແທ້ ຫຼື ບໍ່",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ແມ່ນແລ້ວ',
            cancelButtonText: 'ບໍ່'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'active_suspension.php',
                    type: 'POST',
                    data: {
                        suspension_id: suspensionId,
                        seller_id: sellerId
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'ສຳເລັດ!',
                            text: response,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred while disabling the suspension.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    }
</script>

</body>
</html>

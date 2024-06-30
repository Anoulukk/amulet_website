
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
    <?php
// Start the session and include database configuration
include("../config.php");

// Assuming user_id is stored in the session after login
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user_id is not set
    header('Location: ../logout.php');
    exit();
}

$user_id = $_SESSION['user_id'];
// Fetch seller_id using user_id
$seller_sql = "SELECT seller_id FROM seller WHERE user_id = '$user_id'";
$seller_result = $conn->query($seller_sql);

if ($seller_result->num_rows > 0) {
    $seller_row = $seller_result->fetch_assoc();
    $seller_id = $seller_row['seller_id'];
} else {
    // Handle the case where no seller is found for the logged-in user
    exit();
}

// Fetch data from the orderamulet and amuletsell tables with a join
$sql = "SELECT o.*, a.*
        FROM orderamulet o
        INNER JOIN amuletsell a ON o.amulet_sell_id = a.amulet_sell_id
        WHERE a.seller_id = '$seller_id'";
$result = $conn->query($sql);
?>
    <h3 class="text-center mt-3 mb-3">ລາຍການທີ່ລູກຄ້າຂໍສັ່ງຊື້</h3>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 ">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ລຳດັບ</th>
                            <th scope="col">ລະຫັດສິນຄ້າ</th>
                            <th scope="col">ຊື່ສິນຄ້າ</th>
                            <th scope="col">ຊື່ຜູ້ຂໍສັ່ງຊື້</th>
                            <th scope="col">ເບີໂທຜູ້ຂໍສັ່ງຊື້</th>
                            <th scope="col">ປິດການຂາຍ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Fetch user data associated with user_id
                                $userId = $row['user_id'];
                                $userSql = "SELECT * FROM user WHERE user_id = $userId";
                                $userResult = $conn->query($userSql);
                                $userRow = $userResult->fetch_assoc();

                                // Check if new_owner_amulet is 0
                                if ($row['new_owner_amulet'] == 0) {
                        ?>
                                    <tr data-order-id="<?php echo $row['orderamulet_id']; ?>">
                                        <td><?php echo $row['amulet_sell_id']; ?></td>
                                        <td><?php echo $row['amulet_sell_id']; ?></td>
                                        <td><?php echo $row['amulet_sell_name']; ?></td>
                                        <td><?php echo $userRow['username']; ?></td>
                                        <td><?php echo $userRow['telephone']; ?></td>
                                        <td><button class="btn btn-sm btn-warning close-sale" data-order-id="<?php echo $row['orderamulet_id']; ?>" data-user-id="<?php echo $userRow['user_id']; ?>">ປິດການຂາຍ</button></td>
                                    </tr>
                        <?php
                                }
                            }
                        } else {
                            echo "<tr><td colspan='6'>No orders found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.close-sale').forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.getAttribute('data-order-id');
                const userId = this.getAttribute('data-user-id');

                // Send AJAX request to update new_owner_amulet
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'update_order.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Handle the response if needed
                        console.log(xhr.responseText);
                        // Display success alert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Operation completed successfully'
                        }).then(() => {
                            // Remove the row from the table
                            document.querySelector(`tr[data-order-id="${orderId}"]`).remove();
                        });
                    }
                };
                xhr.send(`order_id=${orderId}&user_id=${userId}`);
            });
        });
    </script>

</body>

</html>

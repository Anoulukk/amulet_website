<?php
// Start the session
include("config.php");
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
$userId = $_SESSION['user_id'];
$query = "SELECT o.orderamulet_id, o.amulet_sell_id, o.orderamulet_date, o.orderamulet_qty, o.user_id, 
               o.seller_id, o.new_owner_amulet, a.amulet_sell_name, a.amulet_sell_detail, a.amulet_sell_price,
               a.amulet_sell_img, a.amulet_sell_status, a.amulet_sell_date, a.amuletGroup,
               s.store_name, s.id_card, s.description, s.seller_address
          FROM orderamulet o
          JOIN amuletsell a ON o.amulet_sell_id = a.amulet_sell_id
          JOIN seller s ON o.seller_id = s.seller_id
          WHERE o.user_id = '$userId'";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Activity log</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
  <?php include('header.php'); ?>
  <div class="container mt-3">
    <div class="row">

      <div class="col-sm-12 ">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">ລຳດັບ</th>
              <th scope="col">ລະຫັດສິນຄ້າ</th>
              <th scope="col">ຊື່ສິນຄ້າ</th>
              <th scope="col">ຊື່ຮ້ານຄ້າ</th>
              <th scope="col">ລາຍລະອຽດຮ້ານຄ້າ</th>
            </tr>
          </thead>
          <?php
           if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<th scope='row'>" . $row['orderamulet_id'] . "</th>";
                echo "<td>" . $row['amulet_sell_id'] . "</td>";
                echo "<td>" . $row['amulet_sell_name'] . "</td>";
                echo "<td>" . $row['store_name'] . "</td>";
                echo "<td>" . $row['seller_address'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='13'>No orders found</td></tr>";
        }
        ?>
        </table>
      </div>

    </div>
  </div>
</body>

</html>
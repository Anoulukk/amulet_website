<?php
// Start the session
include("config.php");
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Prepare and execute the query securely
$query = "SELECT o.orderamulet_id, o.amulet_sell_id, o.orderamulet_date, o.orderamulet_qty, o.user_id, 
               o.seller_id, o.new_owner_amulet, a.amulet_sell_name, a.amulet_sell_detail, a.amulet_sell_price,
               a.amulet_sell_img, a.amulet_sell_status, a.amulet_sell_date, a.amuletGroup,
               s.store_name, s.id_card, s.description, s.seller_address,
               p.preorderlist_id, p.preorder_id, p.amulet_pre_id, p.amulet_user_pre_amount, p.amulet_pre_price, 
               p.preorder_status, p.preorder_address
          FROM orderamulet o
          JOIN amuletsell a ON o.amulet_sell_id = a.amulet_sell_id
          JOIN seller s ON o.seller_id = s.seller_id
          JOIN preorderlist p ON o.user_id = p.user_id
          WHERE o.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

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
              <th scope="col">ຊື່ຮ້ານຄ້າ</th>
              <th scope="col">ລາຍລະອຽດຮ້ານຄ້າ</th>
              <th scope="col">ສະຖານະ</th>
              <th scope="col">ທີ່ຢູ່</th>
            </tr>
          </thead>
          <tbody>
          <?php
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<th scope='row'>" . htmlspecialchars($row['orderamulet_id']) . "</th>";
                  echo "<td>" . htmlspecialchars($row['store_name']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['seller_address']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['preorder_status']) . "</td>";
                  echo "<td>" . htmlspecialchars($row['preorder_address']) . "</td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='9'>No orders found</td></tr>";
          }
          ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>

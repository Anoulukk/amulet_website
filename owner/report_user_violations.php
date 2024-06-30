<?php
include("../config.php");

// Prepare and execute the query to fetch suspension details, seller information, and user information
$query = "SELECT s.suspension_id, s.feedback_detail, s.feedback_date, s.suspension_status, 
                 u.user_id AS reporter_id, u.username AS reporter_username, u.lastname AS reporter_lastname, u.telephone AS reporter_phone, 
                 us.user_id AS seller_id, us.username AS seller_username, us.lastname AS seller_lastname, us.telephone AS seller_phone, us.active 
          FROM suspensionlist s
          JOIN user u ON s.reporter_id = u.user_id
          JOIN seller se ON s.seller_id = se.seller_id
          JOIN user us ON se.user_id = us.user_id";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$suspensionList = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $suspensionList[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Suspension List</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div class="container mt-3">
    <div class="row">
      <h4 class="mt-3">ລາຍງານການເຮັດຜິດກົດຜູ້ໃຊ້</h4>
      <h5 class="text-danger">ມີທັງໝົດ <?php echo count($suspensionList); ?> ລາຍການ</h5>
    </div>
    <div class="row">
      <hr>
      <div class="row">
        <h4 class="">ລາຍການເຮັດຜິດກົດ</h4>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">ລຳດັບ</th>
              <th scope="col">ລະຫັດຜູ້ໃຊ້</th>
              <th scope="col">ຊື່ຜູ້ໃຊ້</th>
              <th scope="col">ເບີໂທ</th>
              <th scope="col">ລາຍລະອຽດ</th>
              <th scope="col">ວັນທີ</th>
              <th scope="col">ສະຖານະການລົງໂທດ</th>
              <th scope="col">ຜູ້ລາຍງານ</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($suspensionList)) {
                $index = 1;
                foreach ($suspensionList as $suspension) {
                    $formattedDate = date('Y-m-d', strtotime($suspension['feedback_date']));
                    echo "<tr>";
                    echo "<th scope='row'>" . $index++ . "</th>";
                    echo "<td>" . htmlspecialchars($suspension['seller_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($suspension['seller_username']) . " " . htmlspecialchars($suspension['seller_lastname']) . "</td>";
                    echo "<td>" . htmlspecialchars($suspension['seller_phone']) . "</td>";
                    echo "<td>" . htmlspecialchars($suspension['feedback_detail']) . "</td>";
                    echo "<td>" . htmlspecialchars($formattedDate) . "</td>";
                    echo "<td>" . htmlspecialchars($suspension['suspension_status']) . "</td>";
                    echo "<td>" . htmlspecialchars($suspension['reporter_username']) . " " . htmlspecialchars($suspension['reporter_lastname']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No suspensions found</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>

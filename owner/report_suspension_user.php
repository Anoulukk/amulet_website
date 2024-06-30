<?php
include("../config.php");



// Prepare and execute the query to fetch users with active status as false
$query = "SELECT user_id, username, lastname, telephone, active, status FROM user WHERE active = 'false'";
$result = $conn->query($query);

$disabledUsers = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $disabledUsers[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Disabled Users</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div class="container mt-3">
    <div class="row">
      <h4 class="mt-3">ລາຍງານຈຳນວນຜູ້ຖືກລະງັບ</h4>
      <h5 class="text-danger">ມີທັງໝົດ <?php echo count($disabledUsers); ?> ລາຍການ</h5>
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
              <th scope="col">ບົດບາດ</th>
              <th scope="col">ສະຖານະ</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($disabledUsers)) {
                $index = 1;
                foreach ($disabledUsers as $user) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $index++ . "</th>";
                    echo "<td>" . htmlspecialchars($user['user_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($user['username']) . " " . htmlspecialchars($user['lastname']) . "</td>";
                    echo "<td>" . htmlspecialchars($user['telephone']) . "</td>";
                    echo "<td>" . htmlspecialchars($user['status']) . "</td>";
                    echo "<td>ຖືກລະງັບການໃຊ້ງານ</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No disabled users found</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>

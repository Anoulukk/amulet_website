<?php
// Start the session
include("config.php");
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
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
              <th scope="col">ເບີໂທຮ້ານຄ້າ</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>001</td>
              <td>ຫລຽນພຣະຊາຄຳແດງ</td>
              <td>mossphakhg</td>
              <td>02055667789</td>
            </tr>

          </tbody>
        </table>
      </div>

    </div>
  </div>
</body>

</html>
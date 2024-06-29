<?php
// Start the session and include config
include("config.php");
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

// SQL Query to join tables
$sql = "SELECT p.preorder_id, p.preorder_amulet_name, p.preorder_detail, p.preorder_date, p.preorder_status,
               p.amulet_pre_img1, p.amulet_pre_img2, p.amulet_pre_img3, p.amulet_pre_img4, p.amulet_pre_img5,
               pd.preorderdetails_id, pd.amulet_pre_id, pd.amulet_pre_name, pd.amulet_pre_group, pd.amulet_pre_price, pd.totalquantity, pd.stock
        FROM preorder p
        JOIN preorderdetails pd ON p.preorder_id = pd.preorder_id";

$result = $conn->query($sql);
$preorder_amulet_name = ""; // Default name
$preorder_detail = "";
$images = [];
$gold_items = [];
$silver_items = [];
$director_items = [];
$buddha_9_items = [];
$buddha_5_items = [];
$random_items = [];

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $preorder_amulet_name = $row['preorder_amulet_name'];
  $preorder_detail = $row['preorder_detail'];
  $images = [
    $row['amulet_pre_img1'],
    $row['amulet_pre_img2'],
    $row['amulet_pre_img3'],
    $row['amulet_pre_img4'],
    $row['amulet_pre_img5']
  ];

  do {
    if ($row['amulet_pre_group'] === 'gold_group') {
      $gold_items[] = $row;
    } elseif ($row['amulet_pre_group'] === 'silver_group') {
      $silver_items[] = $row;
    } elseif ($row['amulet_pre_group'] === 'director_group') {
      $director_items[] = $row;
    } elseif ($row['amulet_pre_group'] === 'buddha_9_group') {
      $buddha_9_items[] = $row;
    } elseif ($row['amulet_pre_group'] === 'buddha_5_group') {
      $buddha_5_items[] = $row;
    } elseif ($row['amulet_pre_group'] === 'random') {
      $random_items[] = $row;
    }
  } while ($row = $result->fetch_assoc());
} else {
  $no_data_message = "No data available.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PreOrder</title>
  <style>
    .cardBg {
      background-image: linear-gradient(to bottom right, #fcc200, #f7e98e);
    }

    .circle-img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 1rem;
    }

    .add-preorder {
      cursor: pointer;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.add-preorder').on('click', function() {
        var itemId = $(this).data('id');
        var button = $(this);
        $.ajax({
          url: 'check_preorder_limit.php',
          type: 'POST',
          data: {
            id: itemId,
          },
          success: function(response) {
            if (response == "limit_reached") {
              Swal.fire({
                icon: 'error',
                title: 'ຂໍອະໄພ...',
                text: "ຈຳນວນພຣະທີ່ທ່ານເລືອກຄົບຕາມກຳນົດແລ້ວ",
              });
            } else {
              $.ajax({
                url: 'update_cart.php',
                type: 'POST',
                data: {
                  id: itemId,
                  action: 'increase'
                },
                success: function(response) {
                  if (response === "You can only add up to 10 items in total.") {
                    Swal.fire({
                      icon: 'error',
                      title: 'ຂໍອະໄພ...',
                      text: "ຈຳນວນພຣະທີ່ທ່ານເລືອກຄົບຕາມກຳນົດແລ້ວ.",
                    });
                  } else {
                    button.prop('disabled', true);
                  }
                }
              });
            }
          }
        });
      });
    });
  </script>


</head>

<body>
  <?php include('header.php'); ?>

  <div class="container text-center">
    <div class="row">
      <div class="col mt-3">
        <h2>ສູນຈອງຫຼຽນ<?= $preorder_amulet_name ?></h2>
      </div>
    </div>
    <div class="row">
      <div class="col text-start cardBg rounded p-3">
        <h5>ປະຫວັດຄວາມເປັນມາ:</h5>
        <p><?= $preorder_detail ?></p><br>
        <div class="d-flex justify-content-center">
          <?php foreach ($images as $image) : ?>
            <?php if (!empty($image)) : ?>
              <img src="./owner/<?= $image ?>" class="circle-img" alt="">
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
      <h3 class="mt-3">ຕິດຕໍ່ສູນຈອງ</h3>
      <div class="col d-flex text-start cardBg rounded">
        <div class="d-flex flex-column justify-content-center align-items-center">
          <img src="./img/logomoss.jpg" class="circle-img " width="150px" alt="">
          <!-- <h5 class="text-dark">ສູນຈອງທີ 1</h5> -->
        </div>

        <div class=" d-flex flex-column justify-content-center align-items-center p-3">
          <h5 class="ms-5 ">ສູນຈອງມ໋ອດພຣະເຄື່ອງ</h5>
          <span class="ms-5 d-flex justify-content-center align-items-center">
            <img src="./img/whatsapplogo.png" width="30px" alt="">
            <h5 class="mt-2 ms-1">020-9999-8888</h5>
          </span>
          <span class="d-flex justify-content-center align-items-center">
            <img src="./img/facebooklogo.png" width="30px" alt="">
            <h5 class="mt-2 ms-1">Moss Ptd</h5>
          </span>
        </div>
      </div>
      <h3 class="mt-3">ລາຍການທັງໝົດ</h3>
      <div class="col d-flex text-start cardBg rounded p-2 justify-content-center align-items-center">
        <p class="bg-light rounded p-1 me-3 mb-0 cursor-pointer">ທັງໝົດ</p>
        <p class="bg-light rounded p-1 me-3 mb-0 cursor-pointer">ເນື້ອທອງຄຳ</p>
        <p class="bg-light rounded p-1 me-3 mb-0 cursor-pointer">ເນື້ອເງີນ</p>
        <p class="bg-light rounded p-1 me-3 mb-0 cursor-pointer">ລາຍການຊຸດກຳມະການ</p>
        <p class="bg-light rounded p-1 me-3 mb-0 cursor-pointer">ລຸ້ນເນື້ອ</p>
        <p class="bg-light rounded p-1 me-3 mb-0 cursor-pointer">ອົງບູຊາ ຂະໜາດ 9 ນິ້ວ</p>
        <p class="bg-light rounded p-1 me-3 mb-0 cursor-pointer">ອົງບູຊາ ຂະໜາດ 5 ນິ້ວ</p>
      </div>
      <?php if ($role === "user" || $role == null) : ?>
        <a href="login.php" class="btn btn-danger mt-3">ເຂົ້າສູ່ລະບົບເພື່ອຈອງ</a>
      <?php endif; ?>

      <?php if (isset($no_data_message)) : ?>
        <div class="alert alert-warning mt-3">
          <?= $no_data_message ?>
        </div>
      <?php else : ?>
        <h3 class="mt-3"></h3>
        <a href="user_preorder_form.php" class="btn btn-light border border-warning border-2 shadow">ເບິ່ງລາຍການທີ່ເລືອກ</a>
        <div class="d-flex mb-3 mt-3">


          <div class="col text-start cardBg rounded p-3 justify-content-center align-items-center">
            <h4>1. ເນື້ອທອງຄຳ</h4>
            <?php foreach ($gold_items as $item) : ?>
              <div class="d-flex justify-content-center">
                <h5 class="p-1 bg-light rounded">ລາຄາ: <span><?= number_format($item['amulet_pre_price']) ?> </span>ກີບ</h5>
                <h5 class="p-1 bg-light rounded ms-3">ສ້າງທັງໝົດ <span><?= $item['totalquantity'] ?> </span>ຫຼຽນ</h5>
              </div><br>
              <div class="row justify-content-center mb-3 bg-light p-3 rounded">
                <div class="col text-end">
                  <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
                </div>
                <div class="col-6 text-start">
                  <h6><?= $item['amulet_pre_name'] ?> (ສຸ່ມລົງຢາ)</h6>
                  <h5>ຍັງເຫຼືອ <?= $item['stock'] ?> ຫຼຽນ</h5>
                </div>
                <div class="col text-center">
                  <button class="add-preorder btn btn-light border" data-id="<?= $item['amulet_pre_id'] ?>">ເລືອກ</button>
                </div>
              </div>
            <?php endforeach; ?>

          </div>
          <div class="col ms-5 text-start cardBg rounded p-3 justify-content-center align-items-center">
            <h4>2. ເນື້ອເງິນ </h4>
            <?php foreach ($silver_items as $item) : ?>
              <div class="d-flex justify-content-center">
                <h5 class="p-1 bg-light rounded">ລາຄາ: <span><?= number_format($item['amulet_pre_price']) ?> </span>ກີບ</h5>
                <h5 class="p-1 bg-light rounded ms-3">ສ້າງທັງໝົດ <span><?= $item['totalquantity'] ?> </span>ຫຼຽນ</h5>
              </div><br>
              <div class="row justify-content-center mb-3 bg-light p-3 rounded">
                <div class="col text-end">
                  <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
                </div>
                <div class="col-6 text-start">
                  <h6><?= $item['amulet_pre_name'] ?> (ສຸ່ມລົງຢາ)</h6>
                  <h5>ຍັງເຫຼືອ <?= $item['stock'] ?> ຫຼຽນ</h5>
                </div>
                <div class="col text-center">
                  <button class="add-preorder btn btn-light border" data-id="<?= $item['amulet_pre_id'] ?>">ເລືອກ</button>

                </div>
              </div>
            <?php endforeach; ?>

          </div>
        </div>
        <div class="d-flex mb-3">

          <div class="col text-start cardBg rounded p-3 justify-content-center align-items-center">
            <h4>3. ຊຸດກຳມະການ</h4>
            <?php foreach ($director_items as $item) : ?>
              <div class="d-flex justify-content-center">
                <h5 class="p-1 bg-light rounded">ລາຄາ: <span><?= number_format($item['amulet_pre_price']) ?> </span>ກີບ</h5>
                <h5 class="p-1 bg-light rounded ms-3">ສ້າງທັງໝົດ <span><?= $item['totalquantity'] ?> </span>ຫຼຽນ</h5>
              </div><br>
              <div class="row justify-content-center mb-3 bg-light p-3 rounded">
                <div class="col text-end">
                  <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
                </div>
                <div class="col-6 text-start">
                  <h6><?= $item['amulet_pre_name'] ?> (ສຸ່ມລົງຢາ)</h6>
                  <h5>ຍັງເຫຼືອ <?= $item['stock'] ?> ຫຼຽນ</h5>
                </div>
                <div class="col text-center">
                  <button class="add-preorder btn btn-light border" data-id="<?= $item['amulet_pre_id'] ?>">ເລືອກ</button>

                </div>
              </div>
            <?php endforeach; ?>

          </div>
          <div class="col ms-5 text-start cardBg rounded p-3 justify-content-center align-items-center">
            <h4>4. ອົງບູຊາຂະໜາດ 9 ນິ້ວ</h4>
            <?php foreach ($buddha_9_items as $item) : ?>
              <div class="d-flex justify-content-center">
                <h5 class="p-1 bg-light rounded">ລາຄາ: <span><?= number_format($item['amulet_pre_price']) ?> </span>ກີບ</h5>
                <h5 class="p-1 bg-light rounded ms-3">ສ້າງທັງໝົດ <span><?= $item['totalquantity'] ?> </span>ຫຼຽນ</h5>
              </div><br>
              <div class="row justify-content-center mb-3 bg-light p-3 rounded">
                <div class="col text-end">
                  <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
                </div>
                <div class="col-6 text-start">
                  <h6><?= $item['amulet_pre_name'] ?> </h6>
                  <h5>ຍັງເຫຼືອ <?= $item['stock'] ?> ຫຼຽນ</h5>
                </div>
                <div class="col text-center">
                  <button class="add-preorder btn btn-light border" data-id="<?= $item['amulet_pre_id'] ?>">ເລືອກ</button>

                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="d-flex mb-3">

          <div class="col text-start cardBg rounded p-3 justify-content-center align-items-center">
            <h4>5. ອົງບູຊາຂະໜາດ 5 ນິ້ວ</h4>
            <?php foreach ($buddha_5_items as $item) : ?>
              <div class="d-flex justify-content-center">
                <h5 class="p-1 bg-light rounded">ລາຄາ: <span><?= number_format($item['amulet_pre_price']) ?> </span>ກີບ</h5>
                <h5 class="p-1 bg-light rounded ms-3">ສ້າງທັງໝົດ <span><?= $item['totalquantity'] ?> </span>ຫຼຽນ</h5>
              </div><br>
              <div class="row justify-content-center mb-3 bg-light p-3 rounded">
                <div class="col text-end">
                  <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
                </div>
                <div class="col-6 text-start">
                  <h6><?= $item['amulet_pre_name'] ?> </h6>
                  <h5>ຍັງເຫຼືອ <?= $item['stock'] ?> ຫຼຽນ</h5>
                </div>
                <div class="col text-center">
                  <button class="add-preorder btn btn-light border" data-id="<?= $item['amulet_pre_id'] ?>">ເລືອກ</button>

                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <div class="col ms-5 text-start cardBg rounded p-3 justify-content-center align-items-center">
            <h4>6. ລຸ້ນເນື້ອ</h4>
            <?php foreach ($random_items as $item) : ?>
              <div class="d-flex justify-content-center">
                <h5 class="p-1 bg-light rounded">ລາຄາ: <span><?= number_format($item['amulet_pre_price']) ?> </span>ກີບ</h5>
                <h5 class="p-1 bg-light rounded ms-3">ສ້າງທັງໝົດ <span><?= $item['totalquantity'] ?> </span>ຫຼຽນ</h5>
              </div><br>
              <div class="row justify-content-center mb-3 bg-light p-3 rounded">
                <div class="col text-end">
                  <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
                </div>
                <div class="col-6 text-start">
                  <h6><?= $item['amulet_pre_name'] ?> (ສຸ່ມລົງຢາ)</h6>
                  <h5>ຍັງເຫຼືອ <?= $item['stock'] ?> ຫຼຽນ</h5>
                </div>
                <div class="col text-center">
                  <button class="add-preorder btn btn-light border" data-id="<?= $item['amulet_pre_id'] ?>">ເລືອກ</button>

                </div>
              </div>
            <?php endforeach; ?>

          </div>
        </div>

      </div>
    </div>
  <?php endif; ?>
</body><br>

<!-- <?php include('footer.php') ?> -->
</html>

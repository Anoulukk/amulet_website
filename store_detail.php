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
  <title>Store Detail</title>
</head>

<body>
  <?php include('header.php'); ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-3 bg-light rounded text-dark text-center" style="margin: 0 auto; background-image: linear-gradient(to bottom right, #fcc200, #f7e98e);">
        <img class="market-img" src="./img/store.jpeg" alt="" width="150px"><br><br>
        <h4>ຮ້ານມ໋ອດຊີ້ພຣະເຄື່ອງ</h4>
        <h6 class="border"><b>shop ID : 12</b></h6>
        <p>ທີ່ຢູ່ : ສີ່ແຍກດົງນາໂຊກ
          ເມືອງ ຈັນທະບູລີ ແຂວງ ນະຄອນຫລວງວຽງຈັນ</p>
        <p class="border">ຕິດຕໍ່: <span>020 56565655</span></p>
        <p>ເປິດວັນຈັນຫາວັນສຸກ
          ເວລາ8:30-23:30</p>
        <p>ການຮັບປະກັນສິນຄ້າ<br>ໂອນບ໋ອກ,ໄດ້ຮັບພຣະເກ້100%</p>
        <button class="btn btn-light mt-5" style="width: 300px;">ລາຍງານຮ້ານຄ້າ</button>
      </div>

      <div class="col-8 ">
        <div class="row">
          <h4 class="mt-3">ພຣະເດັ່ນປະຈຳຮ້ານ</h4>

        </div>
        <div class="row  ">

          <div class="col-2 text-center store-box">
            <a href="amulet_detail.php">
              <img class="top-amulet-store-img" src="./img/skd.png" alt="">
            </a>
            <div class="store-details">
              <h6>ຫຼຽນພຣະອາຈານຊາຄຳແດງ</h6>

            </div>
          </div>
          <div class="col-2 text-center store-box">
            <a href="amulet_detail.php">
              <img class="top-amulet-store-img" src="./img/skd.png" alt="">
            </a>
            <div class="store-details">
              <h6>ຫຼຽນພຣະອາຈານຊາຄຳແດງ</h6>

            </div>
          </div>
          <div class="col-2 text-center store-box">
            <a href="store_detail.php">
              <img class="top-amulet-store-img" src="./img/skd.png" alt="">
            </a>
            <div class="store-details">
              <h6>ຫຼຽນພຣະອາຈານຊາຄຳແດງ</h6>

            </div>
          </div>
          <div class="col-2 text-center store-box">
            <a href="amulet_detail.php">
              <img class="top-amulet-store-img" src="./img/skd.png" alt="">
            </a>
            <div class="store-details">
              <h6>ຫຼຽນພຣະອາຈານຊາຄຳແດງ</h6>

            </div>
          </div>
          <div class="col-2 text-center store-box">
            <a href="amulet_detail.php">
              <img class="top-amulet-store-img" src="./img/skd.png" alt="">
            </a>
            <div class="store-details">
              <h6>ຫຼຽນພຣະອາຈານຊາຄຳແດງ</h6>

            </div>
          </div>
          <div class="col-2 text-center store-box">
            <a href="amulet_detail.php">
              <img class="top-amulet-store-img" src="./img/skd.png" alt="">
            </a>
            <div class="store-details">
              <h6>ຫຼຽນພຣະອາຈານຊາຄຳແດງ</h6>

            </div>
          </div>
        </div>
        <div class="row">
          <h4 class="mt-3">ລາຍການພຣະເຄື່ອງໃນຮ້ານ</h4>

          <div class="row  ">

            <div class="col-2 text-center store-box">
              <a href="amulet_detail.php">
                <img class="top-amulet-store-img" src="./img/skd.png" alt="">
              </a>
              <div class="store-details">
                <h6>ຫຼຽນພຣະອາຈານຊາຄຳແດງ</h6>

              </div>
            </div>
            <div class="col-2 text-center store-box">
              <a href="amulet_detail.php">
                <img class="top-amulet-store-img" src="./img/skd.png" alt="">
              </a>
              <div class="store-details">
                <h6>ຫຼຽນພຣະອາຈານຊາຄຳແດງ</h6>

              </div>
            </div>
            <div class="col-2 text-center store-box">
              <a href="store_detail.php">
                <img class="top-amulet-store-img" src="./img/skd.png" alt="">
              </a>
              <div class="store-details">
                <h6>ຫຼຽນພຣະອາຈານຊາຄຳແດງ</h6>

              </div>
            </div>
            <div class="col-2 text-center store-box">
              <a href="amulet_detail.php">
                <img class="top-amulet-store-img" src="./img/skd.png" alt="">
              </a>
              <div class="store-details">
                <h6>ຫຼຽນພຣະອາຈານຊາຄຳແດງ</h6>

              </div>
            </div>
            <div class="col-2 text-center store-box">
              <a href="amulet_detail.php">
                <img class="top-amulet-store-img" src="./img/skd.png" alt="">
              </a>
              <div class="store-details">
                <h6>ຫຼຽນພຣະອາຈານຊາຄຳແດງ</h6>

              </div>
            </div>
            <div class="col-2 text-center store-box">
              <a href="amulet_detail.php">
                <img class="top-amulet-store-img" src="./img/skd.png" alt="">
              </a>
              <div class="store-details">
                <h6>ຫຼຽນພຣະອາຈານຊາຄຳແດງ</h6>

              </div>
            </div>
          </div>

          <div class="row  ">

            <div class="col-2 text-center store-box">
              <a href="amulet_detail.php">
                <img class="top-amulet-store-img" src="./img/skd.png" alt="">
              </a>
              <div class="store-details">
                <h6>ຫຼຽນພຣະອາຈານຊາຄຳແດງ</h6>

              </div>
            </div>
            <div class="col-2 text-center store-box">
              <a href="amulet_detail.php">
                <img class="top-amulet-store-img" src="./img/skd.png" alt="">
              </a>
              <div class="store-details">
                <h6>ຫຼຽນພຣະອາຈານຊາຄຳແດງ</h6>

              </div>
            </div>
            <div class="col-2 text-center store-box">
              <a href="store_detail.php">
                <img class="top-amulet-store-img" src="./img/skd.png" alt="">
              </a>
              <div class="store-details">
                <h6>ຫຼຽນພຣະອາຈານຊາຄຳແດງ</h6>

              </div>
            </div>
            <div class="col-2 text-center store-box">
              <a href="amulet_detail.php">
                <img class="top-amulet-store-img" src="./img/skd.png" alt="">
              </a>
              <div class="store-details">
                <h6>ຫຼຽນພຣະອາຈານຊາຄຳແດງ</h6>

              </div>
            </div>
            <div class="col-2 text-center store-box">
              <a href="amulet_detail.php">
                <img class="top-amulet-store-img" src="./img/skd.png" alt="">
              </a>
              <div class="store-details">
                <h6>ຫຼຽນພຣະອາຈານຊາຄຳແດງ</h6>

              </div>
            </div>
            <div class="col-2 text-center store-box">
              <a href="amulet_detail.php">
                <img class="top-amulet-store-img" src="./img/skd.png" alt="">
              </a>
              <div class="store-details">
                <h6>ຫຼຽນພຣະອາຈານຊາຄຳແດງ</h6>

              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
</body>
<?php include('footer.php') ?>

</html>
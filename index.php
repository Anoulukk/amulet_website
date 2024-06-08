<?php
include("config.php");
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

$sql = "SELECT amuletsell.*, seller.store_name 
        FROM amuletsell 
        JOIN seller ON amuletsell.seller_id = seller.seller_id";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Amulet Auction</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
  <?php include('header.php'); ?>
  <div class="container">
    <div class="row">
      <div class="col">
      </div>
      <div class="col-8" style="margin-top: 20px">
        <div class="input-group">
          <input type="text" id="search" class="form-control" placeholder="ຄົ້ນຫາພຣະເຄື່ອງ">
          <button type="submit" id="search-btn" class="btn btn-dark">ຄົ້ນຫາ</button>
        </div>
        <h3 class="text-center text-popular mt-3">ພຣະເຄື່ອງຍອດນິຍົມປະຈຳອາທິດ</h3>
      </div> 

      <div class="col">
      </div>
    </div>
    <div class="row">
      <div class="col" style="margin-top: 20px;">
        <h3>ໝວດພຣະເຄື່ອງ</h3>
        <h5 class="news-title"><a href="" class="category">ພຣະຫຼຽນ</a></h5>
        <h5 class="news-title"><a href="" class="category">ພຣະບູຊາ</a></h5>
        <h5 class="news-title"><a href="" class="category">ພຣະກິ່ງ</a></h5>
        <h5 class="news-title"><a href="" class="category">ຕະກຸດ</a></h5>
        <h5 class="news-title"><a href="" class="category">ຜ້າຍັນ</a></h5>
        <h5 class="news-title"><a href="" class="category">ອົງລອຍ</a></h5>
        <h5 class="news-title"><a href="" class="category">ພຣະເນື້ອຜົງ</a></h5>
      </div>

      <div class="col-8 box">
        <?php if ($result->num_rows > 0): ?>
          <?php while($row = $result->fetch_assoc()): ?>
            <div class="col-3 text-center search-box">
              <a href="amulet_detail.php?id=<?php echo $row['amulet_sell_id']; ?>">
                <img class="store-img" src="./seller/<?php echo $row['amulet_sell_img']; ?>" alt="<?php echo $row['amulet_sell_name']; ?>">
              </a>
              <div class="store-details">
                <h6><?php echo $row['amulet_sell_name']; ?></h6>
                <h6 style="color: <?php echo ($row['amulet_sell_status'] == 'ForSale') ? 'green' : '#da9100'; ?>">
                  <?php echo ($row['amulet_sell_status'] == 'ForSale') ? 'ພ້ອມເຊົ່າ' : 'ເຊົ່າແລ້ວ'; ?>
                </h6>
                <p class="store-name"><i class="fa-solid fa-house"></i>&nbsp;<?php echo $row['store_name']; ?></p>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p>No amulets available for sale.</p>
        <?php endif; ?>
      </div>
      <div class="col" style="margin-top:20px">
        <h5 class="text-center">ຂ່າວສານປະຊາສຳພັນ</h5>
        <p class="news-title"><a href="" class="category">ໂປຣໂມຊັ່ນພິເສດ!! ສຳລັບລູກຄ້າທີ່ເປີດຮ້ານໃໝ່ພາຍໃນເດືອນຕຸລານີ້ແມ່ນຈະໄດ້ຮັບສ່ວນຫຼຸດ 30% ໃນການເປີດຮ້ານໃໝ່</a></p>
        <p class="news-title"><a href="" class="category">ສຳລັບລູກຄ້າທີ່ເປີດຮ້ານໃໝ່ພາຍໃນເດືອນຕຸລານີ້ແມ່ນຈະໄດ້ຮັບສ່ວນຫຼຸດ 30% </a></p>
        <p class="news-title"><a href="" class="category">ໂປຣໂມຊັ່ນພິເສດ!! ສຳລັບລູກຄ້າທີ່ເປີດຮ້ານໃໝ່ພາຍໃນເດືອນຕຸລານີ້ແມ່ນຈະໄດ້ຮັບສ່ວນຫຼຸດ 30% ໃນການເປີດຮ້ານໃໝ່</a></p>
        <p class="news-title"><a href="" class="category">ສຳລັບລູກຄ້າທີ່ເປີດຮ້ານໃໝ່ພາຍໃນເດືອນຕຸລານີ້ແມ່ນຈະໄດ້ຮັບສ່ວນຫຼຸດ 30% </a></p>
        <p class="news-title"><a href="" class="category">ໂປຣໂມຊັ່ນພິເສດ!! ສຳລັບລູກຄ້າທີ່ເປີດຮ້ານໃໝ່ພາຍໃນເດືອນຕຸລານີ້ແມ່ນຈະໄດ້ຮັບສ່ວນຫຼຸດ 30% ໃນການເປີດຮ້ານໃໝ່</a></p>
        <hr>
        <!-- <p class="news-title text-center" id="all-news-btn">ເບິ່ງທັງໝົດ <i class="fa-solid fa-arrow-right"></i></p> -->
      </div>
    </div>

  </div>





</body><br>
<?php include('footer.php') ?>

</html>
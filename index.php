<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Amulet Auction</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    .category-link {
      text-decoration: none;
      color: inherit;
    }
    .category-link:hover {
      text-decoration: none;
      color: inherit;
    }

  </style>
</head>

<body>
  <?php include('header.php'); ?>
  <div class="container">
    <div class="row">
      <div class="col"></div>
      <div class="col-8" style="margin-top: 20px">
        <form method="get" action="index.php">
          <div class="input-group">
            <input type="text" name="search" id="search" class="form-control" placeholder="ຄົ້ນຫາພຣະເຄື່ອງ" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit" id="search-btn" class="btn btn-dark">ຄົ້ນຫາ</button>
          </div>
        </form>
        <h3 class="text-center text-popular mt-3">ພຣະເຄື່ອງຍອດນິຍົມປະຈຳອາທິດ</h3>
      </div>
      <div class="col"></div>
    </div>
    <div class="row">
      <div class="col" style="margin-top: 20px;">
        <h3>ໝວດພຣະເຄື່ອງ</h3>
        <a href="?category=ພຣະຫຼຽນ" class="category-link"><h5 class="news-title">ພຣະຫຼຽນ</h5></a>
        <a href="?category=ພຣະບູຊາ" class="category-link"><h5 class="news-title">ພຣະບູຊາ</h5></a>
        <a href="?category=ພຣະກິ່ງ" class="category-link"><h5 class="news-title">ພຣະກິ່ງ</h5></a>
        <a href="?category=ຕະກຸດ" class="category-link"><h5 class="news-title">ຕະກຸດ</h5></a>
        <a href="?category=ຜ້າຍັນ" class="category-link"><h5 class="news-title">ຜ້າຍັນ</h5></a>
        <a href="?category=ອົງລອຍ" class="category-link"><h5 class="news-title">ອົງລອຍ</h5></a>
        <a href="?category=ພຣະເນື້ອຜົງ" class="category-link"><h5 class="news-title">ພຣະເນື້ອຜົງ</h5></a>
      </div>

      <div class="col-8 box">
        <?php
        include("config.php");
        $role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

        // Get the selected category and search query from the query parameters
        $category = isset($_GET['category']) ? $_GET['category'] : '';
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // Modify the SQL query to filter by the selected category and search query if provided
        $sql = "SELECT amuletsell.*, seller.store_name, seller.seller_id
                FROM amuletsell 
                JOIN seller ON amuletsell.seller_id = seller.seller_id
                WHERE 1";

        if ($category) {
            $sql .= " AND amuletsell.amuletGroup = '$category'";
        }

        if ($search) {
            $sql .= " AND amuletsell.amulet_sell_name LIKE '%$search%'";
        }

        $result = $conn->query($sql);
        ?>

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
                <a class="store-name" href="store_detail.php?seller_id=<?php echo $row['seller_id']; ?>"><i class="fa-solid fa-house"></i>&nbsp;<?php echo $row['store_name']; ?></a>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p>ບໍ່ມີພຣະເຄື່ອງໃນໝວດໝູ່ນີ້.</p>
        <?php endif; ?>
      </div>
      <div class="col" style="margin-top:20px">
        <h5 class="text-center">ຂ່າວສານປະຊາສຳພັນ</h5>
        <p class="news-title"><a href="" class="category">ໂປຣໂມຊັ່ນພິເສດ!! ສຳລັບລູກຄ້າທີ່ເປີດຮ້ານໃໝ່ພາຍໃນເດືອນຕຸລານີ້ແມ່ນຈະໄດ້ຮັບສ່ວນຫຼຸດ 30% ໃນການເປີດຮ້ານໃໝ່</a></p>
        <p class="news-title"><a href="" class="category">ສຳລັບລູກຄ້າທີ່ເປີດຮ້ານໃໝ່ພາຍໃນເດືອນຕຸລານີ້ແມ່ນຈະໄດ້ຮັບສ່ວນຫຼຸດ 30% </a></p>
        <p class="news-title"><a href="" class="category">ໂປຣໂມຊັ່ນພິເສດ!! ສຳລັບລູກຄ້າທີ່ເປີດຮ້ານໃໝ່ພາຍໃນເດືອນຕຸລານີ້ແມ່ນຈະໄດ້ຮັບສ່ວນຫຼຸດ 30% ໃນການເປີດຮ້ານໃໝ່</a></p>
      </div>
    </div>
  </div>
</body>
<br>
<?php include('footer.php') ?>
</html>

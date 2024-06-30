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
  include('../config.php');

  // Assuming user_id is stored in the session after login
  if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user_id is not set
    header('Location: login.php');
    exit();
  }

  $user_id = $_SESSION['user_id'];

  $sql = "SELECT s.*, u.telephone 
          FROM seller s 
          INNER JOIN user u ON s.user_id = u.user_id 
          WHERE s.user_id = '$user_id'";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $store_name = $row['store_name'];
    $seller_id = $row['seller_id'];
    $seller_address = $row['seller_address'];
    $telephone = $row['telephone'];
    $description = $row['description'];
  } else {
    // Handle the case where no seller data is found for the logged-in user
    echo "<p>No seller data found for the logged-in user.</p>";
    exit();
  }

  $sql2 = "SELECT a.*
           FROM amuletsell a
           INNER JOIN seller s ON a.seller_id = s.seller_id
           WHERE s.user_id = '$user_id'";

  $result2 = mysqli_query($conn, $sql2);
  $amulets = array();

  if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
      $amulets[] = $row;
    }
  }

  $sql_auction = "SELECT * FROM auction WHERE seller_id = '$seller_id'";
  $result_auction = mysqli_query($conn, $sql_auction);
  $amulets_auction = array();
  $current_time = date('Y-m-d H:i:s');

  while ($row = mysqli_fetch_assoc($result_auction)) {
    $auction_end_time = date('Y-m-d H:i:s', strtotime($row['amulet_auction_date'] . ' + ' . $row['countdown_days'] . ' days'));
    if ($current_time >= $auction_end_time && $row['auction_status'] !== 'ປິດປະມູນ') {
      $auction_id = $row['auction_id'];
      $highest_bid_sql = "SELECT user_id FROM auctionlist WHERE auction_id = $auction_id ORDER BY auction_price DESC LIMIT 1";
      $highest_bid_result = mysqli_query($conn, $highest_bid_sql);
      $highest_bid_user_id = (mysqli_num_rows($highest_bid_result) > 0) ? mysqli_fetch_assoc($highest_bid_result)['user_id'] : null;

      $update_sql = "UPDATE auction SET auction_status = 'ປິດປະມູນ', user_id = '$highest_bid_user_id' WHERE auction_id = $auction_id";
      mysqli_query($conn, $update_sql);
      $row['auction_status'] = 'ປິດປະມູນ';
      $row['user_id'] = $highest_bid_user_id;
    }
    $amulets_auction[] = $row;
  }

  mysqli_close($conn);
  ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-3 bg-light rounded text-dark text-center" style="margin: 0 auto; background-image: linear-gradient(to bottom right, #fcc200, #f7e98e);">
        <img class="market-img mt-5" src="../img/store.jpeg" alt="" width="150px"><br><br>
        <h4><?php echo $store_name; ?></h4>
        <h6 class="border border-light rounded">shop ID : <?php echo $seller_id; ?></h6>
        <p>ທີ່ຢູ່ : <?php echo $seller_address; ?></p>
        <p class="border border-light rounded">ຕິດຕໍ່: <span><?php echo $telephone; ?></span></p>
        <p><?php echo $description; ?></p>
      </div>

      <div class="col-8">
        <div class="row">
          <h4 class="mt-3">ພຣະເດັ່ນປະຈຳຮ້ານ</h4>
        </div>
        <div class="row">
          <?php
          $counter = 0;
          foreach ($amulets as $amulet) {
            if ($counter < 6) {
              echo '<div class="col-2 text-center store-box">';
              echo '<span>';
              echo '<img class="top-amulet-store-img" src="./' . $amulet['amulet_sell_img'] . '" alt="">';
              echo '</span>';
              echo '<div class="store-details">';
              echo '<h6>' . $amulet['amulet_sell_name'] . '</h6>';
              if ($amulet['amulet_sell_status'] == 'ForSale') {
                echo '<p class="text-success"> ພ້ອມເຊົ່າ </p>';
              } elseif ($amulet['amulet_sell_status'] == 'Sold') {
                echo '<p class="text-danger">ຂາຍແລ້ວ</p>';
              } elseif ($amulet['amulet_sell_status'] == 'ForShow') {
                echo '<p class="text-warning">ພຣະໂຊ</p>';
              } else {
                echo '<p>' . $amulet['amulet_sell_status'] . '</p>';
              }
              echo '</div>';
              echo '</div>';
              $counter++;
            }
          }
          ?>
        </div>
        <hr>
        <div class="row">
          <h4 class="">ລາຍການພຣະເຄື່ອງໃນຮ້ານ</h4>
          <?php
          foreach ($amulets as $amulet) {
            echo '<div class="col-2 text-center store-box">';
            echo '<span>';
            echo '<img class="top-amulet-store-img" src="./' . $amulet['amulet_sell_img'] . '" alt="">';
            echo '</span>';
            echo '<div class="store-details">';
            echo '<h6>' . $amulet['amulet_sell_name'] . '</h6>';
            if ($amulet['amulet_sell_status'] == 'ForSale') {
              echo '<p class="text-success"> ພ້ອມເຊົ່າ </p>';
            } elseif ($amulet['amulet_sell_status'] == 'Sold') {
              echo '<p class="text-danger">ຂາຍແລ້ວ</p>';
            } elseif ($amulet['amulet_sell_status'] == 'ForShow') {
              echo '<p class="text-warning">ພຣະໂຊ</p>';
            } else {
              echo '<p>' . $amulet['amulet_sell_status'] . '</p>';
            }
            echo '</div>';
            echo '</div>';
          }
          ?>
        </div>
        <div class="row">
          <h4 class="">ລາຍການພຣະເຄື່ອງທີ່ເປີດປະມູນ</h4>
          <?php foreach ($amulets_auction as $amulet) : ?>
            <div class="col-2 text-center store-box">
              <span>
                <img class="top-amulet-store-img" src="<?php echo $amulet['amulet_auction_img']; ?>" alt="">
              </span>
              <div class="store-details">
                <h6><?php echo $amulet['amulet_auction_name']; ?></h6>
                <?php
                $statusClass = '';
                switch ($amulet['auction_status']) {
                  case 'ກຳລັງປະມູນ':
                    $statusClass = 'text-success';
                    break;
                  case 'ປິດປະມູນ':
                    $statusClass = 'text-danger';
                    break;
                  default:
                    $statusClass = '';
                    break;
                }
                echo '<p class="' . $statusClass . '">' . $amulet['auction_status'] . '</p>';
                ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

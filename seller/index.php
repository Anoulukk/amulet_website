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

  $sql = "SELECT s.*, u.telephone 
        FROM seller s 
        INNER JOIN user u ON s.user_id = u.user_id";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $store_name = $row['store_name'];
      $seller_id = $row['seller_id'];
      $seller_address = $row['seller_address'];
      $telephone = $row['telephone'];
      $description = $row['description'];
    }
  }
  $sql2 = "SELECT a.*
        FROM amuletsell a
        INNER JOIN seller s ON a.seller_id = s.seller_id
        INNER JOIN user u ON s.user_id = u.user_id";

  $result2 = mysqli_query($conn, $sql2);
  // Check if there are any results
  if (mysqli_num_rows($result2) > 0) {
    // Initialize an empty array to store amulet data
    $amulets = array();

    // Fetch each row of data and add it to the $amulets array
    while ($row = mysqli_fetch_assoc($result2)) {
      $amulets[] = $row;
    }
  } else {
    // No amulets found
    $amulets = array(); // Initialize an empty array if no results
  }
    // Fetch data for amulets being auctioned
    $sql_auction = "SELECT * FROM amuletauction";
    $result_auction = mysqli_query($conn, $sql_auction);
    $amulets_auction = array();
    if (mysqli_num_rows($result_auction) > 0) {
      while ($row = mysqli_fetch_assoc($result_auction)) {
        $amulets_auction[] = $row;
      }
    }
  

  if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
      $amulet_sell_name = $row['amulet_sell_name'];
      $amulet_sell_detail = $row['amulet_sell_detail'];
      $amulet_sell_price = $row['amulet_sell_price'];
      $amulet_sell_img = $row['amulet_sell_img'];
      $amulet_sell_status = $row['amulet_sell_status'];
      $amulet_sell_date = $row['amulet_sell_date'];
    }
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

      <div class="col-8 ">
      <div class="row">
  <h4 class="mt-3">ພຣະເດັ່ນປະຈຳຮ້ານ</h4>
</div>
<div class="row">
  <?php
  // Assuming you have fetched the data and stored it in an array called $amulets
  // Loop through the amulets array and display each amulet in a column
  $counter = 0; // Initialize a counter
 foreach ($amulets as $amulet) {
    if ($counter < 6) {
      echo '<div class="col-2 text-center store-box">';
      echo '<span>';
      echo '<img class="top-amulet-store-img" src="./' . $amulet['amulet_sell_img'] . '" alt="">';
      echo '</span>';
      echo '<div class="store-details">';
      echo '<h6>' . $amulet['amulet_sell_name'] . '</h6>';

      // Use conditional statements to set class based on amulet_sell_status
      if ($amulet['amulet_sell_status'] == 'ForSale') {
        echo '<p class="text-success"> ພ້ອມເຊົ່າ </p>';
      } elseif ($amulet['amulet_sell_status'] == 'Sold') {
        echo '<p class="text-danger">ຂາຍແລ້ວ</p>';
      } elseif ($amulet['amulet_sell_status'] == 'ForShow') {
        echo '<p class="text-warning">ພຣະໂຊ</p>';
      } else {
        // Handle other cases if needed
        echo '<p>' . $amulet['amulet_sell_status'] . '</p>';
      }

      echo '</div>';
      echo '</div>';
    }
    $counter++; // Increment the counter
  }
  ?>
</div>
<hr>
<div class="row">
  <h4 class="">ລາຍການພຣະເຄື່ອງໃນຮ້ານ</h4>
  <?php
  // Display the remaining amulets in the second row
  foreach ($amulets as $amulet) {
    // if ($counter >= 6) {
      echo '<div class="col-2 text-center store-box">';
      echo '<span>';
      echo '<img class="top-amulet-store-img" src="./' . $amulet['amulet_sell_img'] . '" alt="">';
      echo '</span>';
      echo '<div class="store-details">';
      echo '<h6>' . $amulet['amulet_sell_name'] . '</h6>';

      // Use conditional statements to set class based on amulet_sell_status
      if ($amulet['amulet_sell_status'] == 'ForSale') {
        echo '<p class="text-success"> ພ້ອມເຊົ່າ </p>';
      } elseif ($amulet['amulet_sell_status'] == 'Sold') {
        echo '<p class="text-danger">ຂາຍແລ້ວ</p>';
      } elseif ($amulet['amulet_sell_status'] == 'ForShow') {
        echo '<p class="text-warning">ພຣະໂຊ</p>';
      } else {
        // Handle other cases if needed
        echo '<p>' . $amulet['amulet_sell_status'] . '</p>';
      }

      echo '</div>';
      echo '</div>';
    // }
    $counter++; // Increment the counter
  }
  ?>

</div>
<div class="row">
  <h4 class="">ລາຍການພຣະເຄື່ອງທີ່ເປີດປະມູນ</h4>
  <?php foreach ($amulets_auction as $amulet): ?>
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
          case 'ປິດປະມູນແລ້ວ':
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

  </div>




</body>

</html>
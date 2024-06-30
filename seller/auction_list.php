<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Seller management</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  
<?php
// Start the session and include configuration
include('../config.php');
include('header.php');

// Check if the user is logged in and user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    // If user_id is not set, redirect to the login page
    header("Location: ../login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Fetch the seller_id using the user_id
$sellerQuery = "SELECT seller_id FROM seller WHERE user_id = $userId";
$sellerResult = mysqli_query($conn, $sellerQuery);
if (mysqli_num_rows($sellerResult) > 0) {
    $sellerRow = mysqli_fetch_assoc($sellerResult);
    $sellerId = $sellerRow['seller_id'];
} else {
    // If seller_id is not found, handle the error (e.g., redirect or display an error message)
    echo "Seller not found.";
    exit();
}

// Fetch auction details where auction_status is "ປິດປະມູນ" and seller_id matches the logged-in user's user_id
$sql = "SELECT a.auction_id, a.amulet_auction_name, a.auction_status, u.user_id AS winner_id, u.username AS winner_name, u.telephone AS winner_phone, al.auction_price AS winning_price 
        FROM auction a
        INNER JOIN auctionlist al ON a.auction_id = al.auction_id
        INNER JOIN user u ON al.user_id = u.user_id
        WHERE a.auction_status = 'ປິດປະມູນ' AND a.seller_id = $sellerId
        AND al.auction_price = (SELECT MAX(auction_price) FROM auctionlist WHERE auction_id = a.auction_id)
        ORDER BY a.auction_id";

$result = mysqli_query($conn, $sql);
$auctions = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $auctions[] = $row;
    }
}

mysqli_close($conn);
?>
<h3 class="text-center mt-3 mb-3">ລາຍການລູກຄ້າທີ່ຊະນະການປະມູນ</h3>
<div class="container">
    <div class="row">
      <div class="col-sm-12">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">ລຳດັບ</th>
              <th scope="col">ລະຫັດສິນຄ້າ</th>
              <th scope="col">ຊື່ສິນຄ້າ</th>
              <th scope="col">ຊື່ຜູ້ຊະນະການປະມູນ</th>
              <th scope="col">ຊະນະການປະມູນໃນລາຄາ</th>
              <th scope="col">ເບີໂທຜູ້ຊະນະການປະມູນ</th>
              <th scope="col">ລາຍລະອຽດ</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $index = 1;
            foreach ($auctions as $auction) {
                echo "<tr>";
                echo "<th scope='row'>{$index}</th>";
                echo "<td>{$auction['auction_id']}</td>";
                echo "<td>{$auction['amulet_auction_name']}</td>";
                echo "<td>{$auction['winner_name']}</td>";
                echo "<td>{$auction['winning_price']} <span>ກີບ</span></td>";
                echo "<td>{$auction['winner_phone']}</td>";
                echo "<td><a class='btn btn-sm btn-warning' href='clear_session.php?auction_id={$auction['auction_id']}'>ເຂົ້າເບິ່ງ</a></td>";
                echo "</tr>";
                $index++;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>

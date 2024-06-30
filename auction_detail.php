<?php
// Start the session
include("config.php");
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
$userId = $_SESSION['user_id'] ?? "";

if (isset($_GET['auction_id'])) {
    // Retrieve auction_id from the URL parameter
    $auction_id = $_GET['auction_id'];

    // SQL query to fetch data from the auction table
    $sql = "SELECT * FROM auction WHERE auction_id = $auction_id";
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result && $result->num_rows > 0) {
        // Fetch the data from the result set
        $row = $result->fetch_assoc();

        // Assign fetched data to variables
        $auction_title = $row['amulet_auction_name'];
        $start_bid = $row['start_bid'];
        $minimum_bid = $row['minimum_bid'];
        $countdown_days = $row['countdown_days'];
        $status = $row['auction_status'];
        $auction_detail = $row['amulet_auction_detail'];
        $large_image_path = $row['amulet_auction_img'];
        $auction_start_date = $row['amulet_auction_date'];

        // Calculate the auction end time
        $auction_end_time = date('Y-m-d H:i:s', strtotime($auction_start_date . ' + ' . $countdown_days . ' days'));

        // Calculate the remaining time in seconds
        $current_time = date('Y-m-d H:i:s');
        $remaining_time = (strtotime($auction_end_time) - strtotime($current_time)) - (5 * 3600);

        // Fetch the highest bid and the corresponding user from auctionlist and user table
        $winning_bid_sql = "SELECT al.auction_price, u.username FROM auctionlist al JOIN user u ON al.user_id = u.user_id WHERE al.auction_id = $auction_id ORDER BY al.auction_price DESC LIMIT 1";
        $winning_bid_result = $conn->query($winning_bid_sql);
        $winning_bid = $winning_bid_result->fetch_assoc();
        $winning_username = $winning_bid['username'] ?? '';
        $winning_price = $winning_bid['auction_price'] ?? '';

        // Fetch images data from the same table
        $images = array();
        $images_sql = "SELECT amulet_auction_img FROM auction WHERE auction_id = $auction_id";
        $images_result = $conn->query($images_sql);
        if ($images_result && $images_result->num_rows > 0) {
            while ($img_row = $images_result->fetch_assoc()) {
                $images[] = $img_row;
            }
        }
    } else {
        // No data found for the provided auction_id, redirect to homepage or display an error message
        header("Location: index.php");
        exit();
    }
} else {
    // Redirect to homepage or display error message if auction_id parameter is not set
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amulet Auction</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        var auctionData = {
            remaining_time: <?php echo $remaining_time; ?>,
            winning_username: "<?php echo $winning_username; ?>",
            winning_price: "<?php echo $winning_price; ?>"
        };
    </script>
    <script src="auction.js"></script>
</head>
<body>
    <?php include('header.php'); ?>
    <div id="auction-data" data-remaining-time="<?php echo $remaining_time; ?>"></div>
    <main class="container mt-4">
        <section class="auction-item">
            <div class="row">
                <span id="user_id" hidden><?php echo $userId; ?></span>
                <span id="auction_id" hidden><?php echo $auction_id; ?></span>

                <div class="col-sm-2"> <!-- Small Image Column -->
                    <!-- Dynamically set the src attribute of img elements -->
                    <?php foreach ($images as $image) : ?>
                        <img class="img-small" width="80px" data-src="./seller/<?php echo $image['amulet_auction_img']; ?>" src="./seller/<?php echo $image['amulet_auction_img']; ?>" alt="<?php echo $image['amulet_auction_img']; ?>">
                    <?php endforeach; ?>
                </div>
                <div class="col-md-6"> <!-- Large Image Column -->
                    <!-- Dynamically set the src attribute of the large image -->
                    <img src="./seller/<?php echo $large_image_path; ?>" alt="Amulet Image" width="600px" class="img-fluid" id="largeImage">
                </div>
                <div class="col-md-4">
                    <h3 class="auction-description"><b><?php echo $auction_title; ?></b></h3>
                    <hr>
                    <div class="auction-info">
                        <p class="current-bid">ລາຄາປັດຈຸບັນ: ₭<span id="current-bid"><?php echo $start_bid; ?></span></p>
                        <div class="bid-divider"></div>
                        <p class="minimum-bid">&nbsp;&nbsp;&nbsp;ປະມູນຂັ້ນຕ່ຳ: <span id="minimum-bid"><?php echo $minimum_bid; ?></span></p>
                    </div>
                    <div class="auction-status-detail">
                        <p>ເວລາທີ່ເຫຼືອ: <span <?php if ($status == "ປິດປະມູນ") echo 'hidden'; ?> id="time"></span></p>
                        <p>ສະຖານະ: <span id="status"><?php echo $status; ?></span></p>
                    </div>
                    <?php if ($role == 'user' || $role == null) : ?>
                        <a href="login.php" class="btn btn-dark" style="width: 400px;">ເຂົ້າສູ່ລະບົບ</a>
                    <?php else : ?>
                        <div class="bid-section">
                        <form id="bid-form" class="form-group">
    <div class="input-group">
        <input type="number" id="bid-amount" class="form-control" placeholder="ປ້ອນລາຄາ"  max="999999999">
        <button type="submit" id="place-bid" class="btn btn-dark">ສະເໜີລາຄາ</button>
    </div>
</form>

                        </div>
                    <?php endif; ?>
                    <div class="details">
                        <br>
                        <h5>ລາຍລະອຽດ</h5>
                        <p id="Auction-detail"><?php echo $auction_detail; ?></p>
                    </div>
                </div>
            </div>
        </section>
        <div class="bid-history mt-4">
            <div class="d-flex">
                <h3 class="mb-3 auction-end-title" style="display: none">ການປະມູນຈົບແລ້ວ </h3>
                <h3  class="winning-user-text mt-2 ms-5" id="winning-user-text" style="display: none;">ກົດເພື່ອເບິ່ງຊື່ຜູ້ຊະນະປະມູນ</h3>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ລຳດັບ</th>
                        <th>ຊື່ຄົນປະມູນ</th>
                        <th>ລາຄາປະມູນ</th>
                        <th>ວັນທີ ແລະ ເວລາປະມູນ</th>
                    </tr>
                </thead>
                <tbody id="bid-history-table">
                    <!-- Bid history rows will be added dynamically using JavaScript -->
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const bidAmountInput = document.getElementById("bid-amount");
if (bidAmountInput) {
    
    bidAmountInput.addEventListener("input", function () {
        if (this.value > 999999999) {
            this.value = 100000000;
        }
    });
}
    
});

    </script>
</body>
<?php include('footer.php') ?>

</html>

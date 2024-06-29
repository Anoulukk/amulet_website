<?php
include('config.php');
include('header.php');

$seller_id = isset($_GET['seller_id']) ? intval($_GET['seller_id']) : 0;
$reporter_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

if ($seller_id > 0) {
    // Fetch store details
    $sql = "SELECT s.*, u.telephone 
            FROM seller s 
            INNER JOIN user u ON s.user_id = u.user_id
            WHERE s.seller_id = $seller_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $store_name = $row['store_name'];
        $seller_address = $row['seller_address'];
        $telephone = $row['telephone'];
        $description = $row['description'];
    } else {
        echo "<p>Store not found</p>";
        exit;
    }

    // Fetch amulets for the store
    $sql2 = "SELECT a.*
            FROM amuletsell a
            WHERE a.seller_id = $seller_id";
    $result2 = mysqli_query($conn, $sql2);
    $amulets = mysqli_fetch_all($result2, MYSQLI_ASSOC);

    // Fetch auction details and update status if time is up
    $sql_auction = "SELECT * FROM auction WHERE seller_id = $seller_id";
    $result_auction = mysqli_query($conn, $sql_auction);
    $amulets_auction = mysqli_fetch_all($result_auction, MYSQLI_ASSOC);
    $current_time = date('Y-m-d H:i:s');

    foreach ($amulets_auction as &$amulet) {
        $auction_end_time = date('Y-m-d H:i:s', strtotime($amulet['amulet_auction_date'] . ' + ' . $amulet['countdown_days'] . ' days'));
        if ($current_time >= $auction_end_time && $amulet['auction_status'] !== 'ປິດປະມູນ') {
            $auction_id = $amulet['auction_id'];
            $highest_bid_sql = "SELECT user_id FROM auctionlist WHERE auction_id = $auction_id ORDER BY auction_price DESC LIMIT 1";
            $highest_bid_result = mysqli_query($conn, $highest_bid_sql);
            if (mysqli_num_rows($highest_bid_result) > 0) {
                $highest_bid_row = mysqli_fetch_assoc($highest_bid_result);
                $highest_bid_user_id = $highest_bid_row['user_id'];
            } else {
                $highest_bid_user_id = null;
            }

            $update_sql = "UPDATE auction SET auction_status = 'ປິດປະມູນ', user_id = '$highest_bid_user_id' WHERE auction_id = $auction_id";
            mysqli_query($conn, $update_sql);
            $amulet['auction_status'] = 'ປິດປະມູນ';
            $amulet['user_id'] = $highest_bid_user_id;
        }
    }
} else {
    echo "<p>Invalid Store ID</p>";
    exit;
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Management</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-3 bg-light rounded text-dark text-center" style="margin: 0 auto; background-image: linear-gradient(to bottom right, #fcc200, #f7e98e);">
                <img class="market-img mt-5" src="./img/amulet_pre.png" alt="" width="150px"><br><br>
                <h4><?php echo htmlspecialchars($store_name); ?></h4>
                <h6 class="border border-light rounded">shop ID : <?php echo $seller_id; ?></h6>
                <p>ທີ່ຢູ່ : <?php echo htmlspecialchars($seller_address); ?></p>
                <p class="border border-light rounded">ຕິດຕໍ່: <span><?php echo htmlspecialchars($telephone); ?></span></p>
                <p><?php echo htmlspecialchars($description); ?></p>
                <?php
                if ($reporter_id != 0) {
                ?>
                    <div class="d-flex">
                        <button class="btn btn-secondary mt-5" style="width: 300px;" id="report-store" data-toggle="modal" data-target="#reportStoreModal">ລາຍງານຮ້ານຄ້າ</button>
                        <button class="btn btn-light mt-5 ms-5" style="width: 300px;" id="score-store" data-toggle="modal" data-target="#scoreStoreModal">ໃຫ້ຄະແນນຮ້ານຄ້າ</button>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="col-8">
                <div class="row">
                    <h4 class="mt-3">ພຣະເດັ່ນປະຈຳຮ້ານ</h4>
                </div>
                <div class="row">
                    <?php foreach ($amulets as $amulet) { ?>
                        <div class="col-2 text-center store-box">
                            <span>
                                <img class="top-amulet-store-img" src="./seller/<?php echo htmlspecialchars($amulet['amulet_sell_img']); ?>" alt="">
                            </span>
                            <div class="store-details">
                                <h6><?php echo htmlspecialchars($amulet['amulet_sell_name']); ?></h6>
                                <?php
                                if ($amulet['amulet_sell_status'] == 'ForSale') {
                                    echo '<p class="text-success"> ພ້ອມເຊົ່າ </p>';
                                } elseif ($amulet['amulet_sell_status'] == 'Sold') {
                                    echo '<p class="text-danger">ຂາຍແລ້ວ</p>';
                                } elseif ($amulet['amulet_sell_status'] == 'ForShow') {
                                    echo '<p class="text-warning">ພຣະໂຊ</p>';
                                } else {
                                    echo '<p>' . htmlspecialchars($amulet['amulet_sell_status']) . '</p>';
                                }
                                ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <hr>
                <div class="row">
                    <h4 class="">ລາຍການພຣະເຄື່ອງໃນຮ້ານ</h4>
                    <?php foreach ($amulets as $amulet) { ?>
                        <div class="col-2 text-center store-box">
                            <span>
                                <img class="top-amulet-store-img" src="./seller/<?php echo htmlspecialchars($amulet['amulet_sell_img']); ?>" alt="">
                            </span>
                            <div class="store-details">
                                <h6><?php echo htmlspecialchars($amulet['amulet_sell_name']); ?></h6>
                                <?php
                                if ($amulet['amulet_sell_status'] == 'ForSale') {
                                    echo '<p class="text-success"> ພ້ອມເຊົ່າ </p>';
                                } elseif ($amulet['amulet_sell_status'] == 'Sold') {
                                    echo '<p class="text-danger">ຂາຍແລ້ວ</p>';
                                } elseif ($amulet['amulet_sell_status'] == 'ForShow') {
                                    echo '<p class="text-warning">ພຣະໂຊ</p>';
                                } else {
                                    echo '<p>' . htmlspecialchars($amulet['amulet_sell_status']) . '</p>';
                                }
                                ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <h4 class="">ລາຍການພຣະເຄື່ອງທີ່ເປີດປະມູນ</h4>
                    <?php foreach ($amulets_auction as $amulet) { ?>
                        <div class="col-2 text-center store-box">
                            <span>
                                <img class="top-amulet-store-img" src="./seller/<?php echo htmlspecialchars($amulet['amulet_auction_img']); ?>" alt="">
                            </span>
                            <div class="store-details">
                                <h6><?php echo htmlspecialchars($amulet['amulet_auction_name']); ?></h6>
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
                                echo '<p class="' . $statusClass . '">' . htmlspecialchars($amulet['auction_status']) . '</p>';
                                ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <!-- Modal for Report Store -->
        <div class="modal fade" id="reportStoreModal" tabindex="-1" aria-labelledby="reportStoreModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reportStoreModalLabel">ລາຍງານຮ້ານຄ້າ</h5>
                        <button type="button" class="close btn btn-light" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="reportForm" action="report_store.php" method="post">
                            <div class="form-group">
                                <label for="reportDetail">ລາຍລະອຽດ</label>
                                <input type="text" class="form-control" id="reportDetail" name="reportDetail" rows="3" required>
                            </div>
                            <input type="hidden" name="reporter_id" value="<?php echo $reporter_id; ?>">
                            <input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>">
                            <button type="submit" class="btn btn-primary mt-3" style="margin-left: 90%;">ສົ່ງ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Score Store -->
        <div class="modal fade" id="scoreStoreModal" tabindex="-1" aria-labelledby="scoreStoreModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scoreStoreModalLabel">ໃຫ້ຄະແນນຮ້ານຄ້າ</h5>
                        <button type="button" class="close btn btn-light" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="scoreForm" action="score_store.php" method="post">
                            <div class="form-group">
                                <label for="scoreNumber">ຄະແນນ</label>
                                <select class="form-control" id="scoreNumber" name="scoreNumber" required>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <label for="scoreDetail">ລາຍລະອຽດ</label>
                                <input type="text" class="form-control" id="scoreDetail" name="scoreDetail" rows="3" required>
                            </div>
                            <input type="hidden" name="rater_id" value="<?php echo $reporter_id; ?>">
                            <input type="hidden" name="receiver_id" value="<?php echo $seller_id; ?>">
                            <button type="submit" class="btn btn-primary mt-3" style="margin-left: 90%;">ສົ່ງ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
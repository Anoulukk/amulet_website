<?php
// Start the session and include database configuration
include("../config.php");

// Query to get the total number of users
$sql = "SELECT COUNT(user_id) as total_users FROM user";
$result = $conn->query($sql);
$total_users = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_users = $row['total_users'];
}
// Query to get the total amount of items in amulet_user_pre_amount
$sql2 = "SELECT SUM(amulet_user_pre_amount) as total_items FROM preorderlist";
$result2 = $conn->query($sql2);
$total_items = 0;
if ($result2->num_rows > 0) {
    $row2 = $result2->fetch_assoc();
    $total_items = $row2['total_items'];
}
// Query to get the total number of sellers
$sql3 = "SELECT COUNT(seller_id) as total_sellers FROM seller";
$result3 = $conn->query($sql3);
$total_sellers = 0;
if ($result3->num_rows > 0) {
    $row3 = $result3->fetch_assoc();
    $total_sellers = $row3['total_sellers'];
}
// Query to get the total number of orders
$sql4 = "SELECT COUNT(orderamulet_id) as total_orders FROM orderamulet";
$result4 = $conn->query($sql4);
$total_orders = 0;
if ($result4->num_rows > 0) {
    $row4 = $result4->fetch_assoc();
    $total_orders = $row4['total_orders'];
}
// Query to get the total number of auctions
$sql5 = "SELECT COUNT(auction_id) as total_auctions FROM auction";
$result5 = $conn->query($sql5);
$total_auctions = 0;
if ($result5->num_rows > 0) {
    $row5 = $result5->fetch_assoc();
    $total_auctions = $row5['total_auctions'];
}
?>


    <div class="container mt-5">
        <div class="row">
            <div class="d-flex flex-wrap ">
                <div class="card mb-3 me-3 border-warning">
                    <div class="card-body text-center">
                        <h5 class="card-title">ຈຳນວນສະມາຊິກ</h5>
                        <p class="card-text "><?php echo $total_users; ?></p>
                        <p class="card-text"><small class="text-body-secondary">ອັບເດດເມື່ອ 4 ອາທິດກ່ອນ</small></p>
                    </div>
                </div>
                <!-- Repeat similar structure for other cards -->
                <div class="card mb-3 me-3 border-warning">
                    <div class="card-body text-center">
                        <h5 class="card-title">ຈຳນວນພຣະທີ່ຖືກຈອງ</h5>
                        <p class="card-text"><?php echo $total_items; ?></p>
                        <p class="card-text"><small class="text-body-secondary">ອັບເດດເມື່ອ 4 ອາທິດກ່ອນ</small></p>
                    </div>
                </div>
                <div class="card mb-3 me-3 border-warning">
                    <div class="card-body text-center">
                        <h5 class="card-title">ຈຳນວນຮ້ານຂາຍພຣະ</h5>
                        <p class="card-text"><?php echo $total_sellers; ?></p>
                        <p class="card-text"><small class="text-body-secondary">ອັບເດດເມື່ອ 4 ອາທິດກ່ອນ</small></p>
                    </div>
                </div>
                <div class="card mb-3 me-3 border-warning">
                    <div class="card-body text-center">
                        <h5 class="card-title">ຈຳນວນພຣະທີ່ຂາຍໄດ້</h5>
                        <p class="card-text"><?php echo $total_orders; ?></p>
                        <p class="card-text"><small class="text-body-secondary">ອັບເດດເມື່ອ 4 ອາທິດກ່ອນ</small></p>
                    </div>
                </div>
                <div class="card mb-3 me-3 border-warning">
                    <div class="card-body text-center">
                        <h5 class="card-title">ຈຳນວນພຣະທີ່ປະມູນ</h5>
                        <p class="card-text"><?php echo $total_auctions; ?></p>
                        <p class="card-text"><small class="text-body-secondary">ອັບເດດເມື່ອ 4 ອາທິດກ່ອນ</small></p>
                    </div>
                </div>
                

                <!-- Add more cards as needed -->
            </div>
        </div>
    </div>


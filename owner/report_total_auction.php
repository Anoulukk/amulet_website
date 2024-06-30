<?php
// Start the session and include database configuration
include("../config.php");

// Function to get the highest bid for a specific user in an auction
function getHighestBid($conn, $userId, $auctionId) {
    $sql = "SELECT MAX(auction_price) AS highest_bid 
            FROM auctionlist 
            WHERE user_id = ? AND auction_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userId, $auctionId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['highest_bid'] ? $row['highest_bid'] : 0;
}

// Fetch data from the auction table
$sql = "SELECT a.*, s.store_name 
        FROM auction a
        INNER JOIN seller s ON a.seller_id = s.seller_id";
$result = $conn->query($sql);
?>
 <div class="container">
        <div class="row">
            <h4 class="mt-3 ">ລາຍງານຍອດການປະມູນ</h4>
            <h5 class="text-danger">ມີທັງໝົດ <?php echo $result->num_rows; ?> ລາຍການ</h5>
        </div>
        <div class="row">
            <hr>
            <div class="row">
                <h4 class="">ລາຍການປະມູນ</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ລຳດັບ</th>
                            <th scope="col">ຊື່ສິນຄ້າ</th>
                            <th scope="col">ວັນທີ່ປະມູນ</th>
                            <th scope="col">ຮ້ານຄ້າ</th>
                            <th scope="col">ລາຄາເລີ່ມຕົ້ນ</th>
                            <th scope="col">ລາຄາສູງສຸດ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $index = 1;
                        while($row = $result->fetch_assoc()) { 
                            $highestBid = getHighestBid($conn, $row['user_id'], $row['auction_id']);
                        ?>
                            <tr>
                                <th scope="row"><?php echo $index++; ?></th>
                                <td><?php echo htmlspecialchars($row['amulet_auction_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['amulet_auction_date']); ?></td>
                                <td><?php echo htmlspecialchars($row['store_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['start_bid']); ?></td>
                                <td><?php echo htmlspecialchars($highestBid); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
// Start the session
include("config.php");
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

// SQL query to fetch data from the seller table
$sql = "SELECT auction.*, seller.store_name 
        FROM auction 
        JOIN seller ON auction.seller_id = seller.seller_id";
$result = $conn->query($sql);

$auctions = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $auctions[] = $row;
    }
}
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
    <div class="container text-left">
        <div class="row">
            <div class="col">
            </div>
            <div class="col-8" style="margin-top: 20px">
                <div class="input-group">
                    <input type="text" id="search" class="form-control" placeholder="ຄົ້ນຫາພຣະເຄື່ອງ">
                    <button type="submit" id="search-btn" class="btn btn-dark">ຄົ້ນຫາ</button>
                </div>
            </div>

            <div class="col">
            </div>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h3 class="left">ລາຍການປະມູນທັງໝົດ</h3>
            <div>
                <a class="category-btn" data-status="all">ທັງໝົດ</a>
                <a class="category-btn" data-status="ກຳລັງປະມູນ">ກຳລັງປະມູນ</a>
                <a class="right category-btn" data-status="ປິດປະມູນ">ປິດປະມູນ</a>
            </div>
        </div>



        <div class="container">
    <div class="col-16 box">
    <?php foreach ($auctions as $auction): ?>
                    <div class="col-3 text-center auction-box" data-status="<?php echo $auction['auction_status']; ?>" data-name="<?php echo $auction['amulet_auction_name']; ?>">
                        <a href="auction_detail.php?auction_id=<?php echo $auction['auction_id']; ?>"><img class="img-auction" src="./seller/<?php echo $auction['amulet_auction_img']; ?>" alt=""></a>
                        <div>
                            <h6 class="auction-status"><?php echo $auction['auction_status']; ?></h6>
                            <p><b><?php echo $auction['amulet_auction_name']; ?></b></p>
                            <p>ລາຄາເລີ່ມຕົ້ນ : <span><?php echo $auction['start_bid']; ?> ກີບ</span></p>
                            <a class="browse-store" href="auction_detail.php?auction_id=<?php echo $auction['auction_id']; ?>"><i class="fa-solid fa-house"></i>&nbsp;<?php echo $auction['store_name']; ?></a><br><br>
                            <a class="browse-auction" href="auction_detail.php?auction_id=<?php echo $auction['auction_id']; ?>">ເຂົ້າເບິ່ງ</a>
                        </div>
                    </div>
                <?php endforeach; ?>
    </div>
</div>

    </div>

    </div>
    <script>
        let auctionStatusList = document.querySelectorAll('.auction-status');
        // Loop through each element
        auctionStatusList.forEach(auctionStatus => {
            // Check if the text content matches "ປິດປະມູນ"
            console.log(auctionStatus.textContent);
            if (auctionStatus.textContent.trim() === "ປິດປະມູນ") {
                auctionStatus.style.color = "red"; // Change the color to red
            } else if (auctionStatus.textContent.trim() === "ກຳລັງປະມູນ") {
                auctionStatus.style.color = "green"; // Change the color to red

            }
        });

 document.addEventListener('DOMContentLoaded', function() {
            const categoryBtns = document.querySelectorAll('.category-btn');
            const searchInput = document.getElementById('search');
            const searchBtn = document.getElementById('search-btn');
            const auctionBoxes = document.querySelectorAll('.auction-box');

            function filterAuctions(status) {
                auctionBoxes.forEach(box => {
                    const auctionStatus = box.getAttribute('data-status');
                    box.hidden = !(status === 'all' || auctionStatus === status);
                });
            }

            function searchAuctions(query) {
                auctionBoxes.forEach(box => {
                    const auctionName = box.getAttribute('data-name').toLowerCase();
                    box.hidden = !auctionName.includes(query.toLowerCase());
                });
            }

            categoryBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const status = btn.getAttribute('data-status');
                    filterAuctions(status);
                });
            });

            searchBtn.addEventListener('click', () => {
                const query = searchInput.value;
                searchAuctions(query);
            });

            searchInput.addEventListener('keyup', () => {
                const query = searchInput.value;
                searchAuctions(query);
            });

            filterAuctions('all'); // Default to show all auctions
        });
    </script>
</body><br>
<?php include('footer.php') ?>

</html>
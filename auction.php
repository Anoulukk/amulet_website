<?php
// Start the session
include("config.php");
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

// SQL query to fetch data from the seller table
$sql = "SELECT * FROM auction";
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
                <a class="category-btn">ທັງໝົດ</a>
                <a class="category-btn">ກຳລັງປະມູນ</a>
                <a class="right category-btn" href="#">ປິດປະມູນ</a>
            </div>
        </div>



        <div class="container">
    <div class="col-16 box">
        <?php
        // Check if there are rows returned from the query
        if ($result->num_rows > 0) {
            // Loop through each row of the result set
            while($row = $result->fetch_assoc()) {
                echo '<div class="col-3 text-center auction-box">';
                echo '<a href="auction_detail.php?auction_id=' . $row["auction_id"] . '"><img class="img-auction" src="./seller/' . $row["amulet_auction_img"] . '" alt=""></a>';
                echo '<div>';
                echo '<h6 class="auction-status">' . $row["auction_status"] . '</h6>';
                echo '<p><b>' . $row["amulet_auction_name"] . '</b></p>';
                echo '<p>ລາຄາເລີ່ມຕົ້ນ : <span>' . $row["start_bid"] . ' ກີບ</span></p>';
                echo '<a class="browse-store" href="#"><i class="fa-solid fa-house"></i>&nbsp;ຮ້ານມອດຊີ້ພະເຄື່ອງ</a><br><br>';
                echo '<a class="browse-auction" href="auction_detail.php?auction_id=' . $row["auction_id"] . '">ເຂົ້າເບິ່ງ</a>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>No auctions found</p>";
        }
        ?>
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


        let a = document.querySelectorAll('.browse-store');
        a.forEach(as => {
            as.addEventListener('click', () => {
                console.log("sus");
            })
        })
    </script>
</body><br>
<?php include('footer.php') ?>

</html>
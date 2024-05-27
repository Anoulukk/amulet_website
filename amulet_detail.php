<?php
// Start the session
include("config.php");
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
echo ($role);

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $amulet_id = intval($_GET['id']);

    // Fetch the amulet details from the database
    $sql = "SELECT amuletsell.*, seller.store_name 
            FROM amuletsell 
            JOIN seller ON amuletsell.seller_id = seller.seller_id 
            WHERE amuletsell.amulet_sell_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $amulet_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the amulet exists
    if ($result->num_rows > 0) {
        $amulet = $result->fetch_assoc();
    } else {
        echo "Amulet not found.";
        exit();
    }
} else {
    echo "Invalid ID.";
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
</head>

<body>
    <?php include('header.php'); ?>

    <main class="container mt-4">
        <section class="auction-item">
            <div class="row">
                <div class="col-sm-2"> <!-- Small Image Column -->
                    <img class="img-small" width="80px" data-src="seller/<?php echo $amulet['amulet_sell_img']; ?>" src="seller/<?php echo $amulet['amulet_sell_img']; ?>" alt="Small Image 1">
                </div>
                <div class="col-md-6"> <!-- Large Image Column -->
                    <img src="seller/<?php echo $amulet['amulet_sell_img']; ?>" alt="Amulet Image" width="600px" class="img-fluid" id="largeImage">
                </div>
                <div class="col-md-4">
                    <h3 class="auction-description"><b><?php echo $amulet['amulet_sell_name']; ?></b></h3>
                    <hr>
                    <div class="amulet-status">
                        <h6 class="amulet-status">ລາຄາ:&nbsp;<span><?php echo $amulet['amulet_sell_price']; ?></span></h6>
                        <h6 class="amulet-status">ໝວດໝູ່:&nbsp;<span><?php echo $amulet['amuletGroup']; ?></span></h6>
                        <h6 class="amulet-status">ສະຖານະ:&nbsp;
                            <span id="status" style="color: <?php echo ($amulet['amulet_sell_status'] == 'ForSale') ? 'green' : '#da9100'; ?>">
                                <?php echo ($amulet['amulet_sell_status'] == 'ForSale') ? 'ພ້ອມເຊົ່າ' : 'ເຊົ່າແລ້ວ'; ?>
                            </span>
                        </h6>
                    </div><br>
                    <!-- Check the role and display buttons accordingly -->
                    <?php if ($role === 'buyer' && $amulet['amulet_sell_status'] == 'ForSale') : ?>
                        <button id="requestToOrder" class="btn btn-dark" style="width: 400px;">ກົດເພື່ອຂໍສັ່ງຊື້</button>
                    <?php elseif ($amulet['amulet_sell_status'] == 'Sold') : ?>
                    <?php else : ?>
                        <a href="login.php" class="btn btn-dark" style="width: 400px;">ເຂົ້າສູ່ລະບົບ</a>
                    <?php endif; ?>
                    <div class="details"><br>
                        <h5>ລາຍລະອຽດ</h5>
                        <p id="Auction-detail"><?php echo nl2br($amulet['amulet_sell_detail']); ?></p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hidden form to submit the order -->
        <!-- <?php echo $_SESSION['user_id']; ?> -->
        <form id="orderForm" action="order_amulet.php" method="POST" style="display: none;">
            <input type="hidden" name="amulet_sell_id" value="<?php echo $amulet['amulet_sell_id']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            <input type="hidden" name="orderamulet_qty" value="1"> <!-- Assuming quantity is 1 for this example -->
            <input type="hidden" name="seller_id" value="<?php echo $amulet['seller_id']; ?>"> <!-- Assuming quantity is 1 for this example -->
        </form>
    </main><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const largeImage = document.getElementById("largeImage");
        const smallImages = document.querySelectorAll(".img-small");
        const span = document.getElementById("status");
        document.getElementById("requestToOrder").addEventListener("click", function() {
            Swal.fire({
                title: 'ສັ່ງຊື້',
                text: 'ທ່ານຕ້ອງການສັ່ງຊື້ບໍ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'ຢືນຢັນ',
                cancelButtonText: 'ຍົກເລີກ'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('orderForm').submit();
                }
            });
        });
        if (span.innerText === "ພ້ອມເຊົ່າ") {
            span.style.color = "green";
        } else if (span.innerText === "ເຊົ່າແລ້ວ") {
            span.style.color = "#da9100";
        } else {
            span.style.color = "#cc0000";
        }
        // Add click event listeners to the small images
        smallImages.forEach((smallImage) => {
            smallImage.addEventListener("click", () => {
                const newImageSrc = smallImage.getAttribute("data-src");
                // Set the large image source to the new image
                largeImage.src = newImageSrc;
            });
        });
    </script>
</body>
<?php include('footer.php'); ?>

</html>

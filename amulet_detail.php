<?php
// Start the session
include("config.php");
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
echo ($role);


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
                    <img class="img-small" width="80px" data-src="./img/skd.png" src="./img/skd.png" alt="Small Image 1">
                    <img class="img-small" width="80px" data-src="./img/pha.jpg" src="./img/pha.jpg" alt="Small Image 2">
                    <img class="img-small" width="80px" data-src="./img/saisana.jpg" src="./img/saisana.jpg" alt="Small Image 3">
                    <img class="img-small" width="80px" data-src="./img/amulet.jpg" src="./img/amulet.jpg" alt="Small Image 4">
                    <img class="img-small" width="80px" data-src="./img/saisana.jpg" src="./img/saisana.jpg" alt="Small Image 4">
                </div>
                <div class="col-md-6"> <!-- Large Image Column -->
                    <img src="./img/skd.png" alt="Amulet Image" width="600px" class="img-fluid" id="largeImage">
                </div>
                <div class="col-md-4">
                    <h3 class="auction-description"><b>ຫລຽນພຣະຊາຄຳແດງ 1970</b></h3>
                    <hr>
                    <div class="amulet-status">
                        <h6 class="amulet-status">ລາຄາ:&nbsp;<span>5,000,000</span></h6>
                        <h6 class="amulet-status">ໝວດໝູ່:&nbsp;<span>ພຣະກິ່ງ</span></h6>
                        <h6 class="amulet-status">ສະຖານະ:&nbsp;<span id="status">ພ້ອມເຊົ່າ</span></h6>
                    </div><br>
                    <!-- Check the role and display buttons accordingly -->
                    <?php if ($role === 'buyer') : ?>
                        <button id="requestToOrder" class="btn btn-dark" style="width: 400px;">ກົດເພື່ອຂໍສັ່ງຊື້</button>
                    <?php else : ?>
                        <a href="login.php" class="btn btn-dark" style="width: 400px;">ເຂົ້າສູ່ລະບົບ</a>
                    <?php endif; ?>
                    <div class="details"><br>
                        <h5>ລາຍລະອຽດ</h5>
                        <p id="Auction-detail">ພຣະກິ່ງຍອດທຸງໄຊ : ສ້າງທີ່ວັດໂພນໄຊ ປຸກເສກທີ່ວັດຈະເລີນໄຊ<br>
                            ສ້າງໂດຍ : ທີມງານໄວລຸ້ນສະສົມພຣະເຄື່ອງ<br>
                            ພຣະກິ່ງສ້າງເມື່ອວັນທີ່ 12 /8/2023 <br>
                            ມີຫຼາຍພຣະອາຈານ ແລະ ເກຈິເຂົ້າຮ່ວມຄື : <br>
                            ພຣະຄູ ໜູແອ່ງ ຈັນທະປັນໂຍ (ເປັນພຣະປະທານເປີດງານ) <br>
                            ພຣະຄູ ນ່ອງ ວັດຈະເລີນໄຊ <br>
                            ມີຫຼາຍພຣະອາຈານ ແລະ ເກຈິເຂົ້າຮ່ວມຄື : <br>
                            ພຣະຄູ ໜູແອ່ງ ຈັນທະປັນໂຍ (ເປັນພຣະປະທານເປີດງານ) <br>
                            ພຣະຄູ ນ່ອງ ວັດຈະເລີນໄຊ <br>
                            ຍາຄຣູ ສົດ ວັດໜອງໄຮນ້ອຍ <br>
                            ຍາຄຣູ ແບ້ ວັດໂຄດົມສີວຽງໄຊ <br>
                            ຍາຄຣູ ກິ ວັດປ່າທ່າງ່ອນ <br>
                            ຄູບາ ແດງ ວັດໄຊຊົມຊື່ນ <br>
                            ຍາຄຣູ ແອ ວັດພູເຂົາຄວາຍ ແລະ ພຣະສົງອື່ນໆທີ່ເຂົ້າຮ່ວມພິທີໃນຄັ້ງນີ້ <br>
                        </p>

                    </div>
                </div>

            </div>
        </section>
    </main><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const largeImage = document.getElementById("largeImage");
        const smallImages = document.querySelectorAll(".img-small");
        const span = document.getElementById("status");
        document.getElementById("requestToOrder").addEventListener("click", function() {
            Swal.fire({
                title: 'ສັ່ງຊື້',
                text: 'ທ່ານເຈົ້າຕ້ອງການສັ່ງຊື້ບໍ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'ຢືນຢັນ',
                cancelButtonText: 'ຍົກເລີກ'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "user_activity.php";
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
<?php include('footer.php') ?>

</html>
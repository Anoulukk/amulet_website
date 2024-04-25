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
                    <img class="img-small" width="80px" data-src="./img/amulet.jpg" src="./img/amulet.jpg" alt="Small Image 1">
                    <img class="img-small" width="80px" data-src="./img/pha.jpg" src="./img/pha.jpg" alt="Small Image 2">
                    <img class="img-small" width="80px" data-src="./img/saisana.jpg" src="./img/saisana.jpg" alt="Small Image 3">
                    <img class="img-small" width="80px" data-src="./img/amulet.jpg" src="./img/amulet.jpg" alt="Small Image 4">
                    <img class="img-small" width="80px" data-src="./img/saisana.jpg" src="./img/saisana.jpg" alt="Small Image 4">
                </div>
                <div class="col-md-6"> <!-- Large Image Column -->
                    <img src="./img/saisana.jpg" alt="Amulet Image" width="600px" class="img-fluid" id="largeImage">
                </div>
                <div class="col-md-4">
                    <h3 class="auction-description"><b>ຫຼຽນໄຊຊະນະ ມີໂຊກ</b></h3>
                    <hr>
                    <div class="auction-info">
                        <p class="current-bid">ລາຄາປັດຈຸບັນ: $<span id="current-bid"></span></p>
                        <div class="bid-divider"></div>
                        <p class="minimum-bid">&nbsp;&nbsp;&nbsp;ປະມູນຂັ້ນຕ່ຳ: <span id="minimum-bid"></span></p>
                    </div>
                    <div class="auction-status-detail">

                        <p>ເວລາທີ່ເຫຼືອ: <span id="countdown"></span></p>
                        <p>ສະຖານະ: <span id="status">ກຳລັງປະມູນ</span></p>
                    </div>
                    <?php if ($role === 'user') : ?>
                        <a href="login.php" class="btn btn-dark" style="width: 400px;">ເຂົ້າສູ່ລະບົບ</a>
                    <?php else : ?>
                        <div class="bid-section">
                            <form id="bid-form" class="form-group">
                                <div class="input-group">
                                    <input type="number" id="bid-amount" class="form-control" placeholder="ປ້ອນລາຄາ" step="100">
                                    <button type="submit" id="place-bid" class="btn btn-dark">ສະເໜີລາຄາ</button>
                                </div>
                            </form>
                        </div>
                    <?php endif; ?>
                    <div class="details">
                        <br>
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
        <div class="bid-history mt-4">

            <h3 class="mb-3 auction-end-title" style="display: none">ການປະມູນຈົບແລ້ວ</h3>
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
            <p class="winning-user-text" id="winning-user-text" style="display: none;">ກົດເພື່ອເບິ່ງຊື່ຜູ້ຊະນະປະມູນ</p>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
<?php include('footer.php') ?>

</html>
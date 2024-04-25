<?php
// Start the session
include("config.php");
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
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
                <div class="col-3 text-center auction-box">
                    <a href="auction_detail.php"><img class="img-auction" src="./img/skd.png" alt="" ></a>
                    
                    <div class="">
                        <h6 class="auction-status">ກຳລັງປະມູນ</h6>
                        <p><b>ຫລຽນພຣະຊາຄຳແດງ 1970</b></p>
                        <p>ລາຄາປັດຈຸບັນ : <span>5,000,000 ກີບ</span></p>
                    <a class="browse-store" href="#"><i class="fa-solid fa-house"></i>&nbsp;ຮ້ານມອດຊີ້ພະເຄື່ອງ</a><br><br>

                        <a class="browse-auction" href="auction_detail.php">ເຂົ້າເບິ່ງ</a>
                    </div>
                </div>
                <div class="col-3 text-center auction-box">
                    <a href="#"><img class="img-auction" src="./img/skd.png" alt="" ></a>
                    <div class="">
                        <h6 class="auction-status">ກຳລັງປະມູນ</h6>
                        <p><b>ຫລຽນພຣະຊາຄຳແດງ 1970</b></p>
                        <p>ລາຄາປັດຈຸບັນ : <span>5,000,000 ກີບ</span></p>
                    <a class="browse-store" href="#"><i class="fa-solid fa-house"></i>&nbsp;ຮ້ານມອດຊີ້ພະເຄື່ອງ</a><br><br>

                        <a class="browse-auction" href="auction_detail.php">ເຂົ້າເບິ່ງ</a>
                    </div>
                </div>
                <div class="col-3 text-center auction-box">
                    <a href="#"><img class="img-auction" src="./img/skd.png" alt="" ></a>
                    <div class="">
                        <h6 class="auction-status">ກຳລັງປະມູນ</h6>
                        <p><b>ຫລຽນພຣະຊາຄຳແດງ 1970</b></p>
                        <p>ລາຄາປັດຈຸບັນ : <span>5,000,000 ກີບ</span></p>
                    <a class="browse-store" href="#"><i class="fa-solid fa-house"></i>&nbsp;ຮ້ານມອດຊີ້ພະເຄື່ອງ</a><br><br>

                        <a class="browse-auction" href="auction_detail.php">ເຂົ້າເບິ່ງ</a>
                    </div>
                </div>
                <div class="col-3 text-center auction-box">
                    <a href="#"><img class="img-auction" src="./img/skd.png" alt="" ></a>
                    <div class="">
                        <h6 class="auction-status">ກຳລັງປະມູນ</h6>
                        <p><b>ຫລຽນພຣະຊາຄຳແດງ 1970</b></p>
                        <p>ລາຄາປັດຈຸບັນ : <span>5,000,000 ກີບ</span></p>
                    <a class="browse-store" href="#"><i class="fa-solid fa-house"></i>&nbsp;ຮ້ານມອດຊີ້ພະເຄື່ອງ</a><br><br>

                        <a class="browse-auction" href="auction_detail.php">ເຂົ້າເບິ່ງ</a>
                    </div>
                </div>
                <div class="col-3 text-center auction-box">
                    <a href="#"><img class="img-auction" src="./img/skd.png" alt="" ></a>
                    <div class="">
                        <h6 class="auction-status">ປິດປະມູນ</h6>
                        <p><b>ຫລຽນພຣະຊາຄຳແດງ 1970</b></p>
                        <p>ລາຄາປັດຈຸບັນ : <span>5,000,000 ກີບ</span></p>
                    <a class="browse-store" href="#"><i class="fa-solid fa-house"></i>&nbsp;ຮ້ານມອດຊີ້ພະເຄື່ອງ</a><br><br>

                        <a class="browse-auction" href="auction_detail.php">ເຂົ້າເບິ່ງ</a>
                    </div>
                </div>
                <div class="col-3 text-center auction-box">
                    <a href="#"><img class="img-auction" src="./img/skd.png" alt="" ></a>
                    <div class="">
                        <h6 class="auction-status">ປິດປະມູນ</h6>
                        <p><b>ຫລຽນພຣະຊາຄຳແດງ 1970</b></p>
                        <p>ລາຄາປັດຈຸບັນ : <span>5,000,000 ກີບ</span></p>
                    <a class="browse-store" href="#"><i class="fa-solid fa-house"></i>&nbsp;ຮ້ານມອດຊີ້ພະເຄື່ອງ</a><br><br>

                        <a class="browse-auction" href="auction_detail.php">ເຂົ້າເບິ່ງ</a>
                    </div>
                </div>
                <div class="col-3 text-center auction-box">
                    <a href="#"><img class="img-auction" src="./img/skd.png" alt="" ></a>
                    <div class="">
                        <h6 class="auction-status">ປິດປະມູນ</h6>
                        <p><b>ຫລຽນພຣະຊາຄຳແດງ 1970</b></p>
                        <p>ລາຄາປັດຈຸບັນ : <span>5,000,000 ກີບ</span></p>
                    <a class="browse-store" href="#"><i class="fa-solid fa-house"></i>&nbsp;ຮ້ານມອດຊີ້ພະເຄື່ອງ</a><br><br>

                        <a class="browse-auction" href="auction_detail.php">ເຂົ້າເບິ່ງ</a>
                    </div>
                </div>
                <div class="col-3 text-center auction-box">
                    <a href="#"><img class="img-auction" src="./img/skd.png" alt="" ></a>
                    <div class="">
                        <h6 class="auction-status">ປິດປະມູນ</h6>
                        <p><b>ຫລຽນພຣະຊາຄຳແດງ 1970</b></p>
                        <p>ລາຄາປັດຈຸບັນ : <span>5,000,000 ກີບ</span></p>
                    <a class="browse-store" href="#"><i class="fa-solid fa-house"></i>&nbsp;ຮ້ານມອດຊີ້ພະເຄື່ອງ</a><br><br>

                        <a class="browse-auction" href="auction_detail.php">ເຂົ້າເບິ່ງ</a>
                    </div>
                </div>
                
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
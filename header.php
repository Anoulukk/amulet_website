<?php
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
echo ($role);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./bootstrap-5.3.0-alpha3-dist/css/bootstrap.css">
    <script src="./bootstrap-5.3.0-alpha3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="styles.css">

    <style>
        #bannerImg {
            transition: opacity 1s ease-in-out;
            /* Adjust the transition timing here */
        }

        .nav-item.active .nav-link {
            border-top: 2px solid #ffd700;
            color: #ffd500;
            /* Set the active item background color */
        }
    </style>
</head>

<body>
    <div class="container-fluid" style="padding-right: 0px; padding-left: 0px; position: relative;">
        <img id="bannerImg" src="./img/banner.png" alt="" width="100%" height="200px">
        <div class="logo">
            <a href="index.php">
                <img src="./img/logo.png" alt="Your Logo" width="100%">
            </a>
        </div>
        <div class="register-btn">
            <?php if ($role === 'buyer'): ?>
                
                <a href="my_acc.php" class="btn btn-light "><span><img src="img/" alt=""></span>&nbsp;ບັນຊີຂອງຂ້ອຍ</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-warning " style=""><span><img src="img/edit_FILL0_wght400_GRAD0_opsz24.png" alt=""></span>&nbsp;ເຂົ້າສູ່ລະບົບ</a>
                <a href="my_acc.php" class="btn btn-light "><span><img src="img/" alt=""></span>&nbsp;ບັນຊີຂອງຂ້ອຍ</a>
                    
                    <?php endif; ?>

        </div>

        <nav class="navbar navbar-expand-sm justify-content-center sticky-bottom " data-bs-theme="dark" id="navbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">ໜ້າຫຼັກ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="auction.php">ລາຍການປະມູນ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="preorder.php">ລາຍການຈອງພຣະ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="store.php">ຮ້ານພຣະມາດຕະຖານ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="history.php">ປະຫວັດພຣະເຄື່ອງ</a>
                </li>
                <?php if ($role === 'buyer'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="user_activity.php">ບັນທຶກກິດຈະກຳ</a>
                    </li>
                <?php else: ?>
                    <!-- Hide this navigation item if the role is not 'buyer' -->
                <?php endif; ?>
                <?php if ($role !== 'buyer'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">ຕິດຕໍ່ພວກເຮົາ</a>
                    </li>
                <?php else: ?>
                    <!-- Hide this navigation item if the role is 'buyer' -->
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <script>
        const images = ['./img/banner.png', './img/banner2.png', './img/banner3.jpeg', './img/banner4.jpeg']; // Replace with your image paths
        let currentImageIndex = 0;
        const bannerImg = document.getElementById('bannerImg');
        const navbar = document.getElementById('navbar');
        window.onscroll = scrollbars = () => {
            let navbar = document.getElementById("navbar");
            if (document.documentElement.scrollTop > 150) {
                navbar.classList.add("fixed-navbar");
            } else {
                navbar.classList.remove("fixed-navbar");
            }
        };


        function changeImage() {
            bannerImg.style.opacity = 0;

            setTimeout(() => {
                currentImageIndex = (currentImageIndex + 1) % images.length;
                bannerImg.src = images[currentImageIndex];
                bannerImg.style.opacity = 1;
            }, 1000); // Adjust this timeout to match the transition duration
        }

        setInterval(changeImage, 5000); // Change image every 3 seconds (3000 milliseconds)

        function changeColor() {
            const navItems = document.querySelectorAll('.nav-item');
            navItems.forEach(item => {
                item.classList.remove('active');
            });


            // Get the current URL and extract the file name
            const currentURL = window.location.href;
            const fileName = currentURL.substring(currentURL.lastIndexOf("/") + 1);

            // Add condition to add 'active' class to the first nav item if the file name is 'index.php'
            if (fileName === 'index.php' || fileName == 'amulet_detail.php') {
                navItems[0].classList.add('active');
            } else if (fileName == 'auction.php' || fileName == 'auction_detail.php') {
                navItems[1].classList.add('active');
            } else if (fileName == 'preorder.php' || fileName == 'user_preorder_form.php') {
                navItems[2].classList.add('active');
            } else if (fileName == 'store.php' || fileName == 'store_detail.php') {
                navItems[3].classList.add('active');
            } else if (fileName == 'history.php') {
                navItems[4].classList.add('active');
            } else if (fileName == 'contact.php' || fileName == 'user_activity.php') {
                navItems[5].classList.add('active');
            }
        }
        changeColor()
    </script>
</body>

</html>
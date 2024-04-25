<?php
// Start the session
session_start();
echo($_SESSION['role']);
if ($_SESSION['role'] !== "admin") {
    header("Location: ../logout.php");
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../bootstrap-5.3.0-alpha3-dist/css/bootstrap.css">
    <script src="../bootstrap-5.3.0-alpha3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="../styles.css">

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
        <img id="bannerImg" src="../img/banner.png" alt="" width="100%" height="200px">
        <div class="logo">
            <a href="index.php">
                <img src="../img/logo.png" alt="Your Logo" width="100%">
            </a>
        </div>
        <div class="register-btn">
            <a href="../logout.php" class="btn" style="background-image: linear-gradient(to bottom right, #fcc200, #f7e98e);"><span></span>&nbsp;ອອກຈາກລະບົບ</a>
        </div>
        <nav class="navbar navbar-expand-sm justify-content-center sticky-bottom " data-bs-theme="dark" id="navbar">
            <ul class="navbar-nav">
            <li class="nav-item">
                    <a class="nav-link" href="index.php">ໜ້າຫຼັກ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="preorder_list.php">ລາຍການຂໍສັ່ງຈອງພຣະ</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="preorder_form.php">ເປີດຈອງພຣະເຄື່ອງ</a>
                </li>

    
                </li>
            </ul>
        </nav>
    </div>

    <script>
        const images = ['../img/banner.png', '../img/banner2.png', '../img/banner3.jpeg', '../img/banner4.jpeg']; // Replace with your image paths
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
            if (fileName === 'index.php') {
                navItems[0].classList.add('active');
            } else if (fileName == 'preorder_list.php') {
                navItems[1].classList.add('active');
            } else if (fileName == 'preorder_form.php') {
                navItems[2].classList.add('active');
            } 
        }
        changeColor()
    </script>
</body>

</html>
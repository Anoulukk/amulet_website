<?php
// Start the session
session_start();
echo( $_SESSION['role']);
if ($_SESSION['role'] !== "owner") {
    header("Location: ../logout.php");
} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>owner management</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include('header.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-sm-3 bg-light rounded text-dark text-center p-3" style="margin: 0 auto; background-image: linear-gradient(to bottom right, #fcc200, #f7e98e);height:75vh">
                <div class="col" style="margin-top: 20px;">
                    <h3>ລາຍງານ</h3>
                    <h5 class="news-title" data-report="report_user_violations.php">ລາຍງານການເຮັດຜິດກົດ</h5>
                    <h5 class="news-title" data-report="report_all_member.php">ລາຍງານຈຳນວນສະມາຊິກ</a></h5>
                    <h5 class="news-title" data-report="report_rank_seller.php">ລາຍງານການຈັດອັນດັບຜູ້ຂາຍ</a></h5>
                    <h5 class="news-title" data-report="report_total_sales.php">ລາຍງານຍອດຂາຍ</a></h5>
                    <h5 class="news-title" data-report="report_preorder.php">ລາຍງານຍອດຈອງ</a></h5>
                    <h5 class="news-title" data-report="report_total_auction.php">ລາຍງານຍອດປະມູນ</a></h5>
                    <h5 class="news-title" data-report="report_suspension_user.php">ລາຍງານຈຳນວນຜູ້ຖືກລະງັບ</a></h5>
                    <!-- Add other links with appropriate data-report attribute -->
                </div>
            </div>

            <div id="report-container" class="col ms-3 ">
                <!-- This div will hold the dynamically loaded content -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const reportContainer = document.getElementById('report-container');
            
            const links = document.querySelectorAll('.category');
            const report_button = document.querySelectorAll('.news-title');

            report_button.forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault();

                    // Remove active class from all links and news titles
                    report_button.forEach(link => {
                        link.classList.remove('active-news-title');
                    });

                    const newsTitles = document.querySelectorAll('.news-title');
                    newsTitles.forEach(title => {
                        title.classList.remove('active-news-title');
                    });

                    // Add active class to the clicked link and its parent news title
                    // this.classList.add('active-category');
                    this.closest('.news-title').classList.add('active-news-title');

                    const reportUrl = this.getAttribute('data-report');
                    loadReport(reportUrl);
                });
            });

            function loadReport(reportUrl) {
                fetch(reportUrl)
                    .then(response => response.text())
                    .then(data => {
                        reportContainer.innerHTML = data;
                    })
                    .catch(error => {
                        console.error('Error fetching the report:', error);
                    });
            }
            loadReport("report_dashboard.php");

        });
   
</script>
</body>

</html>

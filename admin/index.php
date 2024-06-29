<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin management</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include('header.php'); ?>

    <div class="container">
        <div class="row">
         

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
            loadReport("report_request_user_list.php");

        });
    function showPendingTable() {
        document.getElementById("pendingTable").style.display = "block";
        document.getElementById("activeTable").style.display = "none";
    }

    function showActiveTable() {
        document.getElementById("pendingTable").style.display = "none";
        document.getElementById("activeTable").style.display = "block";
    }
</script>
</body>

</html>

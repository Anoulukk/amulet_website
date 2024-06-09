<?php
// Start the session

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>suspensions</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include('header.php'); ?>

    <div class="container">
    <div class="row">
                    <h4 class="mt-3 ">ລາຍງານຍອດຈອງ</h4>
                    <h5 class="text-danger">ຍອດຈອງທັງໝົດມີ 2 ລາຍການ</h5>
                </div>
                <div class="row">
                    <hr>
                    <div class="row   ">
                        <h4 class="">ລາຍການຈອງ</h4>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ລຳດັບ</th>
                                    <th scope="col">ລະຫັດສິນຄ້າ</th>
                                    <th scope="col">ຊື່ສິນຄ້າ</th>
                                    <th scope="col">ຊື່ຜູ້ສັ່ງຈອງ</th>
                                    <th scope="col">ເບີໂທຜູ້ຂໍສັ່ງຈອງ</th>
                                    <th scope="col">ການຊຳລະເງີນ</th>
                                    <th scope="col">ອະນຸມັດການຈອງ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>001</td>
                                    <td>ຫລຽນພຣະຊາຄຳແດງ</td>
                                    <td>mossphakhg</td>
                                    <td>02055667789</td>
                                    <td>ຍັງບໍ່ທັນຈ່າຍ</td>
                                    <td><button class="btn btn-sm btn-warning close-sale">ອອກໃບບິນ</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>002</td>
                                    <td>ຫລຽນພຣະຊາຄຳແດງ</td>
                                    <td>mossphakhg</td>
                                    <td>02055667789</td>
                                    <td>ຈ່າຍແລ້ວ</td>
                                    <td><button class="btn btn-sm btn-warning close-sale">ອອກໃບບິນ</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            const links = document.querySelectorAll('.category');
            const reportContainer = document.getElementById('report-container');

            links.forEach(link => {
                link.addEventListener('click', function (event) {
                    event.preventDefault();
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
            loadReport("report_preorder.php");

        });
    </script>
</body>

</html>

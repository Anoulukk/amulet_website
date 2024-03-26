<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller management</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include('header.php'); ?>
    <h3 class="text-center mt-3 mb-3">ລາຍການທີ່ລູກຄ້າຂໍສັ່ງຊື້</h3>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 ">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ລຳດັບ</th>
                            <th scope="col">ລະຫັດສິນຄ້າ</th>
                            <th scope="col">ຊື່ສິນຄ້າ</th>
                            <th scope="col">ຊື່ຜູ້ຂໍສັ່ງຊື້</th>
                            <th scope="col">ເບີໂທຜູ້ຂໍສັ່ງຊື້</th>
                            <th scope="col">ປິດການຂາຍ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>001</td>
                            <td>ຫລຽນພຣະຊາຄຳແດງ</td>
                            <td>mossphakhg</td>
                            <td>02055667789</td>
                            <td><button class="btn btn-sm btn-warning close-sale">ປິດການຂາຍ</button></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>001</td>
                            <td>ຫລຽນພຣະຊາຄຳແດງ</td>
                            <td>mossphakhg</td>
                            <td>02055667789</td>
                            <td><button class="btn btn-sm btn-warning close-sale">ປິດການຂາຍ</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Add event listener to "ປິດການຂາຍ" buttons
        var closeSaleButtons = document.querySelectorAll('.close-sale');
        closeSaleButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Display SweetAlert confirmation
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, close the sale!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Closed!',
                            'The sale has been closed.',
                            'success'
                        );
                        // Add your logic to handle closing the sale here
                    }
                });
            });
        });
    </script>
</body>

</html>

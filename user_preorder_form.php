<?php
session_start();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;
$total_quantity = 0;

foreach ($cart as $item) {
    $total_quantity += $item['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PreOrder form</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.increase-quantity, .decrease-quantity').on('click', function() {
                var itemId = $(this).data('id');
                var action = $(this).data('action');
                $.ajax({
                    url: 'update_cart.php',
                    type: 'POST',
                    data: {
                        id: itemId,
                        action: action
                    },
                    success: function(response) {
                        if (response === "You can only add up to 10 items in total.") {
                            Swal.fire({
                                icon: 'error',
                                title: 'ຂໍອະໄພ...',
                                text: "ຈຳນວນພຣະທີ່ທ່ານເລືອກຄົບຕາມກຳນົດແລ້ວ",
                            });
                        } else {
                            location.reload(); // Reload the page to update the cart display
                        }
                    }
                });
            });

            $('form').on('submit', function(event) {
                if ($('#fileInput').val() === '') {
                    event.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'ຂໍອະໄພ...',
                        text: 'ກະລຸນາເລືອກຮູບສະລິບການໂອນເງິນ.',
                    });
                }
            });
        });
    </script>
</head>
<style>
    /* Made with love by Mutiullah Samim*/

    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Lao:wght@400;500&display=swap');

    html,
    body {
        background-size: cover;
        background-repeat: no-repeat;
        /* height: 100%; */
        font-family: 'Noto Sans Lao', sans-serif;
    }

    .container {
        align-content: center;
    }

    .card {
        height: 370px;
        margin-top: auto;
        margin-bottom: auto;
        width: 400px;
        border-radius: 20px;
        background-color: rgba(255, 208, 0, 0.2) !important;
    }

    .social_icon span {
        font-size: 60px;
        margin-left: 10px;
        color: #FFC312;
    }

    .social_icon span:hover {
        color: white;
        cursor: pointer;
    }

    .social_icon {
        position: absolute;
        right: 20px;
        top: -45px;
    }

    .input-group-prepend span {
        width: 50px;
        color: #000000;
        border: 0 !important;
    }

    input:focus {
        outline: 0 0 0 0 !important;
        box-shadow: 0 0 0 0 !important;
    }

    .remember {
        color: white;
    }

    .remember input {
        width: 20px;
        height: 20px;
        margin-left: 15px;
        margin-right: 5px;
    }

    .login_btn {
        color: black;
        background-color: #FFC312;
        width: 100px;
        margin-top: 20px;
    }

    #login_btn {
        width: 50%;
        margin-top: 10px;
    }

    .login_btn:hover {
        color: black;
        background-color: white;
    }

    .links {
        color: white;
    }

    .links a {
        color: #FFC312;
        margin-left: 4px;
    }
</style>

<body>
    <?php include('header.php'); ?>

    <div class="container mt-5">
        <div class="row">
            <div class="d-flex justify-content-center ">
                <div class="card" style="width: 600px;">
                    <div class="card-header text-center">
                        <h3>ລາຍການທີ່ທ່ານເລືອກ</h3>
                    </div>
                    <div class="card-body">
                        <form action="checkout.php" method="POST" enctype="multipart/form-data">
                            <?php if (!empty($cart)) : ?>
                                <?php foreach ($cart as $id => $item) : ?>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="w-50">
                                            <h5 class="form-label"><?= htmlspecialchars($item['amulet_pre_name']) ?> x<?= $item['quantity'] ?></h5>
                                        </div>
                                        <div class="">
                                            <button type="button" class="btn btn-sm btn-outline-secondary decrease-quantity" data-id="<?= $id ?>" data-action="decrease">-</button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary increase-quantity" data-id="<?= $id ?>" data-action="increase" <?= ($total_quantity >= 10) ? 'disabled' : '' ?>>+</button>
                                        </div>
                                        <h5 class="form-label"><?= number_format($item['amulet_pre_price'] * $item['quantity']) ?> ກີບ</h5>
                                    </div>
                                    <?php $total += $item['amulet_pre_price'] * $item['quantity']; ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <p>Your cart is empty.</p>
                            <?php endif; ?>
                            <p class="form-label mt-3">ລາຍລະອຽດໃນການຮັບເຄື່ອງ:</p>
                            <div class="input-group form-group">
                                <textarea class="form-control" rows="3" placeholder="ສະຖານທີ່ຮັບເຄື່ອງ:" name="preorder_address"></textarea>
                            </div>
                            <div class="card-footer text-center">
                                <div class="d-flex justify-content-center links">
                                    <h5 class="text-dark">ລວມທັງໝົດ: <span class="text-danger"><?= number_format($total) ?> ກີບ</span></h5>
                                </div><br>
                                <div class="d-flex justify-content-center links">
                                    <img src="./img/bcel.png" width="250px" alt="">
                                </div>
                                <h5 for="fileInput" class="mt-3">ເລືອກຮູບຫຼັກຖານການໂອນເງີນ:</h5>
                                <input type="file" class="text-center" id="fileInput" name="payment_proof">
                                <div class="form-group text-center mt-3">
                                    <input type="submit" value="ຖັດໄປ" class="btn btn-warning" <?= empty($cart) ? 'disabled' : '' ?>>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</body>

</html>

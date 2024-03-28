<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PreOrder form</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    /* Made with love by Mutiullah Samim*/

    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Lao:wght@400;500&display=swap');

    html,
    body {
        background-size: cover;
        background-repeat: no-repeat;
        height: 100%;
        font-family: 'Noto Sans Lao', sans-serif;
    }

    .container {
        height: 100%;
        align-content: center;
    }

    .card {
        height: 370px;
        margin-top: auto;
        margin-bottom: auto;
        width: 400px;
        border-radius: 20px;
        background-color: rgba(0, 0, 0, 0.5) !important;
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

    .card-header h3 {
        color: #FFC312;
    }

    .social_icon {
        position: absolute;
        right: 20px;
        top: -45px;
    }

    .input-group-prepend span {
        width: 50px;
        /* background-color: #FFC312; */
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

    <div class="container">
        <div class="row">

            <!------ Include the above in your HEAD tag ---------->
            <div class="d-flex justify-content-center mt-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>ລາຍລະອຽດຜູ້ຈອງ</h3>

                    </div>
                    <div class="card-body">
                        <form>
                            <div class="input-group form-group">

                                <input type="text" class="form-control" placeholder="username">

                            </div>
                            <div class="input-group form-group">

                                <input type="password" class="form-control" placeholder="password">
                            </div>
                            <p  class="form-label">ລາຍລະອຽດໃນການຮັບເຄື່ອງ:</p>
                            <div class="input-group form-group">

                                <textarea class="form-control" rows="3" placeholder="ສະຖານທີ່ຮັບເຄື່ອງ:"></textarea>
                            </div>

                            <div class="form-group text-center mt-5">
                                <input type="submit" value="ຖັດໄປ" class="btn btn-warning">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center links">
                            ຍັງບໍ່ມີບັນຊີ?<a href="register.php">ລົງທະບຽນບັນຊີຜູ້ໃຊ້</a>
                        </div>
                    </div>
                    <a class="text-dark text-center mt-4" href="index.php">ເຂົ້າສູ່ໜ້າຫຼັກ</a>
                </div>
            </div>
        </div>

    </div>
    </div>


</body>

</html>
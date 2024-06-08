<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-5.3.0-alpha3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="styles.css">
    <script src="sweetalert2@11.js"></script>

    <title>Register</title>
    <style>
        .form-1-box {
            position: relative;
            margin-top: 15px;
        }

        .form-1-box::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('./img/bg.png');
            /* Replace 'your-image-url.jpg' with the URL of your background image */
            background-size: cover;
            background-position: center;
            filter: blur(5px);
            /* Adjust the blur radius as needed */
            z-index: -1;
        }
    </style>
</head>

<body>
    <?php include('config.php'); ?>
    <!-- Form 1 -->
    <div class="form-1-container section-container">
        <div class="container justify-content-center align-items-center mb-5 mt-5">
            <div class="row">
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1 form-1-box wow fadeInUp  border border-warning rounded">
                    <form action="register.php" method="post">
                        <!-- User's Credentials  -->
                        <img src="./img/logo_black.png" alt="">
                        <fieldset class="form-group border border-warning p-5">
                            <legend class="w-auto px-2">ລົງທະບຽນບັນຊີຜູ້ໃຊ້</legend><br>
                            <div id="nameFields">
                                <div class="form-group row mt-2">
                                    <label for="firstname" class="col-sm-2 col-form-label">ຊື່:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="firstname" placeholder="First Name..." name="firstname">
                                    </div>
                                </div>
                                <div class="form-group row mt-2">
                                    <label for="lastname" class="col-sm-2 col-form-label">ນາມສະກຸນ:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="lastname" placeholder="Last Name..." name="lastname">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="tel" class="col-sm-2 col-form-label">ເບີໂທ:</label>
                                <div class="col-sm-10">
                                    <input type="tel" class="form-control" id="tel" placeholder="Telephone..." name="tel">
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="password" class="col-sm-2 col-form-label">ລະຫັດຜ່ານ:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" placeholder="Password..." name="password">
                                </div>
                            </div>
                        </fieldset>
                        <!-- User's Preferences  -->
                        <fieldset class="form-group border border-warning p-3">
                            <legend class="w-auto px-2">ເລືອກສະຖານະຜູ້ໃຊ້</legend>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="preferences" id="user" value="user" onchange="toggleSellerFields()">
                                <label class="form-check-label" for="user">ລົງທະບຽນເປັນຜູ້ໃຊ້</label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="preferences" id="seller" value="seller" onchange="toggleSellerFields()">
                                <label class="form-check-label" for="seller">ລົງທະບຽນເປີດຮ້ານຄ້າ</label>
                            </div>
                            <!-- Additional fields for seller -->
                            <div id="sellerFields" style="display: none;">
                                <h4 class="text-danger">ສາມາດລົງທະບຽນໄດ້ສະເພາະຄົນທິ່ມີບັນຊີຜູ້ໃຊ້ແລ້ວ</h4>
                                <div class="form-group row mt-2">
                                    <label for="shopName" class="col-sm-2 col-form-label">ຊື່ຮ້ານຄ້າ:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="shopName" placeholder="Store Name..." name="shopName">
                                    </div>
                                </div>
                                <div class="form-group row mt-2">
                                    <label for="shopAddress" class="col-sm-2 col-form-label">ທີ່ຢູ່ຮ້ານຄ້າ:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="shopAddress" placeholder="Store Address..." name="shopAddress">
                                    </div>
                                </div>
                                <div class="form-group row mt-2">
                                    <label for="description" class="col-sm-2 col-form-label">ລາຍລະອຽດຮ້ານຄ້າ:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="description" placeholder="Store Description..." name="description">
                                    </div>
                                </div>
                                <div class="form-group row mt-2">
                                    <label for="idCard" class="col-sm-2 col-form-label">ເລກບັດປະຊາຊົນ:</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="idCard" placeholder="ID Card..." name="idCard">
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <!-- Submit Button  -->
                        <div class="form-group row p-2">
                            <div class="col d-flex justify-content-end align-items-center">
                                <a href="login.php" class="text-dark" style="text-align: right;margin-right: 50px;cursor:pointer">ເຂົ້າສູ່ລະບົບ <a>
                                        <button type="submit" class="btn btn-warning ms-5" onclick="return echoRadioButtonName()">ລົງທະບຽນ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function echoRadioButtonName() {
            var radioButtonValue = document.querySelector('input[name="preferences"]:checked');
            if (!radioButtonValue) {
                Swal.fire({
                    icon: 'error',
                    title: 'ຂໍອະໄພ...',
                    text: 'ກະລຸນາເລືອກສະຖານະຜູ້ໃຊ້',
                });
                return false;
            }
            return true;
        }

        function toggleSellerFields() {
            var sellerFields = document.getElementById("sellerFields");
            var nameFields = document.getElementById("nameFields");
            if (document.getElementById("seller").checked) {
                sellerFields.style.display = "block";
                nameFields.style.display = "none";
            } else {
                sellerFields.style.display = "none";
                nameFields.style.display = "block";
            }
        }
    </script>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_POST['preferences']) || $_POST['preferences'] === "") {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'ຂໍອະໄພ...',
                text: 'ກະລຸນາເລືອກສະຖານະຜຼ້ໃຊ້',
            });
        </script>";
        } else {
            if ($_POST['preferences'] == 'user') {
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $telephone = $_POST['tel'];
                $password = $_POST['password'];
                $status = 'user';
                $active = 'false';
                $admin_id = 0;
                if ($firstname == "" || $lastname == "" || $telephone == "" || $password == "") {
                    echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'ຂໍອະໄພ...',
                        text: 'ກະລຸນາປ້ອນຂ້ມູນໃຫ້ຄົບ',
                    });
                </script>";
                } else {
                    $sql = "INSERT INTO `user` (username, lastname, telephone, password, status, admin_id, active) 
                                    VALUES ('$firstname', '$lastname', '$telephone', '$password', '$status', '$admin_id', '$active')";

                    if (mysqli_query($conn, $sql)) {
                        $firstname = $lastname = $telephone = $password = $status = $admin_id = '';
                        $user_id = mysqli_insert_id($conn);
                        $addToRegister_sql = "INSERT INTO `register` (user_id, register_date, role, status) 
                                                VALUES ('$user_id',NOW(),'buyer' ,'pending')";
                        mysqli_query($conn, $addToRegister_sql);
                        echo "New record added. User ID: " . $user_id;
                        echo "<script>
                                        console.log('ລົງທະບຽນຜູ້ໃຊ້ສຳເລັດ.');
                                        window.location.href = 'login.php';
                                      </script>";
                        exit();
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
            } else {
                $storeName = $_POST['shopName'];
                $idCard = $_POST['idCard'];
                $description = $_POST['description'];
                $sellerAddress = $_POST['shopAddress'];
                if ($storeName == "" || $idCard == "" || $description == "" || $sellerAddress == "") {
                    echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'ຂໍອະໄພ...',
                        text: 'ກະລຸນາປ້ອນຂ້ມູນໃຫ້ຄົບ ແລະ ເລືອກສະຖານະຜຼ້ໃຊ້',
                    });
                </script>";
                } else {
                    $telephone = $_POST['tel'];
                    $password = $_POST['password'];
                    $idCard = $_POST['idCard'];
                    $query = "SELECT user_id FROM `user` WHERE telephone = '$telephone' AND password = '$password'";
                    $id_card = "SELECT user_id FROM `seller` WHERE id_card = '$idCard'";
                    $idCardCheck = mysqli_query($conn, $id_card);
                    if ($idCardCheck) {
                        $row = mysqli_fetch_assoc($idCardCheck);
                        if ($row) {
                            echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'ຂໍອະໄພ...',
                                text: 'ເລກບັດປະຈຳໂຕນີ້ຖືກນຳໃຊ້ແລ້ວ',
                            });
                        </script>";
                        } else {
                            $result = mysqli_query($conn, $query);
                            if ($result && mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $userId = $row['user_id'];
                                $sql = "INSERT INTO `seller` (user_id, store_name, id_card, description, seller_address) 
                                                    VALUES ('$userId', '$storeName', '$idCard', '$description', '$sellerAddress')";
              

                                if (mysqli_query($conn, $sql)) {
                                    $storeName = $idCard = $description = $sellerAddress = '';
                                    $addToRegister_sql = "INSERT INTO `register` (user_id, register_date, role, status) 
                                                            VALUES ('$userId',NOW() ,'seller' ,'pending')";
                                    mysqli_query($conn, $addToRegister_sql);
                                    echo "<script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ສຳເລັດ',
                                        text: 'ລົງທະບຽນເປີດຮ້ານຄ້າສຳເລັດ',
                                    });
                                </script>";
                                   
                                } else {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                }
                            } else {
                                echo "<script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ຂໍອະໄພ...',
                                    text: 'ກະລຸນາປ້ອນຂ້ມູນເບິໂທ ຫຼື ລະຫັດຜ່ານໃຫ້ຖືກຕາມບັນຊີຂອງທ່ານ.',
                                });
                            </script>";
                            }
                        }
                    }
                }
            }
        }
        mysqli_close($conn);
    }
    ?>
</body>

</html>
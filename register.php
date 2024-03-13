<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">

    <title>Register</title>
    <style>
        .form-1-box {
            position: relative;
        }

        .form-1-box::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('./img/bg.png '); /* Replace 'your-image-url.jpg' with the URL of your background image */
            background-size: cover;
            background-position: center;
            filter: blur(5px); /* Adjust the blur radius as needed */
            z-index: -1;
        }
    </style>
</head>

<body>
    <!-- Form 1 -->
    <div class="form-1-container section-container">
        <div class="container justify-content-center align-items-center mb-5 mt-5">
            <div class="row">
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1 form-1-box wow fadeInUp bg-secondary border rounded">

                    <form action="" method="post">
                        <!-- User's Credentials  -->
                        <fieldset class="form-group border p-5">
                            <legend class="w-auto px-2">ລົງທະບຽນບັນຊີຜູ້ໃຊ້</legend>

                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">ຊື່ຜູ້ໃຊ້:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control username" id="username" placeholder="Username..." name="username">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">ອີເມວ:</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control email" id="email" placeholder="email..." name="email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tel" class="col-sm-2 col-form-label">ເບີໂທ:</label>
                                <div class="col-sm-10">
                                    <input type="tel" class="form-control tel" id="tel" placeholder="tel..." name="tel">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">ລະຫັດຜ່ານ:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control password" id="password" placeholder="password..." name="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="confirm-password" class="col-sm-2 col-form-label">ຢືນຢັນລະຫັດຜ່ານ:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control confirm-password" id="confirm-password" placeholder="confirm-password..." name="confirm-password">
                                </div>
                            </div>

                        </fieldset>
                        <!-- User's Preferences  -->
                        <fieldset class="form-group border p-3">
                            <legend class="w-auto px-2">User's Preferences</legend>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="preferences" id="daily" value="daily">
                                <label class="form-check-label" for="daily">I want <strong>daily</strong> emails</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="preferences" id="weekly" value="weekly">
                                <label class="form-check-label" for="weekly">I want <strong>weekly</strong> emails</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="preferences" id="monthly" value="monthly">
                                <label class="form-check-label" for="monthly">I want <strong>monthly</strong> emails</label>
                            </div>
                        </fieldset>
                        <!-- Submit Button  -->
                        <div class="form-group row text-right">
                            <div class="col">
                                <button type="submit" class="btn btn-warning ">ລົງທະບຽນ</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my account</title>
</head>
<body>
  <?php include('header.php'); ?>
  
    <div class="container col-8 text-center mt-3">
    <h2 class="">ກຳລັງລໍຖ້າການກວດສອບ</h2>

    <div class="card" >
                    <div class="card-header text-center">
                        <h3>ຂໍ້ມູນສ່ວນຕົວ</h3>

                    </div>
                    <div class="card-body">
                                <p class="form-label">ຊື່: <span><b><?php echo ($username)?></b> </span></p>
                                <p class="form-label">ນາມສະກຸນ: <span><b><?php echo ($lastname)?></b> </span></p>
                                <p class="form-label">ເບີໂທ: <span><b><?php echo ($tel)?></b> </span></p>
                                <p class="form-label">ສະຖານະ: <span><b><?php echo ($status)?></b> </span></p>
                            
                          
                            <div class="form-group text-center mt-3">
                                <a href="logout.php" class="btn btn-warning">ອອກຈາກລະບົບ</a>
                            </div>
                    </div>
                  
                </div>
    </div>
</body>
</html>

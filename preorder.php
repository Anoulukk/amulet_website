<?php
// Start the session
include("config.php");
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PreOrder</title>
</head>
<style>
  .cardBg {
    background-image: linear-gradient(to bottom right, #fcc200, #f7e98e);
  }
</style>

<body>
  <?php include('header.php'); ?>
  <div class="container text-center">
    <div class="row">
      <div class="col mt-3">
        <h2>ສູນຈອງຫຼຽນພຣະອາຈານຊາຄຳແດງ</h2>
      </div>

    </div>
    <div class="row">
      <div class="col text-start cardBg rounded p-3">
        <h5>ປະຫວັດຄວາມເປັນມາ:</h5>
        <p>ພຣະອາຈານຊາຄຳແດງ ເປັນພຣະນັກປະຕິບັດສາຍວິປັສນາກັມມັດຖານປະຕິບັດຊານເຕໂຊທາດ ຕາມປະຫວັດ ແມ່ນພຣະອາຈານໄດ້
          ເຂົ້າຄອງວິປັດສະນາທີ່ວັດມະຫາພຸດທະວົງສາປ່າຫຼວງ ນຳພຣະເດດພຣະຄຸນຍາທ່ານມະຫາປານ ອະນັນໂທ, ເປັນພຣະຄອງວິປັສສະນາ
          ແຫ່ງພຣະຣາຊະອານາຈັກລາວ ພຣະອາຈານຊາຄຳແດງໄດ້ພັກຢູ່ທີ່ວັດພຣະທາດຫຼວງເໜືອ ມະຫາກຸດີ ນຳຍາທ່ານສົມເດັດອັຄະມະຫາບັນດີດ
          ລູກແກ້ວ(ຄູນ ມະນີວົງ) ພຣະສັງຄະນາຍົກ ແຫ່ງພຣະຣາຊະອານາຈັກລາວ.</p><br>
        <div class="d-flex justify-content-center">
          <img src="./img/amulet.jpg" class="me-5" alt="" width="100px">
          <img src="./img/amulet.jpg" class="me-5" alt="" width="100px">
          <img src="./img/amulet.jpg" class="me-5" alt="" width="100px">
          <img src="./img/amulet.jpg" class="me-5" alt="" width="100px">
          <img src="./img/amulet.jpg" class="me-5" alt="" width="100px">
        </div>
      </div>
      <h3 class="mt-3">ສູນຈອງຫຼຽນ</h3>
      <div class="col d-flex text-start cardBg rounded">
        <div class="d-flex flex-column justify-content-center align-items-center">
          <img src="./img/store.jpeg" class="rounded p-2" width="150px" alt="">
          <h5 class="text-dark">ສູນຈອງທີ 1</h5>
        </div>

        <div class=" d-flex flex-column justify-content-center align-items-center">
          <h5 class="ms-5 ">ສູນຈອງມ໋ອດພຣະເຄື່ອງ</h5>
          <span class="ms-5 d-flex justify-content-center align-items-center">
            <img src="./img/whatsapplogo.png" width="30px" alt="">
            <h5 class="mt-2 ms-1">020-9999-8888</h5>
          </span>
          <span class="d-flex justify-content-center align-items-center">
            <img src="./img/facebooklogo.png" width="30px" alt="">
            <h5 class="mt-2 ms-1">Moss Ptd</h5>
          </span>
        </div>
      </div>
      <h3 class="mt-3">ລາຍການທັງໝົດ</h3>
      <div class="col d-flex text-start cardBg rounded p-2 justify-content-center align-items-center">
        <button type="button" class="btn btn-light p-1 me-3">ທັງໝົດ</button>
        <button type="button" class="btn btn-light p-1 me-3">ເນື້ອທອງຄຳ</button>
        <button type="button" class="btn btn-light p-1 me-3">ເນື້ອເງີນໜ້າກາກຄຳ</button>
        <button type="button" class="btn btn-light p-1 me-3">ເນື້ອເງີນ</button>
        <button type="button" class="btn btn-light p-1 me-3">ລາຍການຊຸດກຳມະການ</button>
        <button type="button" class="btn btn-light p-1 me-3">ລຸ້ນເນື້ອ</button>
        <button type="button" class="btn btn-light p-1 me-3">ອົງບູຊາ ຂະໜາດ 9 ນິ້ວ</button>
        <button type="button" class="btn btn-light p-1 me-3">ອົງບູຊາ ຂະໜາດ 5 ນິ້ວ</button>
      </div>
      <?php if ($role === "user") : ?>
        <a href="login.php" class="btn btn-danger mt-3">ເຂົ້າສູ່ລະບົບເພື່ອຈອງ</a>
      </div>
      </div>
        
      <?php else : ?>
        <h3 class="mt-3"></h3>
      <div class="d-flex mb-3">

        <div class="col text-start cardBg rounded p-3 justify-content-center align-items-center">
          <h4>1. ເນື້ອທອງຄຳ</h4>
          <div class="d-flex justify-content-center">

            <h5 class="p-1 bg-light rounded">ລາຄາ: <span>49,999,000 </span>ກີບ</h5>
            <h5 class="p-1 bg-light rounded ms-3">ສ້າງທັງໝົດ <span>99 </span>ຫຼຽນ</h5>
          </div><br>

          <div class="row justify-content-center mb-3 bg-light p-3 rounded">
            <div class="col text-end">
              <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
            </div>
            <div class="col-6 text-start">
              <h6>1.1 ເນື້ອທອງຄຳ ລົງຢາຮ້ອນ ໜ້າ-ຫຼັງ ຝັງເພັດ</h6>
              <h5>ສ້າງທັງໝົດ 5 ຫຼຽນ</h5>
            </div>
            <div class="col text-center">
              <a href="" class="btn btn-light border">ເລືອກ</a>
            </div>
          </div>
          <div class="row justify-content-center mb-3 bg-light p-3 rounded">
            <div class="col text-end">
              <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
            </div>
            <div class="col-6 text-start">
              <h6>1.1 ເນື້ອທອງຄຳ ລົງຢາຮ້ອນ ໜ້າ-ຫຼັງ ຝັງເພັດ</h6>
              <h5>ສ້າງທັງໝົດ 5 ຫຼຽນ</h5>
            </div>
            <div class="col text-center">
              <a href="" class="btn btn-light border">ເລືອກ</a>
            </div>
          </div>
          <div class="row justify-content-center mb-3 bg-light p-3 rounded">
            <div class="col text-end">
              <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
            </div>
            <div class="col-6 text-start">
              <h6>1.1 ເນື້ອທອງຄຳ ລົງຢາຮ້ອນ ໜ້າ-ຫຼັງ ຝັງເພັດ</h6>
              <h5>ສ້າງທັງໝົດ 5 ຫຼຽນ</h5>
            </div>
            <div class="col text-center">
              <a href="" class="btn btn-light border">ເລືອກ</a>
            </div>
          </div>
          <div class="row justify-content-center mb-3 bg-light p-3 rounded">
            <div class="col text-end">
              <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
            </div>
            <div class="col-6 text-start">
              <h6>1.1 ເນື້ອທອງຄຳ ລົງຢາຮ້ອນ ໜ້າ-ຫຼັງ ຝັງເພັດ</h6>
              <h5>ສ້າງທັງໝົດ 5 ຫຼຽນ</h5>
            </div>
            <div class="col text-center">
              <a href="" class="btn btn-light border">ເລືອກ</a>
            </div>
          </div>
          <div class="row justify-content-center mb-3 bg-light p-3 rounded">
            <div class="col text-end">
              <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
            </div>
            <div class="col-6 text-start">
              <h6>1.1 ເນື້ອທອງຄຳ ລົງຢາຮ້ອນ ໜ້າ-ຫຼັງ ຝັງເພັດ</h6>
              <h5>ສ້າງທັງໝົດ 5 ຫຼຽນ</h5>
            </div>
            <div class="col text-center">
              <a href="" class="btn btn-light border">ເລືອກ</a>
            </div>
          </div>
        </div>
        <div class="col ms-5 text-start cardBg rounded p-3 justify-content-center align-items-center">
          <h4>2. ເນື້ອເງິນໜ້າກາກຄຳ</h4>
          <div class="d-flex justify-content-center">

            <h5 class="p-1 bg-light rounded">ລາຄາ: <span>29,999,000 </span>ກີບ</h5>
            <h5 class="p-1 bg-light rounded ms-3">ສ້າງທັງໝົດ <span>99 </span>ຫຼຽນ</h5>
          </div><br>

          <div class="row justify-content-center mb-3 bg-light p-3 rounded">
            <div class="col text-end">
              <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
            </div>
            <div class="col-6 text-start">
              <h6>1.1 ເນື້ອທອງຄຳ ລົງຢາຮ້ອນ ໜ້າ-ຫຼັງ ຝັງເພັດ</h6>
              <h5>ສ້າງທັງໝົດ 5 ຫຼຽນ</h5>
            </div>
            <div class="col text-center">
              <a href="" class="btn btn-light border">ເລືອກ</a>
            </div>
          </div>
          <div class="row justify-content-center mb-3 bg-light p-3 rounded">
            <div class="col text-end">
              <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
            </div>
            <div class="col-6 text-start">
              <h6>1.1 ເນື້ອທອງຄຳ ລົງຢາຮ້ອນ ໜ້າ-ຫຼັງ ຝັງເພັດ</h6>
              <h5>ສ້າງທັງໝົດ 5 ຫຼຽນ</h5>
            </div>
            <div class="col text-center">
              <a href="" class="btn btn-light border">ເລືອກ</a>
            </div>
          </div>
          <div class="row justify-content-center mb-3 bg-light p-3 rounded">
            <div class="col text-end">
              <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
            </div>
            <div class="col-6 text-start">
              <h6>1.1 ເນື້ອທອງຄຳ ລົງຢາຮ້ອນ ໜ້າ-ຫຼັງ ຝັງເພັດ</h6>
              <h5>ສ້າງທັງໝົດ 5 ຫຼຽນ</h5>
            </div>
            <div class="col text-center">
              <a href="" class="btn btn-light border">ເລືອກ</a>
            </div>
          </div>
          <div class="row justify-content-center mb-3 bg-light p-3 rounded">
            <div class="col text-end">
              <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
            </div>
            <div class="col-6 text-start">
              <h6>1.1 ເນື້ອທອງຄຳ ລົງຢາຮ້ອນ ໜ້າ-ຫຼັງ ຝັງເພັດ</h6>
              <h5>ສ້າງທັງໝົດ 5 ຫຼຽນ</h5>
            </div>
            <div class="col text-center">
              <a href="" class="btn btn-light border">ເລືອກ</a>
            </div>
          </div>
          <div class="row justify-content-center mb-3 bg-light p-3 rounded">
            <div class="col text-end">
              <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
            </div>
            <div class="col-6 text-start">
              <h6>1.1 ເນື້ອທອງຄຳ ລົງຢາຮ້ອນ ໜ້າ-ຫຼັງ ຝັງເພັດ</h6>
              <h5>ສ້າງທັງໝົດ 5 ຫຼຽນ</h5>
            </div>
            <div class="col text-center">
              <a href="" class="btn btn-light border">ເລືອກ</a>
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex">

        <div class="col text-start cardBg rounded p-3 justify-content-center align-items-center">
          <h4>1. ເນື້ອທອງຄຳ</h4>
          <div class="d-flex justify-content-center">

            <h5 class="p-1 bg-light rounded">ລາຄາ: <span>49,999,000 </span>ກີບ</h5>
            <h5 class="p-1 bg-light rounded ms-3">ສ້າງທັງໝົດ <span>99 </span>ຫຼຽນ</h5>
          </div><br>

          <div class="row justify-content-center mb-3 bg-light p-3 rounded">
            <div class="col text-end">
              <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
            </div>
            <div class="col-6 text-start">
              <h6>1.1 ເນື້ອທອງຄຳ ລົງຢາຮ້ອນ ໜ້າ-ຫຼັງ ຝັງເພັດ</h6>
              <h5>ສ້າງທັງໝົດ 5 ຫຼຽນ</h5>
            </div>
            <div class="col text-center">
              <a href="" class="btn btn-light border">ເລືອກ</a>
            </div>
          </div>
          <div class="row justify-content-center mb-3 bg-light p-3 rounded">
            <div class="col text-end">
              <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
            </div>
            <div class="col-6 text-start">
              <h6>1.1 ເນື້ອທອງຄຳ ລົງຢາຮ້ອນ ໜ້າ-ຫຼັງ ຝັງເພັດ</h6>
              <h5>ສ້າງທັງໝົດ 5 ຫຼຽນ</h5>
            </div>
            <div class="col text-center">
              <a href="" class="btn btn-light border">ເລືອກ</a>
            </div>
          </div>
          <div class="row justify-content-center mb-3 bg-light p-3 rounded">
            <div class="col text-end">
              <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
            </div>
            <div class="col-6 text-start">
              <h6>1.1 ເນື້ອທອງຄຳ ລົງຢາຮ້ອນ ໜ້າ-ຫຼັງ ຝັງເພັດ</h6>
              <h5>ສ້າງທັງໝົດ 5 ຫຼຽນ</h5>
            </div>
            <div class="col text-center">
              <a href="" class="btn btn-light border">ເລືອກ</a>
            </div>
          </div>
          <div class="row justify-content-center mb-3 bg-light p-3 rounded">
            <div class="col text-end">
              <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
            </div>
            <div class="col-6 text-start">
              <h6>1.1 ເນື້ອທອງຄຳ ລົງຢາຮ້ອນ ໜ້າ-ຫຼັງ ຝັງເພັດ</h6>
              <h5>ສ້າງທັງໝົດ 5 ຫຼຽນ</h5>
            </div>
            <div class="col text-center">
              <a href="" class="btn btn-light border">ເລືອກ</a>
            </div>
          </div>
          <div class="row justify-content-center mb-3 bg-light p-3 rounded">
            <div class="col text-end">
              <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
            </div>
            <div class="col-6 text-start">
              <h6>1.1 ເນື້ອທອງຄຳ ລົງຢາຮ້ອນ ໜ້າ-ຫຼັງ ຝັງເພັດ</h6>
              <h5>ສ້າງທັງໝົດ 5 ຫຼຽນ</h5>
            </div>
            <div class="col text-center">
              <a href="" class="btn btn-light border">ເລືອກ</a>
            </div>
          </div>
        </div>
        <div class="col ms-5 text-start cardBg rounded p-3 justify-content-center align-items-center">
          <h4>2. ເນື້ອເງິນໜ້າກາກຄຳ</h4>
          <div class="d-flex justify-content-center">

            <h5 class="p-1 bg-light rounded">ລາຄາ: <span>29,999,000 </span>ກີບ</h5>
            <h5 class="p-1 bg-light rounded ms-3">ສ້າງທັງໝົດ <span>99 </span>ຫຼຽນ</h5>
          </div><br>

          <div class="row justify-content-center mb-3 bg-light p-3 rounded">
            <div class="col text-end">
              <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
            </div>
            <div class="col-6 text-start">
              <h6>1.1 ເນື້ອທອງຄຳ ລົງຢາຮ້ອນ ໜ້າ-ຫຼັງ ຝັງເພັດ</h6>
              <h5>ສ້າງທັງໝົດ 5 ຫຼຽນ</h5>
            </div>
            <div class="col text-center">
              <a href="" class="btn btn-light border">ເລືອກ</a>
            </div>
          </div>
          <div class="row justify-content-center mb-3 bg-light p-3 rounded">
            <div class="col text-end">
              <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
            </div>
            <div class="col-6 text-start">
              <h6>1.1 ເນື້ອທອງຄຳ ລົງຢາຮ້ອນ ໜ້າ-ຫຼັງ ຝັງເພັດ</h6>
              <h5>ສ້າງທັງໝົດ 5 ຫຼຽນ</h5>
            </div>
            <div class="col text-center">
              <a href="" class="btn btn-light border">ເລືອກ</a>
            </div>
          </div>
          <div class="row justify-content-center mb-3 bg-light p-3 rounded">
            <div class="col text-end">
              <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
            </div>
            <div class="col-6 text-start">
              <h6>1.1 ເນື້ອທອງຄຳ ລົງຢາຮ້ອນ ໜ້າ-ຫຼັງ ຝັງເພັດ</h6>
              <h5>ສ້າງທັງໝົດ 5 ຫຼຽນ</h5>
            </div>
            <div class="col text-center">
              <a href="" class="btn btn-light border">ເລືອກ</a>
            </div>
          </div>
          <div class="row justify-content-center mb-3 bg-light p-3 rounded">
            <div class="col text-end">
              <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
            </div>
            <div class="col-6 text-start">
              <h6>1.1 ເນື້ອທອງຄຳ ລົງຢາຮ້ອນ ໜ້າ-ຫຼັງ ຝັງເພັດ</h6>
              <h5>ສ້າງທັງໝົດ 5 ຫຼຽນ</h5>
            </div>
            <div class="col text-center">
              <a href="" class="btn btn-light border">ເລືອກ</a>
            </div>
          </div>
          <div class="row justify-content-center mb-3 bg-light p-3 rounded">
            <div class="col text-end">
              <img src="./img/amulet_pre.png" class="me-5 border border-warning rounded-circle" alt="" width="80px">
            </div>
            <div class="col-6 text-start">
              <h6>1.1 ເນື້ອທອງຄຳ ລົງຢາຮ້ອນ ໜ້າ-ຫຼັງ ຝັງເພັດ</h6>
              <h5>ສ້າງທັງໝົດ 5 ຫຼຽນ</h5>
            </div>
            <div class="col text-center">
              <a href="" class="btn btn-light border">ເລືອກ</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <?php endif; ?>
</body><br>
<?php include('footer.php') ?>

</html>
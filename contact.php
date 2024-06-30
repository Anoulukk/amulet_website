<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .contact-info {
      background: linear-gradient(to right, #f7e98e, #fcc200);
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .contact-info h6 {
      margin: 0;
      color: #333;
      font-size: 1rem;
      display: flex;
      align-items: center;
    }
    .contact-info h6 i {
      margin-right: 10px;
      color: #007bff;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
        const whatsappButton = document.getElementById("whatsappButton");
        whatsappButton.addEventListener("click", function () {
            const phoneNumber = "+8562097320556";
            const message = "Hello, I would like to get more information.";
            const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
        });
    });
  </script>
</head>

<body>
  <?php include('header.php'); ?>
  <div class="container justify-content-center align-items-center mb-5 mt-5">
    <div class="col-12 text-center rounded" style="margin: 0 auto; background-image: linear-gradient(to bottom right, #fcc200, #f7e98e); height:70vh; align-items:center;">
      <h3 class="pt-3" style="color:white">
        ໄວລຸ້ນສະສົມພຣະເຄື່ອງ <br> ສູນລວມຮ້ານພຣະເຄື່ອງອອນລາຍ
      </h3>
      <h6 style="color:white">ສາມາດຕິດຕໍ່ພວກເຮົາໂດຍຕົງໄດ້ທີ່</h6>
      <img src="./img/WhatsApp.png" alt=""><br>
      <img id="whatsappButton" class="ms-3 mt-3 mb-2" src="./img/whatsappbutton.png" alt="">
      <h5 style="color:white">ຕະຫຼອດເວລາເຮັດວຽກ<br>09:00 - 19:00</h5>
      <div class="contact-info d-flex justify-content-around flex-wrap">
        <h6><i class="fab fa-facebook-square"></i>facebook page: ໄວລຸ້ນສະສົມພຣະເຄື່ອງ</h6>
        <h6><i class="fas fa-envelope"></i>Email: vailounsasomphakhg@gmail.com</h6>
        <h6><i class="fab fa-tiktok"></i>Tiktok: vailounsasomphakhg</h6>
      </div>
    </div>
  </div>
  <?php include('footer.php'); ?>
</body>

</html>

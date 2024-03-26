<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller management</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<style>
    /* Style for the date picker */
.date-picker {

  padding: 8px; /* Adjust padding as needed */
  border: 1px solid #ccc; /* Add a border */
  border-radius: 5px; /* Add border radius */
  outline: none; /* Remove default focus outline */
  font-size: 14px; /* Adjust font size */
  width: 480px;
}

/* Optional: Style for when the input is focused */
.date-picker:focus {
  border-color: #007bff; /* Change border color on focus */
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Add a shadow on focus */
}

</style>
<body>
    <?php include('header.php'); ?>
    <div class="container col-8">
        <h4 class="mt-3 mb-3">ຟອມເປີດປະມູນພຣະເຄື່ອງ</h4>

        <form>
            <div class="form-group mt-3">
                <label for="amulet_name">ຊື່ພຣະເຄື່ອງ</label>
                <input type="text" class="form-control" id="amulet_name" required>
            </div>
            <div class="form-group">
                <label for="amulet_details">ລາຍລະອຽດ</label>
                <textarea class="form-control" name="" id="" id="amulet_details" required></textarea>
            </div>
            <div class="d-flex justify-content-between mt-3">
                
                <div class="form-group">
                    <label for="amulet_name">ວັນທີເລີ່ມປະມູນ</label><br>
                    <input type="date" class="date-picker" id="date-picker">
                </div>
                <div class="form-group ms-3">
                    <label for="amulet_name">ວັນທີປິດປະມູນ</label><br>
                    <input type="date" class="date-picker" id="date-picker">
                </div>
            </div>
           <div class="d-flex justify-content-between mt-3">
           <div class="form-group">
                <label for="amulet_name">ລາຄາເປີດປະມູນ  (ກີບ)</label>
                <div class="d-flex">
                    <input type="number" class="form-control" style="width: 480px;" id="amulet_name" required>
                </div>
            </div>
            <div class="form-group ms-3">
                <label for="amulet_name">ເຄາະຂັ້ນຕ່ຳລາຄາ (ກີບ)</label>
                <div class="d-flex">
                    <input type="number" class="form-control" style="width: 480px;" id="amulet_name" required>
                </div>
            </div>
           </div>

            <label class="form-label mt-3">ເລືອກຮູບພາບພຣະເຄື່ອງຂອງທ່ານ</label>
            <div class="d-flex">

                <div class="me-3">
                    <label for="customFile1" class="form-label">ຮູບທີ 1</label>
                    <input type="file" class="form-control" id="customFile1" name="image1" accept="image/*" />
                </div>
                <div class="me-3">
                    <label for="customFile2" class="form-label">ຮູບທີ 2</label>
                    <input type="file" class="form-control" id="customFile2" name="image2" accept="image/*" />
                </div>
                <div class="me-3">
                    <label for="customFile3" class="form-label">ຮູບທີ 3</label>
                    <input type="file" class="form-control" id="customFile3" name="image3" accept="image/*" />
                </div>
                <div class="me-3">
                    <label for="customFile4" class="form-label">ຮູບທີ 4</label>
                    <input type="file" class="form-control" id="customFile4" name="image4" accept="image/*" />
                </div>
                <div class="me-3">
                    <label for="customFile5" class="form-label">ຮູບທີ 5</label>
                    <input type="file" class="form-control" id="customFile5" name="image5" accept="image/*" />
                </div>
            </div>


            <button type="submit" class="btn btn-warning mt-3">ຢືນຢັນ</button>
        </form>
    </div>





</body>

</html>
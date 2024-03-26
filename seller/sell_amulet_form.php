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
    <div class="container col-8">
    <h4 class="mt-3 mb-3">ຟອມເປີດຂາຍພຣະເຄື່ອງ</h4>

        <form>
            <div class="form-group">
                <label for="amulet_name">ຊື່ພຣະເຄື່ອງ</label>
                <input type="text" class="form-control" id="amulet_name" required>
            </div>
            <div class="form-group">
                <label for="amulet_details">ລາຍລະອຽດ</label>
                <textarea class="form-control" name="" id="" id="amulet_details" required></textarea>
            </div>
            <div class="d-flex justify-content-between">
                <div>
                    <p class="mt-2">ສະຖານະ</p>
                    <div class="d-flex">

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                ພ້ອມເຊົ່າ
                            </label>
                        </div>
                        <div class="form-check ms-3">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                            <label class="form-check-label" for="exampleRadios2">
                                ພຣະໂຊ
                            </label>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="mt-2">ເລືອກໝວດໝູ່ພຣະເຄື່ອງ</p>
                    <select class="form-control" style="width: 400px;" id="amulet_group">
                        <option>ພຣະຫຼຽນ</option>
                        <option>ພຣະບູຊາ</option>
                        <option>ພຣະກິ່ງ</option>
                        <option>ຕະກຸດ</option>
                        <option>ຜ້າຍັນ</option>
                        <option>ອົງລອຍ</option>
                        <option>ພຣະເນື້ອຜົງ</option>
                    </select>
                </div>


            </div>
            <div class="form-group">
                <label for="amulet_name">ລາຄາ</label>
                <div class="d-flex">
                    <input type="number" class="form-control me-3" style="width: 500px;" id="amulet_name" required>
                    <h6 class="mt-2">ກີບ</h6>
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
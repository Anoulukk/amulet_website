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
        <h4 class="mt-3 mb-3">ຟອມເປີດຈອງພຣະເຄື່ອງ</h4>

        <form>
            <div class="form-group mb-2">
                <label for="amulet_name">ຊື່ລຸ້ນ</label>
                <input type="text" class="form-control" id="amulet_name" required>
            </div>
            <div class="form-group">
                <label for="amulet_details">ລາຍລະອຽດ (ປະຫວັດຄວາມເປັນມາ)</label>
                <textarea class="form-control" name="" id="" id="amulet_details" required></textarea>
            </div>

            <h5 class="form-label mt-3">1. ເນື້ອທອງຄຳ</h5>
            <label for="type1">ສ້າງທັງໝົດ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-25" id="type1" min="0" required required>
            <label for="type1">ອົງ</label>
            <label for="price" class="ms-5">ລາຄາ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-50" id="price">

            <div class="spaceForInputName"></div>

            <h5 class="form-label mt-3">2. ເນື້ອເງີນໜ້າກາກຄຳ</h5>
            <label for="type1">ສ້າງທັງໝົດ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-25" id="type1" min="0" required>
            <label for="type1">ອົງ</label>
            <label for="price" class="ms-5">ລາຄາ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-50" id="price">

            <div class="spaceForInputName"></div>

            <h5 class="form-label mt-3">3. ເນື້ອເງີນ</h5>
            <label for="type1">ສ້າງທັງໝົດ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-25" id="type1" min="0" required>
            <label for="type1">ອົງ</label>
            <label for="price" class="ms-5">ລາຄາ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-50" id="price">

            <div class="spaceForInputName"></div>
            
            <h5 class="form-label mt-3">4. ຊຸດກຳມະການ</h5>
            <label for="type1">ສ້າງທັງໝົດ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-25" id="type1" min="0" required>
            <label for="type1">ອົງ</label>
            <label for="price" class="ms-5">ລາຄາ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-50" id="price">

            <div class="spaceForInputName"></div>

            <h5 class="form-label mt-3">5. ອົງບູຊາຂະໜາດ 9 ນິ້ວ</h5>
            <label for="type1">ສ້າງທັງໝົດ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-25" id="type1" min="0" required>
            <label for="type1">ອົງ</label>
            <label for="price" class="ms-5">ລາຄາ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-50" id="price">

            <div class="spaceForInputName"></div>

            <h5 class="form-label mt-3">6. ອົງບູຊາຂະໜາດ 5 ນິ້ວ</h5>
            <label for="type1">ສ້າງທັງໝົດ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-25" id="type1" min="0" required>
            <label for="type1">ອົງ</label>
            <label for="price" class="ms-5">ລາຄາ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-50" id="price">

            <div class="spaceForInputName"></div>

            <h5 class="form-label mt-3">7. ລຸ້ນເນື້ອ</h5>
            <label for="type1">ສ້າງທັງໝົດ</label>
            <input type="number" class="border rounded p-1 mb-3 w-25" id="type1" min="999">
            <label for="type1">ອົງ</label>
            <label for="price" class="ms-5">ລາຄາ</label>
            <input type="number" class="border rounded p-1 mb-3 type-input w-50" id="price">

            <div class="spaceForInputName"></div>



            
            <h5 class="form-label mt-3">ເລືອກຮູບພາບຕົວຢ່າງຫຼຽນ</h5>
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


            <button type="submit" class="btn btn-warning mt-5 mb-5">ຢືນຢັນ</button>
        </form>
    </div>




</body>
<script>
    var typeInputs = document.querySelectorAll('.type-input');
    typeInputs.forEach(function(input) {
        input.addEventListener('input', function() {
            var numInputs = parseInt(this.value);
            if (numInputs > 5) {
                numInputs = 5; // Limit to minim0m of 5 inputs
                this.value = 5; // Update input field to show the minim0m allowed value
            }

            var container = this.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling; // Get the next element which is the container
            container.innerHTML = ''; // Clear previous inputs

            for (var i = 1; i <= numInputs; i++) {
                var label = document.createElement('label');
                label.setAttribute('for', this.id + '_name_' + i);
                label.textContent = 'ປ້ອນຊື່ລຸ້ນ ' + i + ': ';
                container.appendChild(label);

                var input = document.createElement('input');
                input.setAttribute('type', 'text');
                input.setAttribute('class', 'border rounded p-1 mt-2');
                input.setAttribute('id', this.id + '_name_' + i);
                input.style.width = "500px"
                container.appendChild(input);

                container.appendChild(document.createElement('br'));
            }
        });
    });
</script>

</html>
<?php
// Start the session and include database configuration
include("../config.php");

// Fetch data from the orderamulet and amuletsell tables with a join
$sql = "SELECT o.orderamulet_id, o.amulet_sell_id, o.orderamulet_date, o.orderamulet_qty, o.user_id, 
               o.seller_id, o.new_owner_amulet, a.amulet_sell_name, a.amulet_sell_detail, a.amulet_sell_price,
               a.amulet_sell_img, a.amulet_sell_status, a.amulet_sell_date, a.amuletGroup,
               s.store_name, s.id_card, s.description, s.seller_address, u.username, u.telephone
          FROM orderamulet o
          JOIN amuletsell a ON o.amulet_sell_id = a.amulet_sell_id
          JOIN seller s ON o.seller_id = s.seller_id
          JOIN user u ON o.user_id = u.user_id";

$result = $conn->query($sql);
?>
  <div class="row">
            <h4 class="mt-3 ">ລາຍງານຍອດຜູ້ຂາຍ</h4>
            <h5 class="text-danger">ມີທັງໝົດ <?php echo $result->num_rows; ?> ລາຍການ</h5>
        </div>
        <div class="row">
            <hr>
            <div class="row">
                <h4 class="">ລາຍການຂາຍ</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ລຳດັບ</th>
                            <th scope="col">ລະຫັດສິນຄ້າ</th>
                            <th scope="col">ຊື່ສິນຄ້າ</th>
                            <th scope="col">ຊື່ຮ້ານຄ້າ</th>
                            <th scope="col">ຊື່ຜູ້ຊື້</th>
                            <th scope="col">ເບີໂທຜູ້ຊື້</th>
                            <th scope="col">ຈຳນວນ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $index = 1;
                        while($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <th scope="row"><?php echo $index++; ?></th>
                                <td><?php echo htmlspecialchars($row['amulet_sell_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['amulet_sell_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['store_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['username']); ?></td>
                                <td><?php echo htmlspecialchars($row['telephone']); ?></td>
                                <td><?php echo htmlspecialchars($row['orderamulet_qty']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
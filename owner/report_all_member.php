<?php
// Start the session and include database configuration
include("../config.php");

// Query to get user details
$sql = "SELECT u.user_id, u.username, u.lastname, u.telephone, u.status, u.active, s.store_name
        FROM user u
        LEFT JOIN seller s ON u.user_id = s.user_id";
$result = $conn->query($sql);
?>
     <div class="container mt-5">
        <div class="row">
            <h4 class="mt-3">ລາຍງານຈຳນວນສະມາຊິກ</h4>
            <h5 class="text-danger">ມີທັງໝົດ <?php echo $result->num_rows; ?> ລາຍການ</h5>
        </div>
        <div class="row">
            <hr>
            <div class="row">
                <h4 class="">ລາຍການບັນຊີ</h4>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ລຳດັບ</th>
                            <th scope="col">ລະຫັດຜູ້ໃຊ້</th>
                            <th scope="col">ຊື່ຜູ້ໃຊ້</th>
                            <th scope="col">ຊື່ຮ້ານຄ້າ</th>
                            <th scope="col">ເບີໂທຜູ້ໃຊ້</th>
                            <th scope="col">ສະຖານະ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $index = 1;
                        while($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <th scope="row"><?php echo $index++; ?></th>
                                <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['username'] . ' ' . $row['lastname']); ?></td>
                                <td><?php echo htmlspecialchars($row['store_name'] ? $row['store_name'] : '----------'); ?></td>
                                <td><?php echo htmlspecialchars($row['telephone']); ?></td>
                                <td><?php echo htmlspecialchars($row['active']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
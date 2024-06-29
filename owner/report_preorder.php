<?php
// Start the session
include('../config.php'); // Ensure you have a database connection file

$query = "
SELECT 
    pl.preorderlist_id,
    pl.amulet_pre_id,
    pl.amulet_user_pre_amount,
    pd.amulet_pre_name,
    u.username,
    u.telephone,
    pl.preorder_status,
    pl.preorder_transfer_image 
FROM 
    preorderlist pl
JOIN 
    preorderdetails pd ON pl.amulet_pre_id = pd.amulet_pre_id
JOIN 
    user u ON pl.user_id = u.user_id
";
if ($stmt = $conn->prepare($query)) {
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    echo "Error: " . $conn->error;
    exit;
}
?>
<div class="row">
            <h4 class="mt-3">ລາຍງານຍອດຈອງ</h4>
            <h5 class="text-danger">ຍອດຈອງທັງໝົດມີ <?php echo $result->num_rows; ?> ລາຍການ</h5>
        </div>
        <div class="row">
            <hr>
            <div class="row">
                <h4 class="">ລາຍການຈອງ</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ລຳດັບ</th>
                            <th scope="col">ລະຫັດສິນຄ້າ</th>
                            <th scope="col">ຊື່ສິນຄ້າ</th>
                            <th scope="col">ຊື່ຜູ້ສັ່ງຈອງ</th>
                            <th scope="col">ເບີໂທຜູ້ຂໍສັ່ງຈອງ</th>
                            <th scope="col">ຈຳນວນ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $index = 1;
                        while($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <th scope="row"><?php echo $index++; ?></th>
                                <td><?php echo htmlspecialchars($row['amulet_pre_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['amulet_pre_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['username']); ?></td>
                                <td><?php echo htmlspecialchars($row['telephone']); ?></td>
                                <td><?php echo htmlspecialchars($row['amulet_user_pre_amount']); ?></td>
               
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

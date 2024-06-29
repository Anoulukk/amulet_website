<?php include('../config.php'); ?>

<div class="row">
    <h4 class="mt-3">ລາຍການຂໍລົງທະບຽນບັນຊີຜູ້ໃຊ້</h4>
</div>

<div class="row">
    <hr>

    <!-- Table for pending status -->
    <div class="row">
        <div class="d-flex mb-3">
        <button onclick="showPendingTable()" class="btn btn-sm btn-warning">Pending</button>
        <button onclick="showActiveTable()" class="btn btn-sm btn-warning ms-2">Active</button>
        </div>
        <div id="pendingTable" style="display: block;">
            <h4 class="">ລາຍການບັນຊີ (Pending)</h4>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ລຳດັບ</th>
                        <th scope="col">ລະຫັດຜູ້ໃຊ້</th>
                        <th scope="col">ຊື່ຜູ້ໃຊ້</th>
                        <th scope="col">ເບີໂທຜູ້ໃຊ້</th>
                        <th scope="col">ວັນທີລົງທະບຽນ</th>
                        <th scope="col">ສະຖານະ</th>
                        <th scope="col">ປັບສະຖານະ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    session_start();
                    $adminId = $_SESSION['admin_id'];
                    $sql = "SELECT r.register_id, r.user_id, r.register_date, r.status, u.username, u.lastname, u.telephone
                        FROM register r
                        INNER JOIN user u ON r.user_id = u.user_id
                        WHERE r.status = 'Pending'";

                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["register_id"] . "</td>";
                            echo "<td>" . $row["user_id"] . "</td>";
                            echo "<td>" . $row["username"] . " " . $row["lastname"] . "</td>";
                            echo "<td>" . $row["telephone"] . "</td>";
                            echo "<td>" . $row["register_date"] . "</td>";
                            echo "<td>" . $row["status"] . "</td>";
                            echo "<td>
                                <form action='update_user_status.php' method='post'>
                                    <input type='hidden' name='user_id' value='" . $row["user_id"] . "'>
                                    <input type='hidden' name='admin_id' value='$adminId'>
                                    <button type='submit' class='btn btn-sm btn-warning'>Approve</button>
                                </form>
                              </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Table for active status -->
    <div id="activeTable" style="display: none;">
        <div class="row">
            <h4 class="">ລາຍການບັນຊີ (Active)</h4>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ລຳດັບ</th>
                        <th scope="col">ລະຫັດຜູ້ໃຊ້</th>
                        <th scope="col">ຊື່ຜູ້ໃຊ້</th>
                        <th scope="col">ເບີໂທຜູ້ໃຊ້</th>
                        <th scope="col">ວັນທີລົງທະບຽນ</th>
                        <th scope="col">ສະຖານະ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT r.register_id, r.user_id, r.register_date, r.status, u.username, u.lastname, u.telephone
                        FROM register r
                        INNER JOIN user u ON r.user_id = u.user_id
                        WHERE r.status = 'Active'";

                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["register_id"] . "</td>";
                            echo "<td>" . $row["user_id"] . "</td>";
                            echo "<td>" . $row["username"] . " " . $row["lastname"] . "</td>";
                            echo "<td>" . $row["telephone"] . "</td>";
                            echo "<td>" . $row["register_date"] . "</td>";
                            echo "<td>" . $row["status"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php mysqli_close($conn); ?>
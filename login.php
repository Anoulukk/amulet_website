<!DOCTYPE html>
<html>

<head>
	<title>Login Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" href="login.css">
	<script src="sweetalert2@11.js"></script>
</head>

<body>
	<?php include('config.php'); ?>

	<div class="container">
		<div class="d-flex justify-content-center h-100">
			<div class="card">
				<div class="card-header text-center">
					<h3>ເຂົ້າສູ່ລະບົບ</h3>
				</div>
				<div class="card-body">
					<form method="post">
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" class="form-control" placeholder="username" name="username" autocomplete="off">
						</div>
						<div class="input-group form-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" class="form-control" placeholder="password" name="password">
						</div>
						<div class="row align-items-center remember">
							<input type="checkbox" name="remember">ຈື່ບັນຊີຂອງຂ້ອຍ
						</div>
						<div class="form-group text-center">
							<input type="submit" value="ເຂົ້າສູ່ລະບົບ" class="btn login_btn">
						</div>
					</form>
					<?php
					// Start the session
					session_start();

					// Check if the form is submitted
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						// Retrieve the form data
						$username = $_POST['username'];
						$password = $_POST['password'];

						// Query to check if the provided username and password match a user in the admin table
						$admin_query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
						$admin_result = mysqli_query($conn, $admin_query);

						// Query to check if the provided username and password match a user in the owner table
						$owner_query = "SELECT * FROM owner WHERE username = '$username' AND password = '$password'";
						$owner_result = mysqli_query($conn, $owner_query);

						// Query to check if the provided username and password match a user in the user table
						$user_query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
						$user_result = mysqli_query($conn, $user_query);

						// Check if a matching user is found in any of the tables
						if (mysqli_num_rows($admin_result) > 0) {
							// User is an admin
							$admin_data = mysqli_fetch_assoc($admin_result);
							if (mysqli_num_rows($admin_result) > 0) {
								// User is a regular user and active
								$_SESSION['role'] = 'admin';
								$_SESSION['logged_in'] = true;
								$_SESSION['role'] = 'user';
								$_SESSION['admin_id'] = $admin_data['admin_id'];
								// echo($admin_data['admin_id']);
								header("Location: admin/index.php");
								exit();
							}
						} elseif (mysqli_num_rows($owner_result) > 0) {
							// User is an owner
							$_SESSION['role'] = 'owner';
							$_SESSION['logged_in'] = true;
							header("Location: owner/index.php");
							exit();
						} elseif (mysqli_num_rows($user_result) > 0) {
							// Check if the user is active
							$user_data = mysqli_fetch_assoc($user_result);
							if ($user_data['active'] == 'true') {
								// User is a regular user and active
								$_SESSION['role'] = 'user';
								$_SESSION['logged_in'] = true;
								$_SESSION['role'] = 'user';
								$_SESSION['username'] = $user_data['username'];
								$_SESSION['lastname'] = $user_data['lastname'];
								$_SESSION['tel'] = $user_data['telephone'];
								$_SESSION['active'] = $user_data['active'];
								header("Location: index.php");
								exit();
							} else {
								$_SESSION['role'] = 'user';
								$_SESSION['username'] = $user_data['username'];
								$_SESSION['lastname'] = $user_data['lastname'];
								$_SESSION['tel'] = $user_data['telephone'];
								$_SESSION['active'] = $user_data['active'];
								$_SESSION['logged_in'] = true;
								// User is inactive, show an error message
								echo "<script>
								Swal.fire({
									icon: 'info',
									text: 'ບັນຊີຂອງທ່ານກຳລັງຢູ່ໃນການກວດສອບ',
								}).then((result) => {
									window.location.href = 'index.php';
								});
                  				</script>";
							}
						} else {
							// No matching user found, show an error message
							echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'ຊື່ຜູ້ໃຊ້ ຫຼື ລະຫັດຜ່ານບໍ່ຖືກຕ້ອງ',
                });
              </script>";
						}

						// Close the database connection
						mysqli_close($conn);
					}
					?>




				</div>
				<div class="card-footer">
					<div class="d-flex justify-content-center links">
						ຍັງບໍ່ມີບັນຊີ?<a href="register.php">ລົງທະບຽນບັນຊີຜູ້ໃຊ້</a>
					</div>
				</div>
				<a class="text-dark text-center mt-4" href="index.php">ເຂົ້າເບິ່ງໜ້າຫຼັກ</a>
			</div>
		</div>
	</div>
</body>

</html>
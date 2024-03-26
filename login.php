
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<style>
    /* Made with love by Mutiullah Samim*/

@import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Lao:wght@400;500&display=swap');

html,body{
background-size: cover;
background-repeat: no-repeat;
height: 100%;
font-family: 'Noto Sans Lao', sans-serif;
}

.container{
height: 100%;
align-content: center;
}

.card{
height: 370px;
margin-top: auto;
margin-bottom: auto;
width: 400px;
border-radius: 20px;
background-color: rgba(0,0,0,0.5) !important;
}

.social_icon span{
font-size: 60px;
margin-left: 10px;
color: #FFC312;
}

.social_icon span:hover{
color: white;
cursor: pointer;
}

.card-header h3{
color: #FFC312;
}

.social_icon{
position: absolute;
right: 20px;
top: -45px;
}

.input-group-prepend span{
width: 50px;
/* background-color: #FFC312; */
color: #000000;
border:0 !important;
}

input:focus{
outline: 0 0 0 0  !important;
box-shadow: 0 0 0 0 !important;

}

.remember{
color: white;
}

.remember input
{
width: 20px;
height: 20px;
margin-left: 15px;
margin-right: 5px;
}

.login_btn{
color: black;
background-color: #FFC312;
width: 100px;
margin-top: 20px;
}
#login_btn{
    width: 50%;
margin-top: 10px;
}
.login_btn:hover{
color: black;
background-color: white;
}

.links{
color: white;
}

.links a{
    color: #FFC312;
margin-left: 4px;
}

</style>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header text-center">
				<h3>ເຂົ້າສູ່ລະບົບ</h3>
		
			</div>
			<div class="card-body">
				<form>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="username">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password">
					</div>
					<div class="row align-items-center remember">
						<input type="checkbox">ຈື່ບັນຊີຂອງຂ້ອຍ
					</div>
					<div class="form-group text-center">
						<input type="submit" value="ເຂົ້າສູ່ລະບົບ" class="btn login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					ຍັງບໍ່ມີບັນຊີ?<a href="register.php">ລົງທະບຽນບັນຊີຜູ້ໃຊ້</a>
				</div>
			</div>
			<a class="text-dark text-center mt-4" href="index.php">ເຂົ້າສູ່ໜ້າຫຼັກ</a>
		</div>
	</div>
</div>
</body>
</html>
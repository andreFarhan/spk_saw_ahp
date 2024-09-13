<?php 
	include 'functions.php';

	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$eksekusi = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username'");
		$data 		= mysqli_fetch_array($eksekusi);

		if ($data) {
			if (password_verify($password, $data['password'])) {

				$id_user 			= $data['id_user'];
				$nama_lengkap	= $data['nama_lengkap'];
				$username 		= $data['username'];
				$level 				= $data['level'];
				

				$_SESSION['id_user'] 			= $id_user;
				$_SESSION['nama_lengkap'] = $nama_lengkap;
				$_SESSION['username'] 		= $username;
				$_SESSION['level'] 				= $level;
				$_SESSION['login'] 				= 1;
			}else{

			}
		}
	}
	if (isset($_SESSION['login'])) {
		header("Location: dashboard.php");
		exit;
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="icon" href="img/logo-arrow.png">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="font-awesome/css/all.min.css">
</head>
<body style="background-image: url(img/form-login.jpg); background-repeat: no-repeat; background-size: cover;" class="img-fluid">
	<div class="container mt-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-4 bg-light border" style="border-radius: 10px;">
				<form method="POST">
					<h3 class="font-weight-bold mt-4 text-center mb-5 text-dark"><img src="img/logo-arrow.png" alt="Responsive image" width="100px"> <br>Aplikasi Perbandingan<br>SPK SAW & AHP</h3>
					<div class="form-group">
						<input type="text" class="form-control" name="username" placeholder="USERNAME" required>
					</div>
					<div class="form-group">
						<input type="password" class="form-control" name="password" placeholder="PASSWORD" required>
					</div>
					<div class="form-group">
						<button type="submit" name="login" class="form-control btn btn-primary mb-3">LOGIN <i class="fa fa-sign-in-alt"></i></button>
						<span class="mb-2 text-dark">&#xA9; 2024 Copyright: Yuvita Ratih Dewi</span>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<footer class="page-footer text-center text-md-left">
	<div class="footer-copyright py-3 text-center">
      <div class="container-fluid">
        
      </div>
    </div>
</footer>

<script src="bootstrap/js/jquery-3.4.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="font-awesome/js/all.min.js"></script>

</html>
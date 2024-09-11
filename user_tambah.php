<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	if (isset($_POST['submit'])) {
		if (tambahUser($_POST) > 0) {
			setAlert('Berhasil!','Data Berhasil Ditambahkan','success');
			header("Location: user_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Ditambahkan','error');
			header("Location: user_show.php");
			die;
		}
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tambah User</title>
	<link rel="icon" href="img/logo-perpustakaan.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #CD1818;">
				<form method="POST">
					<h3 class="mt-3">TAMBAH USER</h3>
					<div class="form-group">
						<label for="nama_lengkap">NAMA LENGKAP</label>
						<input type="text" class="form-control" name="nama_lengkap" required>
					</div>
					<div class="form-group">
						<label for="email">EMAIL</label>
						<input type="text" class="form-control" name="email" required>
					</div>
					<div class="form-group">
						<label for="username">USERNAME</label>
						<input type="text" class="form-control" name="username" required>
						<p>* Username Tidak Dapat Diubah!!</p>
					</div>
					<div class="form-group">
						<label for="password">PASSWORD</label>
						<input type="password" class="form-control" name="password" required>
					</div>
					<div class="form-group">
						<label for="password2">KONFIRMASI PASSWORD</label>
						<input type="password" class="form-control" name="password2" required>
					</div>
					<div class="form-group">
						<label for="level">LEVEL</label>
						<select class="form-control" name="level">
							<option value="admin">Admin</option>
							<option value="user">User</option>
						</select>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="submit">TAMBAH <i class="fa fa-paper-plane"></i></button>
						<a class="btn btn-outline-primary" href="user_show.php">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>
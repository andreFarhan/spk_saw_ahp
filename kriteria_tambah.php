<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	if (isset($_POST['submit'])) {
		if (tambahKriteria($_POST) > 0) {
			setAlert('Berhasil!','Data Berhasil Ditambahkan','success');
			header("Location: kriteria_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Ditambahkan','error');
			header("Location: kriteria_show.php");
			die;
		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tambah Kriteria</title>
	<link rel="icon" href="img/logo-arrow.png">
</head>
<body class="bg-light">
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #CD1818;">
				<form method="POST">
					<h3 class="mt-3">TAMBAH KRITERIA</h3>									
					<div class="form-group">
						<label for="kode_kriteria">KODE KRITERIA</label>
						<input type="text" class="form-control" name="kode_kriteria" required>
					</div>
					<div class="form-group">
						<label for="nama_kriteria">NAMA KRITERIA</label>
						<input type="text" class="form-control" name="nama_kriteria" required>
					</div>
					<div class="form-group">
						<label for="bobot_kriteria">BOBOT KRITERIA</label>
						<input type="number" class="form-control" name="bobot_kriteria" step=".01" min="0" max="1" required>
					</div>
					<div class="form-group">
						<label for="jenis_kriteria">JENIS KRITERIA</label>
						<select name="jenis_kriteria" class="form-control">
							<option value="benefit">Benefit</option>
							<option value="cost">Cost</option>
						</select>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="submit">TAMBAH <i class="fa fa-paper-plane"></i></button>
						<a class="btn btn-outline-primary" href="kriteria_show.php">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>
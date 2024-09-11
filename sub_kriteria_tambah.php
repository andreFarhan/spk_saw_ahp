<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	if (isset($_POST['submit'])) {
		if (tambahSubKriteria($_POST) > 0) {
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

	$kode_kriteria = $_GET['kode_kriteria'];

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tambah Sub Kriteria</title>
	<link rel="icon" href="img/logo-motofix.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #CD1818;">
				<form method="POST">
					<h3 class="mt-3">TAMBAH SUB KRITERIA</h3>									
					<div class="form-group">
						<label for="kode_kriteria">KODE SUB KRITERIA</label>
						<input type="text" class="form-control" name="kode_kriteria" value="<?= $kode_kriteria; ?>">
					</div>
					<div class="form-group">
						<label for="nama_kriteria">NAMA SUB KRITERIA</label>
						<input type="text" class="form-control" name="nama_kriteria" required>
					</div>
					<div class="form-group">
						<label for="bobot_kriteria">BOBOT SUB KRITERIA</label>
						<input type="number" class="form-control" name="bobot_kriteria" required>
					</div>
					<div class="form-group">
						<label for="jenis_kriteria">JENIS SUB KRITERIA</label>
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
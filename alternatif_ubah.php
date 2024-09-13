<?php  
	
	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$id_alternatif = $_GET['id_alternatif'];
	$sql = "SELECT * FROM tb_alternatif WHERE id_alternatif = '$id_alternatif'";
	$eksekusi = mysqli_query($koneksi, $sql);
	$data = mysqli_fetch_assoc($eksekusi);

	if (isset($_POST['submit'])) {
		if (ubahAlternatif($_POST) > 0) {
			setAlert('Berhasil!','Data Berhasil Diubah','success');
			header("Location: alternatif_show.php");
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Diubah','error');
			header("Location: alternatif_show.php");
			die;
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ubah Alternatif</title>
	<link rel="icon" href="img/logo-arrow.png">
</head>
<body class="bg-light">
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #CD1818;">
				<form method="POST">
					<h3 class="mt-3">UBAH ALTERNATIF</h3>
					<input type="hidden" name="id_alternatif" value="<?= $data['id_alternatif']; ?>">
					<div class="form-group">
						<label for="nama_alternatif">NAMA KRITERIA</label>
						<input type="text" class="form-control" name="nama_alternatif" value="<?= $data['nama_alternatif']; ?>" required>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="submit">UBAH <i class="fa fa-paper-plane"></i></button>
						<a class="btn btn-outline-primary" href="alternatif_show.php">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>
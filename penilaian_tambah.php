<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	if (isset($_GET['id_alternatif'])) {
		$id_alternatif = $_GET['id_alternatif'];
	}else{
		header("Location: alternatif_show.php");
	}

	if (isset($_POST['submit'])) {
		if (tambahPenilaian($_POST) > 0) {
			setAlert('Berhasil!','Data Berhasil Ditambahkan','success');
			header("Location: penilaian_show.php?id_alternatif=".$id_alternatif);
			die;
		}
		else{
			setAlert('Gagal!','Data Gagal Ditambahkan','error');
			header("Location: penilaian_show.php?id_alternatif=".$id_alternatif);
			die;
		}
	}

	$sql_alternatif = "SELECT * FROM tb_alternatif WHERE id_alternatif = '$id_alternatif'";
	$eksekusi_alternatif = mysqli_query($koneksi, $sql_alternatif);
	$data_alternatif = mysqli_fetch_assoc($eksekusi_alternatif);

	$sql_kriteria = "SELECT * FROM tb_kriteria";
	$eksekusi_kriteria = mysqli_query($koneksi, $sql_kriteria);

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tambah Penilaian</title>
	<link rel="icon" href="img/logo-arrow.png">
</head>
<body class="bg-light">
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5 text-white">
		<div class="row justify-content-center">
			<div class="col-md-6 rounded" style="background-color: #CD1818;">
				<form method="POST">
					<h3 class="mt-3">TAMBAH PENILAIAN</h3>									
					<div class="form-group">
						<label for="id_alternatif">NAMA ALTERNATIF</label>
						<input type="text" class="form-control" name="id_alternatif" value="<?= $data_alternatif['nama_alternatif']; ?>" disabled>
						<input type="hidden" name="id_alternatif" value="<?= $id_alternatif; ?>">
					</div>
					<?php $i=1; while ($data = mysqli_fetch_array($eksekusi_kriteria)) : ?>
					<div class="form-group">
						<label for="nilai"><?= $data['kode_kriteria']; ?> (<?= $data['nama_kriteria']; ?>)</label>
						<input type="hidden" name="kode_kriteria[]" value="<?= $data['kode_kriteria']; ?>">
						<input type="number" name="nilai[]" class="form-control" min="1" max="5" required>
					</div>
					<?php endwhile ?>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" name="submit">TAMBAH <i class="fa fa-paper-plane"></i></button>
						<a class="btn btn-outline-primary" href="penilaian_show.php?id_alternatif=<?= $id_alternatif; ?>">BATAL</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>
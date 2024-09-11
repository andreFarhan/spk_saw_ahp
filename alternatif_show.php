<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$sql = "SELECT * FROM tb_alternatif";
	$eksekusi = mysqli_query($koneksi, $sql);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Alternatif</title>
	<link rel="icon" href="img/logo-perpustakaan.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<h3 class="mt-3">Data Alternatif</h3>
				<table class="table table-striped" id="Table">
					<thead class="text-white" style="background-color: #CD1818">
						<tr>
							<th width="1%">NO</th>
							<th>NAMA ALTERNATIF</th>
							<th class="text-center">AKSI</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; while ($data = mysqli_fetch_array($eksekusi)) : ?>
						<tr>
							<td><?= $i++; ?></td>
							<td><?= $data['nama_alternatif']; ?></td>
							<td class="text-center">
								<a href="penilaian_show.php?id_alternatif=<?= $data['id_alternatif']; ?>" class="btn btn-primary"><i class="fa fa-pen-to-square"></i> Penilaian</a>
								<a href="alternatif_ubah.php?id_alternatif=<?= $data['id_alternatif']; ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
								<a onclick="return confirm('Apakah anda ingin menghapus alternatif <?= $data['nama_alternatif']; ?> ?')" href="alternatif_hapus.php?id_alternatif=<?= $data['id_alternatif']; ?>" class="btn bg-danger text-white"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
						<?php endwhile ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>
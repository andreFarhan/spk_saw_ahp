<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$sql = "SELECT * FROM tb_kriteria";
	$eksekusi = mysqli_query($koneksi, $sql);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Kriteria</title>
	<link rel="icon" href="img/logo-arrow.png">
</head>
<body class="bg-light">
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<h3 class="mt-3">Data Kriteria</h3>
				<table class="table table-striped" id="Table">
					<thead class="text-white" style="background-color: #CD1818">
						<tr>
							<th width="1%">NO</th>
							<th>KODE KRITERIA</th>
							<th>NAMA KRITERIA</th>
							<th>BOBOT KRITERIA</th>
							<th>JENIS KRITERIA</th>
							<th class="text-center">AKSI</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; while ($data = mysqli_fetch_array($eksekusi)) : ?>
						<tr>
							<td><?= $i++; ?></td>
							<td><?= $data['kode_kriteria']; ?></td>
							<td><?= $data['nama_kriteria']; ?></td>
							<td><?= $data['bobot_kriteria']; ?></td>
							<td><?= ucfirst($data['jenis_kriteria']); ?></td>
							<td class="text-center">	
								<a href="kriteria_ubah.php?kode_kriteria=<?= $data['kode_kriteria']; ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
								<a onclick="return confirm('Apakah anda ingin menghapus kriteria <?= $data['nama_kriteria']; ?> ?')" href="kriteria_hapus.php?kode_kriteria=<?= $data['kode_kriteria']; ?>" class="btn bg-danger text-white"><i class="fa fa-trash"></i></a>
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
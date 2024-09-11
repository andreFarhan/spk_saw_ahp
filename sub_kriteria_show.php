<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$kode_kriteria = $_GET['kode_kriteria'];

	$sql = "SELECT * FROM tb_sub_kriteria
	INNER JOIN tb_kriteria ON tb_kriteria.kode_kriteria = tb_sub_kriteria.kode_kriteria
	WHERE tb_kriteria.kode_kriteria = '$kode_kriteria';
	";
	$eksekusi = mysqli_query($koneksi, $sql);

	$sql_nama_kriteria = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT kode_kriteria, nama_kriteria FROM tb_kriteria WHERE kode_kriteria = '$kode_kriteria'"));
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sub Kriteria</title>
	<link rel="icon" href="img/logo-perpustakaan.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5">
		<div class="row justify-content-center">
		<h3 class="mt-3">
			<a class="btn btn-info text-white"><i class="fa-solid fa-boxes-stacked"></i> Sub Kriteria - <?= $sql_nama_kriteria['nama_kriteria']; ?> (<?= $kode_kriteria; ?>)</a> 
        	<a class="btn btn-primary" href="sub_kriteria_tambah.php?kode_kriteria=<?= $kode_kriteria; ?>"><i class="fa fa-box"></i><strong>+</strong> Tambah Sub Kriteria</a>
		</h3>
			<div class="col-md-8">
				<table class="table table-striped" id="Table">
					<thead class="text-white" style="background-color: #CD1818">
						<tr>
							<th width="1%">NO</th>
							<th>NAMA SUB KRITERIA</th>
							<th>NILAI</th>
							<th>AKSI</th>
						</tr>
					</thead>
					<?php $i=1; while ($data = mysqli_fetch_array($eksekusi)) : ?>
					<tbody>
						<tr>
							<td><?= $i++; ?></td>
							<td><?= $data['nama_sub_kriteria']; ?></td>
							<td><?= $data['nilai']; ?></td>
							<td>
								<a href="sub_kriteria_ubah.php?id_sub_kriteria=<?= $data['id_sub_kriteria']; ?>" class="badge badge-success"><i class="fa fa-edit"></i></a>
								<a onclick="return confirm('Apakah anda ingin menghapus sub_kriteria <?= $data['nama_sub_kriteria']; ?> ?')" href="sub_kriteria_hapus.php?id_sub_kriteria=<?= $data['id_sub_kriteria']; ?>" class="badge badge-danger"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
					</tbody>
					<?php endwhile ?>
				</table>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>
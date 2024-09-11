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

	$sql_alternatif = "SELECT * FROM tb_penilaian
	LEFT JOIN tb_kriteria ON tb_kriteria.kode_kriteria = tb_penilaian.kode_kriteria
	LEFT JOIN tb_alternatif ON tb_alternatif.id_alternatif = tb_penilaian.id_alternatif
	WHERE tb_alternatif.id_alternatif = '$id_alternatif'";
	$eksekusi_alternatif = mysqli_query($koneksi, $sql_alternatif);
	$data_alternatif = mysqli_fetch_assoc($eksekusi_alternatif);

	$sql = "SELECT * FROM tb_penilaian
	INNER JOIN tb_kriteria ON tb_kriteria.kode_kriteria = tb_penilaian.kode_kriteria
	INNER JOIN tb_alternatif ON tb_alternatif.id_alternatif = tb_penilaian.id_alternatif
	WHERE tb_penilaian.id_alternatif = '$id_alternatif'
	ORDER BY id_penilaian ASC";
	$eksekusi = mysqli_query($koneksi, $sql);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Penilaian</title>
	<link rel="icon" href="img/logo-perpustakaan.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<h3 class="mt-3">
					Data Penilaian - 
						<?php if ($data_alternatif != 0): ?>
							<span>
								<?= $data_alternatif['nama_alternatif']; ?>
								<a href="penilaian_ubah.php?id_alternatif=<?= $id_alternatif; ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
								<a onclick="return confirm('Apakah anda ingin menghapus data penilaian <?= $data_alternatif['nama_alternatif']; ?> ?')" href="penilaian_hapus.php?id_alternatif=<?= $id_alternatif; ?>" class="btn bg-danger text-white"><i class="fa fa-trash"></i></a>
							</span>
						<?php else: ?>
        					<span>
        						<a class="btn btn-primary" href="penilaian_tambah.php?id_alternatif=<?= $id_alternatif; ?>"><i class="fa fa-pen-to-square"></i><strong>+</strong> Tambah Penilaian</a>
        					</span>
						<?php endif ?>
				</h3>
				<table class="table table-striped" id="Table">
					<thead class="text-white" style="background-color: #CD1818">
						<tr>
							<th width="1%">NO</th>
							<th>NAMA KRITERIA</th>
							<th class="text-center">BOBOT KRITERIA</th>
							<th>JENIS KRITERIA</th>
							<th class="text-center">NILAI</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; while ($data = mysqli_fetch_array($eksekusi)) : ?>
						<tr>
							<td><?= $i++; ?></td>
							<td><?= $data['nama_kriteria']; ?></td>
							<td class="text-center"><?= $data['bobot_kriteria']; ?></td>
							<td><?= ucfirst($data['jenis_kriteria']); ?></td>
							<td class="text-center"><?= $data['nilai']; ?></td>
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
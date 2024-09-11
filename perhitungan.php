<?php 

	include 'functions.php';

	// Cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	// Query kriteria
	$sql = "SELECT * FROM tb_kriteria";
	$eksekusi = mysqli_query($koneksi, $sql);

	// Query penilaian
	$sql_penilaian = "SELECT * FROM tb_penilaian
	INNER JOIN tb_kriteria ON tb_kriteria.kode_kriteria = tb_penilaian.kode_kriteria
	INNER JOIN tb_alternatif ON tb_alternatif.id_alternatif = tb_penilaian.id_alternatif
	ORDER BY tb_alternatif.id_alternatif, tb_kriteria.kode_kriteria ASC";
	$eksekusi_penilaian = mysqli_query($koneksi, $sql_penilaian);

	// Buat array untuk menyimpan penilaian berdasarkan alternatif
	$penilaian = [];
	while ($data = mysqli_fetch_array($eksekusi_penilaian)) {
		$penilaian[$data['id_alternatif']]['nama_alternatif'] = $data['nama_alternatif'];
		$penilaian[$data['id_alternatif']]['nilai'][] = $data['nilai'];
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Perhitungan</title>
	<link rel="icon" href="img/logo-perpustakaan.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<h3 class="mt-3">Data Perhitungan</h3>
				<table class="table table-striped" id="Table">
					<thead class="text-white" style="background-color: #CD1818">
						<tr>
							<th>NO</th>
							<th>NAMA ALTERNATIF</th>
							<?php while ($data_kriteria = mysqli_fetch_array($eksekusi)) : ?>
								<th><?= $data_kriteria['kode_kriteria']; ?></th>
							<?php endwhile ?>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; foreach ($penilaian as $id_alternatif => $data_penilaian) : ?>
						<tr>
							<td><?= $i++; ?></td>
							<td><?= $data_penilaian['nama_alternatif']; ?></td>
							<?php foreach ($data_penilaian['nilai'] as $nilai) : ?>
								<td><?= $nilai; ?></td>
							<?php endforeach; ?>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>

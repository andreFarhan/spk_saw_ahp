<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$sql_penilaian = "SELECT * FROM tb_penilaian
	INNER JOIN tb_kriteria ON tb_kriteria.kode_kriteria = tb_penilaian.kode_kriteria
	INNER JOIN tb_alternatif ON tb_alternatif.id_alternatif = tb_penilaian.id_alternatif
	ORDER BY tb_alternatif.id_alternatif, tb_kriteria.kode_kriteria ASC";
	$eksekusi_penilaian = mysqli_query($koneksi, $sql_penilaian);

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
	<title>Hasil Akhir</title>
	<link rel="icon" href="img/logo-perpustakaan.png">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<h3 class="mt-3">Data Hasil Akhir</h3>
				<table class="table table-striped" id="Table">
					<thead class="text-white" style="background-color: #CD1818">
						<tr>
							<th width="1%">NO</th>
							<th>NAMA ALTERNATIF</th>
							<th class="text-center">NILAI</th>
							<th class="text-center">RANKING</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; foreach ($penilaian as $id_alternatif => $data_penilaian) : ?>
						<tr>
							<td><?= $i++; ?></td>
							<td><?= $data_penilaian['nama_alternatif']; ?></td>
							<?php 
							$total_nilai = 0;
							foreach ($data_penilaian['nilai'] as $nilai) : 
								$total_nilai += $nilai; // Tambahkan nilai setiap kriteria ke total
							?>
							<?php endforeach; ?>
							<td class="text-center"><?= $total_nilai; ?></td>
							<td class="text-center">0</td>
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
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
$kriteria = [];
$max_values = [];
$weights = [];

while ($data = mysqli_fetch_array($eksekusi_penilaian)) {
    $penilaian[$data['id_alternatif']]['nama_alternatif'] = $data['nama_alternatif'];
    $penilaian[$data['id_alternatif']]['nilai'][$data['kode_kriteria']] = $data['nilai'];
    $kriteria[$data['kode_kriteria']] = $data['kode_kriteria'];

    // Track maximum value for each criterion
    if (!isset($max_values[$data['kode_kriteria']]) || $data['nilai'] > $max_values[$data['kode_kriteria']]) {
        $max_values[$data['kode_kriteria']] = $data['nilai'];
    }

    // Assuming weights are stored in 'bobot_kriteria' column in 'tb_kriteria'
    $weights[$data['kode_kriteria']] = $data['bobot_kriteria'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hasil Akhir</title>
    <link rel="icon" href="img/logo-arrow.png">
</head>
<body class="bg-light">
    <?php include 'nav.php'; ?>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
            	<h3 class="mt-3">Perbandingan Data Hasil Akhir</h3>
            </div>
            <div class="col-md-5">
				<!-- Tabel Ranking -->
				<h5 class="mt-4">Tabel Ranking dengan Metode SAW</h5>
				<table class="table table-striped">
				    <thead class="text-white" style="background-color: #CD1818">
				        <tr>
				            <th>NO</th>
				            <th>ALTERNATIF</th>
				            <th>NILAI</th>
				            <th class="text-center">RANKING</th>
				        </tr>
				    </thead>
				    <tbody>
				        <?php 
				        $ranking = [];
				        foreach ($penilaian as $id_alternatif => $data_penilaian) {
				            $total_nilai = 0;
				            foreach ($kriteria as $kode_kriteria) {
				                $normalized_value = $data_penilaian['nilai'][$kode_kriteria] / $max_values[$kode_kriteria];
				                $total_nilai += $normalized_value * $weights[$kode_kriteria];
				            }
				            $ranking[$id_alternatif] = [
				                'nama_alternatif' => $data_penilaian['nama_alternatif'],
				                'total_nilai' => $total_nilai
				            ];
				        }

				       if (!empty($ranking)) {
				            uasort($ranking, function($a, $b) {
				                return $b['total_nilai'] <=> $a['total_nilai'];
				            });
				        } else {
				            echo '<tr><td colspan="4">No data available for ranking.</td></tr>';
				        }

				        $no = 1;
				        $rank = 1;
				        foreach ($ranking as $id_alternatif => $data_ranking) : ?>
				        <tr>
				            <td><?= $no++; ?></td>
				            <td><?= $data_ranking['nama_alternatif']; ?></td>
				            <td><?= rtrim(rtrim(sprintf("%.4f", $data_ranking['total_nilai']), '0'), '.'); ?></td>
				            <td class="text-center"><?= $rank++; ?></td>
				        </tr>
				        <?php endforeach; ?>
				    </tbody>
				</table>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5">
				<!-- Tabel Ranking -->
				<h5 class="mt-4">Tabel Ranking dengan Metode AHP</h5>
				<table class="table table-striped">
				    <thead class="text-white" style="background-color: #CD1818">
				        <tr>
				            <th>NO</th>
				            <th>ALTERNATIF</th>
				            <th>NILAI</th>
				            <th class="text-center">RANKING</th>
				        </tr>
				    </thead>
				    <tbody>
				        <?php 
				        $ranking = [];
				        foreach ($penilaian as $id_alternatif => $data_penilaian) {
				            $total_nilai = 0;
				            foreach ($kriteria as $kode_kriteria) {
				                $normalized_value = $data_penilaian['nilai'][$kode_kriteria] / $max_values[$kode_kriteria];
				                $total_nilai += $normalized_value * $weights[$kode_kriteria];
				            }
				            $ranking[$id_alternatif] = [
				                'nama_alternatif' => $data_penilaian['nama_alternatif'],
				                'total_nilai' => $total_nilai
				            ];
				        }

				       if (!empty($ranking)) {
				            uasort($ranking, function($a, $b) {
				                return $b['total_nilai'] <=> $a['total_nilai'];
				            });
				        } else {
				            echo '<tr><td colspan="4">No data available for ranking.</td></tr>';
				        }

				        $no = 1;
				        $rank = 1;
				        foreach ($ranking as $id_alternatif => $data_ranking) : ?>
				        <tr>
				            <td><?= $no++; ?></td>
				            <td><?= $data_ranking['nama_alternatif']; ?></td>
				            <td><?= rtrim(rtrim(sprintf("%.4f", $data_ranking['total_nilai']), '0'), '.'); ?></td>
				            <td class="text-center"><?= $rank++; ?></td>
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

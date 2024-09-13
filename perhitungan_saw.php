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
    <title>Perhitungan</title>
    <link rel="icon" href="img/logo-arrow.png">
</head>
<body class="bg-light">
    <?php include 'nav.php'; ?>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="mt-3">Data Perhitungan SAW</h3>

                <!-- Matriks Keputusan -->
                <table class="table table-striped" id="Table">
                <h5 class="mt-4">Matriks Keputusan (X)</h5>
                    <thead class="text-white" style="background-color: #CD1818">
                        <tr>
                            <th>NO</th>
                            <th>NAMA ALTERNATIF</th>
                            <?php foreach ($kriteria as $kode_kriteria): ?>
                                <th><?= $kode_kriteria; ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($penilaian as $id_alternatif => $data_penilaian) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $data_penilaian['nama_alternatif']; ?></td>
                            <?php foreach ($kriteria as $kode_kriteria) : ?>
                                <td><?= $data_penilaian['nilai'][$kode_kriteria]; ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Tabel Normalisasi -->
                <h5 class="mt-5">Tabel Normalisasi</h5>
                <table class="table table-striped" id="Table2">
                    <thead class="text-white" style="background-color: #CD1818">
                        <tr>
                            <th>NO</th>
                            <th>NAMA ALTERNATIF</th>
                            <?php foreach ($kriteria as $kode_kriteria): ?>
                                <th><?= $kode_kriteria; ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach ($penilaian as $id_alternatif => $data_penilaian) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $data_penilaian['nama_alternatif']; ?></td>
                            <?php foreach ($kriteria as $kode_kriteria) : ?>
                                <td><?= rtrim(rtrim(sprintf("%.4f", $data_penilaian['nilai'][$kode_kriteria] / $max_values[$kode_kriteria]), '0'), '.'); ?></td>
                            <?php endforeach; ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Tabel Ranking -->
                <h5 class="mt-5">Tabel Perankingan</h5>
                <table class="table table-striped" id="Table3">
                    <thead class="text-white" style="background-color: #CD1818">
                        <tr>
                            <th>NO</th>
                            <th>NAMA ALTERNATIF</th>
                            <th>TOTAL NILAI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $ranking = [];
                        $i = 1; 

                        foreach ($penilaian as $id_alternatif => $data_penilaian) : 
                            $total_nilai = 0;
                            foreach ($kriteria as $kode_kriteria) {
                                $normalized_value = $data_penilaian['nilai'][$kode_kriteria] / $max_values[$kode_kriteria];
                                $total_nilai += $normalized_value * $weights[$kode_kriteria];
                            }
                            $ranking[$id_alternatif] = [
                                'nama_alternatif' => $data_penilaian['nama_alternatif'],
                                'total_nilai' => $total_nilai
                            ];
                        ?>

                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $data_penilaian['nama_alternatif']; ?></td>
                            <td><?= number_format($total_nilai, 4); ?></td>
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

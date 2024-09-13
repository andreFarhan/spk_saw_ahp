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
            <h3 class="col-md-12 text-center mt-3 mb-4">Data Perhitungan</h3>
            <a href="perhitungan_saw.php" class="col-md-2 mx-3 text-center text-white bg-primary rounded pt-2 pb-2" style="text-decoration: none;">
	            <h1>
	                <i class="fa fa-calculator"></i>
	            </h1>
	                <div>Perhitungan SAW</div>
	        </a>
	        <a href="perhitungan_ahp.php" class="col-md-2 mx-3 text-center text-white bg-danger rounded pt-2 pb-2" style="text-decoration: none;">
	            <h1>
	                <i class="fa fa-calculator"></i>
	            </h1>
	                <div>Perhitungan AHP</div>
	        </a>
        </div>
    </div>
</body>

<?php include 'footer.php'; ?>

</html>
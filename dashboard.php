<?php 
    include 'functions.php';

    //cek login
    if ($_SESSION['login'] == 0) {
        header("Location: login_form.php");
    }

    if (isset($_SESSION['nama_lengkap'])) {
        $nama = ucwords($_SESSION['nama_lengkap']);
    }

    $sql_kriteria = "SELECT COUNT(kode_kriteria) as jumlah_kriteria FROM tb_kriteria";
    $eksekusi_kriteria = mysqli_query($koneksi, $sql_kriteria);
    $data_kriteria = mysqli_fetch_assoc($eksekusi_kriteria);

    $sql_alternatif = "SELECT COUNT(id_alternatif) as jumlah_alternatif FROM tb_alternatif";
    $eksekusi_alternatif = mysqli_query($koneksi, $sql_alternatif);
    $data_alternatif = mysqli_fetch_assoc($eksekusi_alternatif);

    $sql_penilaian = "SELECT COUNT(id_penilaian) as jumlah_penilaian FROM tb_penilaian";
    $eksekusi_penilaian = mysqli_query($koneksi, $sql_penilaian);
    $data_penilaian = mysqli_fetch_assoc($eksekusi_penilaian);

    $sql_user = "SELECT COUNT(id_user) as jumlah_user FROM tb_user";
    $eksekusi_user = mysqli_query($koneksi, $sql_user);
    $data_user = mysqli_fetch_assoc($eksekusi_user);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="icon" href="img/logo-arrow.png">
</head>
<body class="bg-light">
    <?php include 'nav.php'; ?>

    <div class="container mt-3">
    <div class="alert alert-info text-center mt-4">
        <h4><b>Selamat Datang <b><?= $nama; ?></b></b></h4>
    </div>

    <h3 class="mt-5"></h3>
    <div class="row justify-content-center">
        <a href="kriteria_show.php" class="col-md-2 mx-3 text-center text-white bg-danger rounded pt-2 pb-2" style="text-decoration: none;">
            <h1>
                <i class="fa fa-box"></i>
                <span class="pull-right">
                    <?= $data_kriteria['jumlah_kriteria']; ?>
                </span>
            </h1>
                <div>Total Kriteria</div>
        </a>
        <a href="alternatif_show.php" class="col-md-2 mx-3 text-center text-white bg-success rounded pt-2 pb-2" style="text-decoration: none;">
            <h1>
                <i class="fa fa-users"></i>
                <span class="pull-right">
                    <?= $data_alternatif['jumlah_alternatif']; ?>
                </span>
            </h1>
                <div>Total Alternatif</div>
        </a>
        <a href="user_show.php" class="col-md-2 mx-3 text-center text-white bg-info rounded pt-2 pb-2" style="text-decoration: none;">
            <h1>
                <i class="fa fa-user"></i>
                <span class="pull-right">
                    <?= $data_user['jumlah_user']; ?>
                </span>
            </h1>
                <div>Total User</div>
        </a>      
    </div>
    <div class="row justify-content-center mt-5">        
        <a href="perhitungan.php" class="col-md-2 mx-3 text-center text-white bg-primary rounded pt-2 pb-2" style="text-decoration: none;">
            <h1>
                <i class="fa fa-pen-to-square"></i>
                <span class="pull-right">
                    <?= $data_penilaian['jumlah_penilaian']; ?>
                </span>
            </h1>
                <div>Total Penilaian</div>
        </a>
        <a href="perhitungan.php" class="col-md-2 mx-3 text-center text-white bg-warning rounded pt-2 pb-2" style="text-decoration: none;">
            <h1>
                <i class="fa fa-calculator"></i>
            </h1>
                <div>Perhitungan</div>
        </a>
        <a href="hasil_akhir.php" class="col-md-2 mx-3 text-center text-white bg-secondary rounded pt-2 pb-2" style="text-decoration: none;">
            <h1>
                <i class="fa fa-chart-column"></i>
            </h1>
                <div>Hasil Akhir</div>
        </a>
    </div>
</div>
    
</body>

<div class="mt-5">
    <?php include 'footer.php'; ?>
</div>

</html>
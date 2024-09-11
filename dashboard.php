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
    <link rel="icon" href="img/logo-perpustakaan.png">
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="container mt-3">
        <h2></h2>
    <div class="alert alert-info text-center">
        <h4><b>Selamat Datang <b><?= $nama; ?></b></b></h4>
    </div>

    <h3 class="text-center p-3 mt-5">Beranda</h3>
    <div class="row justify-content-center">
        <div class="col-md-2 mx-3 text-center text-white bg-danger rounded pt-2 pb-2">
            <h1>
                <i class="fa fa-box"></i>
                <span class="pull-right">
                    <?= $data_kriteria['jumlah_kriteria']; ?>
                </span>
            </h1>
                <div>Total Kriteria</div>
        </div>
        <div class="col-md-2 mx-3 text-center text-white bg-primary rounded pt-2 pb-2">
            <h1>
                <i class="fa fa-users"></i>
                <span class="pull-right">
                    <?= $data_alternatif['jumlah_alternatif']; ?>
                </span>
            </h1>
                <div>Total Alternatif</div>
        </div>
        <div class="col-md-2 mx-3 text-center text-white bg-success rounded pt-2 pb-2">
            <h1>
                <i class="fa fa-pen-to-square"></i>
                <span class="pull-right">
                    <?= $data_penilaian['jumlah_penilaian']; ?>
                </span>
            </h1>
                <div>Total Penilaian</div>
        </div>
        <div class="col-md-2 mx-3 text-center text-white bg-info rounded pt-2 pb-2">
            <h1>
                <i class="fa fa-user"></i>
                <span class="pull-right">
                    <?= $data_user['jumlah_user']; ?>
                </span>
            </h1>
                <div>Total User</div>
        </div>      
    </div>
</div>
    
</body>

<div class="mt-5">
    <?php include 'footer.php'; ?>
</div>

</html>
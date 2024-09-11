  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="bootstrap/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="font-awesome/css/all.min.css">

<style type="text/css">
    .container {
        margin-top: 30px;
    }
    .dropdown-toggle,
    .dropdown-menu {
        border-radius: 0px !important;
    }
    .dropdown-item:hover {
        color: white;
        background-color: #0f4c81;
    }
    .btn-danger {
        width: 55%;
    }
    .dropdown:hover>.dropdown-menu {
      display: block;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #820000">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php if ($_SERVER['REQUEST_URI'] == '/spk_saw_ahp/dashboard.php'): ?>
        <li class="nav-item active">
          <a class="nav-link" href="dashboard.php"><i class="fa fa-home"></i> Beranda</a>
        </li>
      <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php"><i class="fa fa-home"></i> Beranda</a>
        </li>
      <?php endif ?>


    <?php if ($_SERVER['REQUEST_URI'] == '/spk_saw_ahp/kriteria_show.php' OR $_SERVER['REQUEST_URI'] == '/spk_saw_ahp/kriteria_tambah.php' OR $_SERVER['SCRIPT_NAME'] == '/spk_saw_ahp/kriteria_ubah.php'): ?>
    <li class="nav-item dropdown active">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-box"></i> Kriteria
      </a>
      <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="kriteria_show.php"><i class="fa fa-box"></i> Kriteria</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="kriteria_tambah.php"><i class="fa fa-box"></i><strong>+</strong> Tambah Kriteria</a>
      </div>
    </li>
    <?php else: ?>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-box"></i> Kriteria
      </a>
      <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="kriteria_show.php"><i class="fa fa-box"></i> Kriteria</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="kriteria_tambah.php"><i class="fa fa-box"></i><strong>+</strong> Tambah Kriteria</a>
      </div>
    </li>
    <?php endif ?>
    
    <?php if ($_SERVER['SCRIPT_NAME'] == '/spk_saw_ahp/penilaian_show.php' OR $_SERVER['SCRIPT_NAME'] == '/spk_saw_ahp/penilaian_tambah.php' OR $_SERVER['SCRIPT_NAME'] == '/spk_saw_ahp/penilaian_ubah.php' OR $_SERVER['REQUEST_URI'] == '/spk_saw_ahp/alternatif_tambah.php' OR $_SERVER['SCRIPT_NAME'] == '/spk_saw_ahp/alternatif_ubah.php' OR $_SERVER['SCRIPT_NAME'] == '/spk_saw_ahp/alternatif_show.php'): ?>
    <li class="nav-item dropdown active">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-users"></i> Alternatif
      </a>
      <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="alternatif_show.php"><i class="fa fa-users"></i> Alternatif</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="alternatif_tambah.php"><i class="fa fa-user-plus"></i> Tambah Alternatif</a>
      </div>
    </li>
    <?php else: ?>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-users"></i> Alternatif
      </a>
      <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="alternatif_show.php"><i class="fa fa-users"></i> Alternatif</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="alternatif_tambah.php"><i class="fa fa-user-plus"></i> Tambah Alternatif</a>
      </div>
    </li>
    <?php endif ?>

    <?php if ($_SERVER['REQUEST_URI'] == '/spk_saw_ahp/perhitungan.php'): ?>
      <li class="nav-item active">
        <a class="nav-link" href="perhitungan.php"><i class="fa fa-calculator"></i> Perhitungan</a>
      </li>
    <?php else: ?>
      <li class="nav-item">
        <a class="nav-link" href="perhitungan.php"><i class="fa fa-calculator"></i> Perhitungan</a>
      </li>
    <?php endif ?>

    <?php if ($_SERVER['REQUEST_URI'] == '/spk_saw_ahp/hasil_akhir.php'): ?>
      <li class="nav-item active">
        <a class="nav-link" href="hasil_akhir.php"><i class="fa fa-chart-column"></i> Hasil Akhir</a>
      </li>
    <?php else: ?>
      <li class="nav-item">
        <a class="nav-link" href="hasil_akhir.php"><i class="fa fa-chart-column"></i> Hasil Akhir</a>
      </li>
    <?php endif ?>


    <?php if ($_SERVER['REQUEST_URI'] == '/spk_saw_ahp/user_show.php' OR $_SERVER['REQUEST_URI'] == '/spk_saw_ahp/user_tambah.php' OR $_SERVER['SCRIPT_NAME'] == '/spk_saw_ahp/user_ubah.php'): ?>
    <li class="nav-item dropdown active">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user"></i> User
      </a>
      <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="user_show.php"><i class="fa fa-user"></i> User</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="user_tambah.php"><i class="fa fa-user-plus"></i> Tambah User</a>
      </div>
    </li>
    <?php else: ?>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user"></i> User
      </a>
      <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="user_show.php"><i class="fa fa-user"></i> User</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="user_tambah.php"><i class="fa fa-user-plus"></i> Tambah User</a>
      </div>
    </li>
    <?php endif ?>

      <li class="nav-item">
        <a onclick="return confirm('Apakah anda ingin keluar?')" class="nav-link" href="logout.php"><i class="fa fa-door-open"></i> Keluar</a>
      </li>
    </ul>

      <?php $username = ucwords($_SESSION['username']); ?>
       <?php if (isset($_SESSION['id_user'])): ?>
          <b class="mr-sm-2 mb-n1 text-white">Admin, <?= $username; ?></b>
       <?php else: ?>
          <b class="mr-sm-2 mb-n1 text-white"><?= $username; ?></b>
       <?php endif ?>

  </div>
</nav>
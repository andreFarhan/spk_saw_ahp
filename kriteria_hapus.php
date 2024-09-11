<?php 
	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$kode_kriteria = $_GET['kode_kriteria'];

	if (hapusKriteria($kode_kriteria) > 0) {
		setAlert('Berhasil!','Data Berhasil Dihapus','success');
		header("Location: kriteria_show.php");
		die;
	}
	else{
		setAlert('Gagal!','Data Gagal Dihapus','error');
		header("Location: kriteria_show.php");
		die;
	}
 ?>
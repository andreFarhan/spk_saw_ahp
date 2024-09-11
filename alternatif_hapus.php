<?php 
	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$id_alternatif = $_GET['id_alternatif'];

	if (hapusAlternatif($id_alternatif) > 0) {
		setAlert('Berhasil!','Data Berhasil Dihapus','success');
		header("Location: alternatif_show.php");
		die;
	}
	else{
		setAlert('Gagal!','Data Gagal Dihapus','error');
		header("Location: alternatif_show.php");
		die;
	}
 ?>
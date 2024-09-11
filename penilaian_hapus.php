<?php 
	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$id_alternatif = $_GET['id_alternatif'];

	if (hapusPenilaian($id_alternatif) > 0) {
		setAlert('Berhasil!','Data Berhasil Dihapus','success');
		header("Location: penilaian_show.php?id_alternatif=".$id_alternatif);
		die;
	}
	else{
		setAlert('Gagal!','Data Gagal Dihapus','error');
		header("Location: penilaian_show.php?id_alternatif=".$id_alternatif);
		die;
	}
 ?>
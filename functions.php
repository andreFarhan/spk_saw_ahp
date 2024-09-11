<?php 
	
	session_start();

	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "db_spk_saw_ahp";

	$koneksi = mysqli_connect($host,$user,$password,$database);

	date_default_timezone_set('asia/jakarta');

	function tambahUser($data){
		global $koneksi;
		$email = $data['email'];
		$username = $data['username'];
		$password = $data['password'];
		$password2 = $data['password2'];
		$nama_lengkap = ucwords(strtolower($data['nama_lengkap']));
		$level = $data['level'];

		$result = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username'");

		if (mysqli_fetch_assoc($result)) {
			setAlert('Gagal!','Username Telah Digunakan','error');
			header("Location: user_tambah.php");
			die;
		}
		if ($password !== $password2) {
			setAlert('Gagal!','Konfirmasi Password Salah','error');
			header("Location: user_tambah.php");
			die;
		}

		$password = password_hash($password, PASSWORD_DEFAULT);

		$sql = "INSERT INTO tb_user VALUES('','$email','$username','$password','$nama_lengkap','$level')";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);

	}

	function tambahKriteria($data){
		global $koneksi;
		$kode_kriteria = $data['kode_kriteria'];
		$nama_kriteria = $data['nama_kriteria'];
		$bobot_kriteria = $data['bobot_kriteria'];
		$jenis_kriteria = $data['jenis_kriteria'];

		$sql = "INSERT INTO tb_kriteria VALUES('$kode_kriteria','$nama_kriteria', '$bobot_kriteria', '$jenis_kriteria')";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	
	function ubahUser($data){
		global $koneksi;
		$id_user = $data['id_user'];
		$email = $data['email'];
		$username = $data['username'];
		$password = $data['password'];
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		$password2 = $data['password2'];
		$password_lama = $data['password_lama'];
		$nama_lengkap = ucwords(strtolower($data['nama_lengkap']));
		$level = $data['level'];

		$result = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username'");
		$fetch = mysqli_fetch_assoc($result);
		$password_lama_verify = password_verify($password_lama, $fetch['password']);

		if ($password !== $password2) {
			echo "
			<script>
			alert('Konfirmasi Password tidak sama!')
			</script>
			";
			return false;
		}

		if ($password_lama_verify) {
			$sql = "UPDATE tb_user SET email = '$email', password = '$password_hash', nama_lengkap = '$nama_lengkap', level = '$level' WHERE id_user = '$id_user'";
			$eksekusi = mysqli_query($koneksi, $sql);

			return mysqli_affected_rows($koneksi);
		}else{
			echo "
			<script>
			alert('Password Lama tidak benar!')
			</script>
			";
			return false;
		}

	}

	function ubahKriteria($data){
		global $koneksi;
		$kode_kriteria = $data['kode_kriteria'];
		$nama_kriteria = $data['nama_kriteria'];
		$bobot_kriteria = $data['bobot_kriteria'];
		$jenis_kriteria = $data['jenis_kriteria'];

		$sql = "UPDATE tb_kriteria SET nama_kriteria = '$nama_kriteria', bobot_kriteria = '$bobot_kriteria', jenis_kriteria = '$jenis_kriteria' WHERE kode_kriteria = '$kode_kriteria'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	

	function hapusUser($id){
		global $koneksi;
		$sql = "DELETE FROM tb_user WHERE id_user = '$id'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	function hapusKriteria($id){
		global $koneksi;
		$sql = "DELETE FROM tb_kriteria WHERE kode_kriteria = '$id'";
		$eksekusi = mysqli_query($koneksi, $sql);

		return mysqli_affected_rows($koneksi);
	}

	
	function setAlert($title='',$text='',$type='',$buttons=''){

		$_SESSION["alert"]["title"]		= $title;
		$_SESSION["alert"]["text"] 		= $text;
		$_SESSION["alert"]["type"] 		= $type;
		$_SESSION["alert"]["buttons"]	= $buttons; 

	}

	if (isset($_SESSION['alert'])) {

		function alert(){
			$title 		= $_SESSION["alert"]["title"];
			$text 		= $_SESSION["alert"]["text"];
			$type 		= $_SESSION["alert"]["type"];
			$buttons	= $_SESSION["alert"]["buttons"];

			echo"
			<div id='msg' data-title='".$title."' data-type='".$type."' data-text='".$text."' data-buttons='".$buttons."'></div>
			<script>
				let title 		= $('#msg').data('title');
				let type 		= $('#msg').data('type');
				let text 		= $('#msg').data('text');
				let buttons		= $('#msg').data('buttons');

				if(text != '' && type != '' && title != ''){
					Swal.fire({
						title: title,
						text: text,
						icon: type,
					});
				}
			</script>
			";
			unset($_SESSION["alert"]);
		}
	}
 ?>
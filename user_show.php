<?php 

	include 'functions.php';

	//cek login
	if ($_SESSION['login'] == 0) {
		header("Location: login_form.php");
	}

	$sql = "SELECT * FROM tb_user
			ORDER BY id_user DESC
			";
	$eksekusi = mysqli_query($koneksi, $sql);

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>User</title>
	<link rel="icon" href="img/logo-arrow.png">
</head>
<body class="bg-light">
	<?php include 'nav.php'; ?>
	<div class="container mt-5 mb-5">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<h3 class="mt-3">User</h3>
				<table class="table table-striped" id="Table">
					<thead class="text-white" style="background-color: #CD1818">
						<tr>
							<th width="1%">NO</th>
							<th>NAMA</th>
							<th>EMAIL</th>
							<th>LEVEL</th>
							<th class="text-center">AKSI</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; while ($data = mysqli_fetch_array($eksekusi)) : ?>
						<tr>
							<td><?= $i++; ?></td>
							<td><?= ucwords($data['nama_lengkap']); ?></td>
							<td><?= $data['email']; ?></td>
							<td><?= ucfirst($data['level']); ?></td>
							<td class="text-center">
								<a id="tombol-hapus" href="user_ubah.php?id_user=<?= $data['id_user']; ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
								<a onclick="return confirm('Apakah Anda Ingin Menghapus <?= ucwords($data['username']); ?> ?')" href="user_hapus.php?id_user=<?= $data['id_user']; ?>" class="btn bg-danger text-white"><i class="fa fa-trash"></i></a>
							</td>
						</tr>
						<?php endwhile ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>

</html>

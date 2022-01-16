<?php 
require 'functions.php';

	//CEK APAKAH TOMBOL SUBMIT SUDAH DITEKAN ATAU BELUM
if (isset($_POST["submit"])) {


		//CEK APAKAH DATA BERHASIL DITAMBAH ATAU TIDAK
	if (posting($_POST) > 0) {
		echo "
		<script>
		alert('postingan berhasil ditambahkan');
		document.location.href = 'index.php';
		</script> 
		";
	} else {
		echo "
		<script>
		alert('postingan gagal ditambahkan');
		document.location.href = 'index.php';
		</script>
		";
	}
}
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="icon" href="assets/img/favicon.ico" type="image/x-icon">
	<title>Our Journey</title>

	<link rel="stylesheet" href="assets/css/styleposting.css"> 
</head>
<body>
	<nav>
		<div class="layar">
			<div class="logo">
				<a href="#"><img src="assets/img/logo.png"></a>
			</div>
			<div class="menu">
				<ul>
					<li><a href="index.php">Home</a></li>	
					<li><a href="logout.php"><img src="assets/img/Logout.png"></a></li>
				</ul>
			</div>
		</div>
	</nav>
	<section class="posting">
		<form action="" method="POST" enctype="multipart/form-data">
			<h1 style="text-align: center;">POSTING</h1>
			<div class="avatar">
				<label for="avatar">AVATAR</label> <br/>
				<p>Pilih gambar / foto yang ingin digunakan sebagai avatar</p>
				<input type="file" name="avatar" id="avatar">
				<hr>
			</div>

			<div class="username">
				<label for="username">USERNAME</label> <br/>
				<p>Pilih username yang ingin digunakan ketika posting</p>
				<input type="text" name="username" id="username" size="40" required>
				<hr>
			</div>

			<div class="gambar">
				<label for="gambar">GAMBAR / FOTO</label> <br/>
				<p>Pilih gambar yang ingin digunakan ketika posting</p>
				<p style="color: red;">Pastikan kualitas gambar masih bagus dalam ukuran 720px</p>
				<input type="file" name="gambar" id="gambar">	
				<hr>
			</div>

			<div class="caption">
				<label for="caption">CAPTION</label> <br/>
				<textarea rows="30" cols="116" name="caption" id="caption" required></textarea>
			</div>
			<div class="button-post">
				<button type="submit" name="submit" class="posting-button">POSTING</button>
			</div>
		</form>

	</body>
	</html>
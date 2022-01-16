<?php 

session_start();

//CEK SUDAH LOGIN ATAU BELUM
if ( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'functions.php';

$id = $_GET["id"];


//QUERY DATA POSTINGAN BERDASARKAN ID
$postingan = query("SELECT * FROM beranda WHERE id = $id")[0];

	//CEK APAKAH TOMBOL SUBMIT SUDAH DITEKAN ATAU BELUM
	if (isset($_POST["submit"])) {

		//CEK APAKAH DATA BERHASIL DIUBAH ATAU TIDAK
		if (ubah($_POST) > 0) {
				echo "
				<script>
					alert('postingan berhasil diubah');
					document.location.href = 'index.php';
				</script> 
				";
			} else {
				echo "
				<script>
				alert('postingan gagal diubah');
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

	<link rel="stylesheet" href="assets/css/styleubah.css"> 
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

	<section class="ubah">

	<form action="" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $postingan["id"]; ?>">
		<input type="hidden" name="avatarLama" value="<?php echo $postingan["avatar"]; ?>">
		<input type="hidden" name="gambarLama" value="<?php echo $postingan["gambar"]; ?>">

		<div class="avatar">
				<label for="avatar">AVATAR</label> <br/>
				<img src="assets/img/<?php echo $postingan['avatar']; ?>" width = "40" > <br>
				<p>Pilih foto / gambar untuk avatar yang baru</p>
				<input type="file" name="avatar" id="avatar">
				<hr>
			</div>

			<div class="username">
				<label for="username">USERNAME</label> <br/>
				<p>Input username baru</p>
				<input type="text" name="username" id="username" required value="<?php echo $postingan["username"]; ?>">
				<hr>
			</div>

			<div class="gambar">
				<label for="gambar">GAMBAR</label>  <br/>
				<img src="assets/img/<?php echo $postingan['gambar']; ?>"> <br>
				<p>Pilih foto / gambar baru yang ingin diupload</p>
				<p style="color: red;">Pastikan kualitas gambar masih bagus dalam ukuran 720px</p>
				<input type="file" name="gambar" id="gambar" >
				<hr>
			</div>

			<div class="caption">
				<label for="caption">CAPTION</label> <br/>
				<p>Tulis caption baru</p>
				<textarea rows="30" cols="116" name="caption" id="caption" required="<?php echo $postingan["caption"]; ?>"> </textarea>
			</div>
			<div class="button-ubah">
				<button type="submit" name="submit" class="ubah-button">EDIT</button>
			</div>
		
	</form>
</body>
</html>
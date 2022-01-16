<?php 

require 'functions.php';

if( isset($_POST["register"])){
	if (registrasi($_POST) > 0 ) {
		echo "
		<script>
		alert('Registrasi berhasil Silahkan Login' );
		</script> ";
	}else {
		echo mysqli_error($conn);
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

	<link rel="stylesheet" href="assets/css/styleSignup.css"> 

	<style>
	label {
		display: block;
	}
</style>

</head>
<body>
	<div class="layarsatu">
		<div class="gambarSignup">
			<img src="assets/img/gambarSignup.png">
		</div>
	</div>

	<div class="layardua">
		<div class="logo">
			<a href="index.html"><img src="assets/img/logo.png"></a>
		</div>
		<div class="back">
			<a href="login.html"><img src="assets/img/back.png"></a>
		</div>
		<div class="signUpPage">
			<h3>Buat Akunmu</h3>
			<h4>Untuk gabung OJ, harus daftar dulu</h4>
		<div class="form">
			<form action="" method="POST">
					<div class="form-floating">
						<input type="text" name="username" id="username" class="form-control" placeholder="Masukkan Username">
						<label for="username">Username : </label>
					</div>
					<div class="form-floating">
						<input type="email" name="email" id="email" class="form-control" placeholder="Masukkan Email">
						<label for="email">Email : </label>
					</div>
					<div class="form-floating">
						<input type="password" name="password" id="password" class="form-control" placeholder=" Masukkan Password">
						<label for="password">Password : </label>
					</div>
					<div class="form-floating">
						<input type="password" name="password2" id="password2" class="form-control"placeholder=" Konfirmasi Password">
						<label for="password2">Konfirmasi Password : </label>
					</div>
						<button type="submit" name="register" class="button-submit">Register </button>
					<div class="form-footer">
                        <p> Sudah punya akun ? <a href="login.php">Login</a></p>
                    </div>
			</form>
		</div>
	</div>
</body>

</body>
</html>
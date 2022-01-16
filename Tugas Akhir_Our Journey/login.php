<?php 

session_start();
require 'functions.php';

//CEK COOKIE
if ( isset($_COOKIE['id']) && isset($_COOKIE['key']) ){
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	//ambil username berdasarkan id
	$result = mysqli_query($conn, "SELECT username from user WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	//CEK COOKIE dan username
	if( $key === hash('sha256' , $row['username'])) {
		$_SESSION['login'] == true;
	}
}


if (isset ($_SESSION["login"]) ){
	header("Location: index.php");
	exit;
}


if (isset($_POST["login"])){

	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username
		= '$username'");

	//cek USERNAME
	if(mysqli_num_rows($result) === 1 ) {

		//CEK PASSWORD
		$row = mysqli_fetch_assoc($result);
		if( password_verify($password, $row["password"])) {

			//SET SESSION
			$_SESSION["login"] = true;


			//CEK REMEMBER ME
			if( isset($_POST["remember"]) ){
				//buat cookie
				setcookie('id', $row['id'],time()+3600);
				setcookie('key', hash('sha256', $row['username'], time()+3600));
			}

			header("Location: index.php");
			exit;
		}

	}
	$error = true;
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

	<link rel="stylesheet" href="assets/css/styleLogin.css">
</head>
<body>
	<div class="layarsatu">
		<div class="gambarlogin">
			<img src="assets/img/gambarlogin.png">
		</div>
	</div>
	<div class="layardua">
		<div class="logo">
			<a href="index.html"><img src="assets/img/logo.png"></a>
		</div>
		<div class="loginPage">
			<h3>Welcome</h3>
			<h4>Login to your account</h4>

			<?php if( isset($error) ): ?>
				<p style="color: red;">username / password salah</p>
			<?php endif; ?>

			<form action="" method="POST">
				<div class="form-floating">
					<input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username">
					<label class="styleform" for="username">Username </label>
				</div>
				<div class="form-floating">
					<input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password">
					<label class="styleform" for="password">Password </label>
				</div>	

					<input type="checkbox" name="remember" id="remember"></input>
					<label for="remember" >Remember me</label>
				
				<button type="submit" name="login" class="button-submit">Login</button>
				<div class="form-footer">
					<p> Belum punya account? <a href="registrasi.php">Register</a></p>
				</div>	
			</form>
		</div>
	</div>
</body>
</html>
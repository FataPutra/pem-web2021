<?php 

session_start();

//CEK SUDAH LOGIN ATAU BELUM
if ( !isset($_SESSION["login"]) ) {
	header("Location: index.html");
	exit;
}

require 'functions.php';
$beranda = query("SELECT * FROM  beranda ORDER BY id DESC");

// //ambil data dari tabel beranda / query data beranda
// $result = mysqli_query($conn , "SELECT * FROM beranda");
// if (!$result) {
// 	// code...
// 	echo mysqli_error($conn);
// }

//ambil data fetch() dari tabel beranda atau objek result
//mysqli_fetch_row() //mengembalikan array numerik
//mysqli_fetch_assoc() //mengembalikan array assositif
//mysqli_fetch_array() //mengembalikan keduanya
//mysqli_fetch_object()

// while($beranda = mysqli_fetch_assoc($result)) {
// 	var_dump($beranda);
// }



//TOMBOL CARI DI TEKAN
if (isset($_POST["cari"]) ) {

	$beranda = cari($_POST["keyword"]);

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

	<link rel="stylesheet" href="assets/css/styleindex.css"> 

</head>
<body>
	<nav>
    <div class="layar">
        <div class="logo">
            <a href="#"><img src="assets/img/logo.png"></a>
        </div>
        <div class="menu">
            <ul>
            	<form action="" method="POST" class="search">
						<input type="text" class="boxsearch" name="keyword" size="25" placeholder=" Search" autocomplete="off">
						<button class="ikonsearch" type="submit" name="cari"><img src="assets/img/search.png"></button>
					</form>
                <li><a href="#">Home</a></li>	
                <li><a href="posting.php">Posting</a></li>
                <li><a href="logout.php"><img src="assets/img/Logout.png"></a></li>
            </ul>
        </div>
    </div>
    </nav>

<section class="beranda">
	<?php foreach ($beranda as $row) : ?>
	<ul>
		<div class="avatar">
			<li><img src="assets/img/<?php echo $row["avatar"];?>" width = "50"></li>

			<li class="username"><?php echo $row ["username"];?></li>
		</div>

		<div class="gambar">
		<li><img src="assets/img/<?php echo $row["gambar"];?>"></li>
		</div>

		<div class="aksi">
		<li><a href="ubah.php?id=<?php echo $row["id"];?>">EDIT</a> | <a href="hapus.php?id=<?php echo $row["id"];?>" onclick="return confirm ('yakin ?');">DELETE</a></li>
		<hr>
		</div>

		<div class="caption">
		<li><?php echo $row ["caption"];?></li>
		</div>
	</ul>
	<?php endforeach;?>
</section>
</body>
</html>
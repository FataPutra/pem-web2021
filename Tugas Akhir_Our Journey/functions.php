<?php 
//koneksi ke  database
$conn = mysqli_connect ("localhost" , "root" , "" ,"tugasakhir");

function query($query) {
	global $conn;
	$result = mysqli_query($conn , $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

function posting($data){
	global $conn;


	//upload gambar avatar 
	$avatar = uploadAvatar();

	if(!$avatar){
		return false;
	}

	
	$username = htmlspecialchars($data["username"]);

	//UPLOAD GAMBAR
	$gambar = uploadGambar();

	if(!$gambar) {
		return false;
	}


	$caption = htmlspecialchars($data["caption"]);

	$query = "INSERT INTO beranda
				VALUES
				('','$avatar', '$username', '$gambar', '$caption')
				";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function uploadAvatar(){

	$namaFile = $_FILES['avatar']['name'];
	$ukuranFile = $_FILES['avatar']['size'];
	$error = $_FILES['avatar']['error'];
	$tmpName = $_FILES['avatar']['tmp_name'];

	//CEK APAKAH TIDAK ADA AVATAR YANG DIUPLOAD 
	if($error === 4) {
		echo "
		<script>
			alert('pilih gambar terlebih dahulu !');
		</script>";
		return false;
	}

	//CEK APAKAH YANG DIUPLOAD ADALAH GAMBAR
	$ekstensiGambarValid = ['jpg' ,'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));

	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ){
		echo "
		<script>
			alert('Yang Anda Upload Bukan Gambar');
		</script>";
		return false;
	}


	//CEK JIKA UKURANNYA TERLALU BESAR
	if( $ukuranFile > 50000000) {
		echo "
		<script>
			alert('Ukuran gambar terlalu besar !');
		</script>";
		return false;
	}

	//LOLOS PENGECEKAN , GAMBAR SIAP DIUPLOAD

	//GENERATE NAMA GAMBAR BARU
	$namaFileBaru = uniqid();
	$namaFileBaru .= $ekstensiGambar;


	move_uploaded_file($tmpName, 'assets/img/' . $namaFileBaru);
	return $namaFileBaru;
}


function uploadGambar(){

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	//CEK APAKAH TIDAK ADA AVATAR YANG DIUPLOAD 
	if($error === 4) {
		echo "
		<script>
			alert('pilih gambar terlebih dahulu !');
		</script>";
		return false;
	}

	//CEK APAKAH YANG DIUPLOAD ADALAH GAMBAR
	$ekstensiGambarValid = ['jpg' ,'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));

	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ){
		echo "
		<script>
			alert('Yang Anda Upload Bukan Gambar');
		</script>";
		return false;
	}


	//CEK JIKA UKURANNYA TERLALU BESAR
	if( $ukuranFile > 10000000) {
		echo "
		<script>
			alert('Ukuran gambar terlalu besar !');
		</script>";
		return false;
	}

	//LOLOS PENGECEKAN , GAMBAR SIAP DIUPLOAD

	//GENERATE NAMA GAMBAR BARU
	$namaFileBaru = uniqid();
	$namaFileBaru .= $ekstensiGambar;


	move_uploaded_file($tmpName, 'assets/img/' . $namaFileBaru);
	return $namaFileBaru;
}



function hapus($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM beranda WHERE id = $id");

	return mysqli_affected_rows($conn);
}



function ubah($data){
	global $conn;
	$id = $data["id"];

	$avatarLama = htmlspecialchars($data["avatarLama"]);

	//CEK APAKAH USER PILIH AVATAR BARU ATAU TIDAK
	if ($_FILES['avatar']['error']=== 4) {
		$avatar = $avatarLama;
	} else {
		$avatar = uploadAvatar();
	}
	

	$username = htmlspecialchars($data["username"]);

	$gambarLama = htmlspecialchars($data["gambarLama"]);

	//CEK APAKAH USER PILIH GAMBAR BARU ATAU TIDAK
	IF ($_FILES['gambar']['error']=== 4) {
		$gambar = $gambarLama;
	}else {
		$gambar = uploadGambar();
	}

	$caption = htmlspecialchars($data["caption"]);

	$query = "UPDATE beranda SET 
				avatar = '$avatar',
				username = '$username' ,
				gambar = '$gambar',
				caption = '$caption'

				WHERE id = $id
				";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
	var_dump($conn);
}


function cari($keyword){
	$query = "SELECT * FROM beranda 
				WHERE
				username LIKE '%$keyword%'
				";
	return query($query);
}


function registrasi($data){
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$email = stripslashes($data["email"]);
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn , $data["password2"]);

	//CEK USERNAME SUDAH ADA ATAU BELUM
	$result = mysqli_query($conn, "SELECT username FROM user WHERE
		username = '$username' ");
	if(mysqli_fetch_assoc($result)) {
		echo "
		<script>
		alert('username sudah terdaftar !')
		</script>";

	return false;

	}
	

	//CEK EMAIL SUDAH ADA ATAU BELUM
	$resultEmail = mysqli_query($conn, "SELECT email FROM user WHERE
		email = '$email' ");
	if(mysqli_fetch_assoc($resultEmail)) {
		echo "
		<script>
		alert('email sudah digunakan !')
		</script>";

	return false;

	}


	//CEK KONFIRMASI PASSWORD
	if ($password !== $password2) {
		echo "<script>
				alert('konfirmasi password tidak sesuai');
			</script>";
		return false;
	}

	//ENKRIPSI PASSWORD
	$password = password_hash($password, PASSWORD_DEFAULT);


	//TAMBAHKAN USER BARU KE DATABASE
	mysqli_query($conn, "INSERT INTO user VALUES('','$username','$email' , '$password')");

	return mysqli_affected_rows($conn);
}

 ?>



<?
	include "koneksi.php";
	
	$namaawal = $_POST['namaawal'];
	$namaakhir = $_POST['namaakhir'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['pass'];
	$tanggal = $_POST['tanggal'];
	$bulan = $_POST['bulan'];
	$tahun = $_POST['tahun'];
	
	$data = mysql_query("select * from member where username = '$username' OR email = '$email'");
	$cek = mysql_num_rows($data);
	$nomor = mysql_fetch_array($data);

	
	if(empty($namaawal)){
		echo "<br>nama awal tidak boleh kosong";
		echo "<meta http-equiv='refresh' content='3;registrasi.php'/>";
	} else if(empty($email)) {
		echo "<br>email tidak boleh kosong";
		echo "<meta http-equiv='refresh' content='3;registrasi.php'/>";
	} else if(empty($username)) {
		echo "<br>username tidak boleh kosong";
		echo "<meta http-equiv='refresh' content='3;registrasi.php'/>";
	} else if(empty($password)) {
		echo "<br>password tidak boleh kosong";
		echo "<meta http-equiv='refresh' content='3;registrasi.php'/>";
	} else if($cek>0){	
		echo "<br>username atau email tersebut sudah pernah terdaftar";
		echo "<meta http-equiv='refresh' content='3;registrasi.php'/>";
	} else {
		mysql_query("insert into member (namaawal,namaakhir,username,password,email,tanggallahir) values ('$namaawal','$namaakhir','$username','$password','$email','$tanggal/$bulan/$tahun')");
		echo "<br>data tersimpan! mengalihkan kembali ke halaman utama.";
		echo "<meta http-equiv='refresh' content='5;index.php'/>";
	}
?>



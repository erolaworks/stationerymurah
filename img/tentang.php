<?
	
	include "koneksi.php";
?>


<!doctype html>
<html lang="en">
	<head>
		<meta name="stationerymurah" content="stationery"/>
		<meta charset="utf-8"/>
		<title>stationerymurah</title>
		<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
		<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=PT+Sans:700' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div id="header">
			<div id="header-container1">
				<div class="minilink">
				</div>
				<header><h1><a href="#">stationerymurah</a></h1></header>
				<div class="headerintro">
					<div class="loginform">
					<?
					if(!empty($_SESSION['loggedin']) && !empty($_SESSION['username'])){
					?>
						<p>Username<a href="#"><?=$_SESSION['username']?></a></p><br />
						<a href="keranjang.php">Keranjang</a>
						<a href="logout.php">logout</a>
					<?
					}else if(!empty($_POST['username']) && !empty($_POST['password'])){
						$username = $_POST['username'];
						$password = $_POST['password'];
						
						$checklogin = mysql_query("select * from member where username ='$username' AND password = '$password'");
						
						if(mysql_num_rows ($checklogin) == 1){
							$row = mysql_fetch_array($checklogin);
							$namaawal = $row['namawal'];
							$_SESSION['username'] = $username;
							$_SESSION['password'] = $password;
							$_SESSION['loggedin'] = 1;
							
							echo "berhasil masuk! Mengatur kembali ke halaman awal";
							echo "<meta http-equiv='refresh' content='=2;index.php'/>";
						}else{
							echo "error! maaf anda belum terdaftar! Mohon klik <a href='registrasi.php'>registrasi</a> dahulu untuk mendaftar.";
						}
					}else{
						?>
						<form action="index.php" method="post">
							<ul>
								<li>
									<label for="username">Username</label>
									<input type="text" name="username" id="username"/>
								</li>
								<li>
									<label for="password">Password</label>
									<input type="password" name="password" id="password"/>
								</li>
								<li>
									<input type="submit" name="login" id="login" value="login"/>
								</li>
							</ul>
						</form><br />	
						<span class="register"><a href="registrasi.php">Register</a></span>
						<?
					}
					?>
					</div>
					<img src="img/intro.jpg" alt="intro" />
				</div>
			</div>
			<nav>
				<ul>
					<li><a href="index.php">BERANDA</a></li>
					<li><a href="produk.php">PRODUK</a></li>
					<li><a href="belanja.php">CARA BELANJA</a></li>
					<li><a href="bayar.php">CARA PEMBAYARAN</a></li>
					<li><a href="tentangkami.php">TENTANG KAMI</a></li>
				</ul>
			</nav>
		</div>
		<div id="container">		
			<div id="kontententang">
				<section class="tentang">
					<article class="tentang1">
						<h2>OVERVIEW</h2> 
						<p>
							Stationerymurah.com<br />menyediakan berbagai<br />kebutuhan 
							stationery dan<br />alat tulis kantor dari<br />
							berbagai merek dengan<br />kualitas terbaik dan harga murah.
						</p>
					</article>
				</section>
				<section class="tentang">
					<article class="tentang2">
						<h2>OUR SERVICE</h2>
						<p>
							Kami memiliki visi untuk<br />menjadi penyedia<br />kebutuhan stationery<br />
							kualitas terbaik yang<br />terpercaya dan andal<br />
							untuk semua kalangan.
						</p>
					</article>
				</section>
				<section class="tentang">
					<article class="tentang3">
						<h2>SERVE BETTER</h2>
						<p>
							Katalog produk yang <br /> 
							variatif didukung dengan <br />
							layanan prima menjadi <br />
							motivasi kami untuk selalu <br />
							memberikan yang terbaik.
						</p>
					</article>
				</section>
			</div>
		</div>
		<footer>
			<div id="footnav1">
				<section class="footmenu">
				<ul>
					<li><h4>PRODUK</h4></li>
					<li><a href="#">Alat Tulis Sekolah & Kantor</a></li>
					<li><a href="#">Binder</a></li>
					<li><a href="#">Buku Tulis</a></li>
					<li><a href="#">Botol Minum & Tempat Makan</a></li>
					<li><a href="#">Fancy Gifts</a></li>
					<li><a href="#">Kotak Pensil</a></li>
					<li><a href="#">Notes-Diary</a></li>
					<li><a href="#">Tas Sekolah</a></li>
					<li><a href="#">Lain-lain</a></li>
				</ul>
				</section>
				<section class="footmenu">
					<ul>
						<li><h4>PEMBELIAN</h4></li>
						<li><a href="belanja.php">Cara Berbelanja</a></li>
						<li><a href="bayar.php">Cara Pembayaran</a></li>
					</ul>
				</section>
				<section class="footkontak">
					<article>
						<h4>Stationerymurah.com</h4><br />
						<p>Pasar Koja Baru blok AKS A181<br />belakang toko mas Chin Chiang <br /> waktu buka : Senin - Sabtu; 08:00 - 16:00</p><br />
						<p>Telp. (021) 345 8989 <br /> Fax. (021) 345 6699</p>
					</article>
				</section>
			</div>
			<div id="footnav2">
				<section class="footkiri">
					<p>Copyright @ Stationerymurah.com - 2014 | Developed by <a href="#">Erolaworks</a></p>
				</section>
				
				<section class="footkanan">
					<ul>
						<li><a href="index.php">Beranda</a></li>
						<li>|</li>
						<li><a href="produk.php">Produk</a></li>
						<li>|</li>
						<li><a href="belanja.php">Cara Belanja</a></li>
						<li>|</li>
						<li><a href="bayar.php">Cara Pembayaran</a></li>
						<li>|</li>
						<li><a href="tentangkami.php">Tentang Kami</a></li>
					</ul>
				</section>
			</div>
		</footer>
	</body>
</html>

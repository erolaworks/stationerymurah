<?
	session_start();
?>
<!doctype html>
<html lang="en">
	<head>
		<meta name="stationerymurah" content="stationery"/>
		<meta charset="utf-8"/>
		<title>stationerymurah</title>
		<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
	</head>
	<body>
		<div id="header">
			<div id="header-container1">
				<div class="minilink">
					<?
						include "koneksi.php";
						
					?>
				</div>
				<header><h1><a href="#">stationerymurah</a></h1></header>
				<div class="headerintro">
					<div class="loginform">
					<?
					if(!empty($_SESSION['loggedin']) && !empty($_SESSION['username'])){
					?>
						<p>Username<a href="#"><?=$_SESSION['username']?></a></p><br />
						<a href="#">Keranjang</a>
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
						</form>							
						<?
					}
				?>
					</div>
					<img src="img/intro.jpg" alt="intro" />
				</div>
			</div>
			<nav>
				<a href="index.php">BERANDA</a>
				<a href="produk.php">PRODUK</a>
				<a href="belanja.php">CARA BELANJA</a>
				<a href="bayar.php">CARA PEMBAYARAN</a>
				<a href="tentang.php">TENTANG KAMI</a>
			</nav>
		</div>
		<div id="container">
			<div id="kiri">
				<div class="kategori">
					<div class="badge">
						<h2>KATEGORI</h2><br /><h3>PRODUK</h3>
						<img src="img/kategori-badge.jpg" alt="kategori" />
					</div>
					<ul>
						<li><a href="#">Online Via Chart</a></li>
						<li><a href="#">Via Telepon</a></li>
						<li><a href="#">Via SMS/Chat/Mail</a></li>
						<li><a href="#">Kunjungan Toko</a></li>
					</ul>
				</div>
				
			</div>
			<div id="kanan">
				<div class="cari">
					<p>Pencarian<br />produk</p>
					<form action="#" method="post">
						<ul>
							<li class="keyword">
								<label for="#">Kata kunci</label>
								<input type="#" name="katakunci" id="katakunci"/>
							</li>
							<li>
								<label for="sort">cari berdasarkan</label>
								<select name="sort" id="sort">
									<option value=""></option>
									<option value="kategori">Kategori</option>
									<option value="merek">Merek</option>
								</select>
							</li>
							<li>
								<input type="submit" value="Cari" name="cari" id="cari"/>
							</li>
						</ul>
						<hr />
					</form>
				</div>
				
				<div class="banner">
					<img src="img/banner-index.jpg" alt="banner" />
				</div>
				
				<div class="announce">
					<section class="belanja">
						<article>
							<h4>Bayar di Tempat (COD)</h4>
							<p>Pembayaran dilakukan pada saat barang diterima oleh Anda. Ketentuan ini hanya berlaku untuk Anda yang berada di wilayah Jakarta.
								Bentuk pembayaran berupa tunai atau <i>cash</i> keras.
							</p>
						</article>
					</section>
					<section class="belanja">
						<article>
							<h4>Transfer Bank</h4>
							<p>Pembayaran melalui transfer bank ke nomor rekening resmi yang muncul pada halaman konfirmasi keranjang belanja Anda, 
								atau informasi nomor rekening resmi lewat telepon. Anda harus melakukan konfirmasi pembayaran kepada kami setelah melakukan transfer.
							</p>
						</article>
					</section>
					<section class="belanja">
						<article>
							<h4>Via SMS/Chat/EMail</h4>
							<p>
								Pertanyaan tentang produk dapat dikonsultasikan lewat beberapa cara sebagai berikut: <br />
								<ul>
									<li>SMS : 085695636434</li>
									<li>Chat : <a href="#">yahoo messenger</a></li>
									<li>Email : <a href="#">info@stationerymurah.com</a></li>
								</ul>
							</p>
						</article>
					</section>
					<section class="belanja">
						<article>
							<h4>Kunjungan Toko</h4>
							<p>Anda dapat datang langsung ke toko stationery.com pada alamat berikut.<br />
								Pasar Koja Baru blok AKS A181, belakang toko mas Chin Chiang <br />
								waktu buka : Senin - Sabtu; 08:00 - 16:00
							</p>
						</article>
					</section>
				</div>
			</div>
		</div>
		<footer>
			<div id="footnav1">
				<section class="footmenu">
				<ul>
					<li><h4>PRODUK</h4></li>
					<li><a href="#">Pena & Pensil</a></li>
					<li><a href="#">Perlengkapan Kantor</a></li>
					<li>Perangko & Stiker</li>
					<li>Media Penyimpanan</li>
					<li>Kartu Ucapan</li>
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
					</ul>
				</section>
			</div>
		</footer>
	</body>
</html>

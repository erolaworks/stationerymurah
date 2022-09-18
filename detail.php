<?
	session_start();
	include "koneksi.php";
?>


<!doctype html>
<html lang="en">
	<head>
		<meta name="stationerymurah" content="stationery"/>
		<meta charset="utf-8"/>
		<title>stationerymurah</title>
		<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
		<script type="text/javascript" src=js/jquery.cycle.js></script>
		<script type="text/javascript" src=js/slideshow.js></script>
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
						<p>Username<a href="memberaccount.php"><?=$_SESSION['username']?></a></p><br />
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
					<li><a href="tentang.php">TENTANG KAMI</a></li>
				</ul>
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
						<li><a href="produk.php?kat=KAT0001">Pena & Pensil</a></li>
						<li><a href="produk.php?kat=KAT0002">Notebook/Diary</a></li>
						<li><a href="produk.php?kat=KAT0003">Kotak Pensil</a></li>
						<li><a href="produk.php?kat=KAT0003">Kalender</a></li>
						<li><a href="produk.php?kat=KAT0004">Binder</a></li>
						<li><a href="produk.php?kat=KAT0005">Buku Alamat</a></li>
						<li><a href="produk.php?kat=KAT0006">Album Foto</a></li>
						<li><a href="produk.php?kat=KAT0007">Kartu Ucapan</a></li>
						<li><a href="produk.php?kat=KAT0008">Stamp</a></li>
						<li><a href="produk.php?kat=KAT0009">Stiker</a></li>
						<li><a href="produk.php?kat=KAT0010">CD/DVD</a></li>
						<li><a href="produk.php?kat=KAT0011">USB Flashdisk</a></li>
					</ul>
				</div>
				<div id="slideshow">
					<h2>HOT</h2><br /><h3>PROMO</h3>
					<div class="slides">
						
					</div>
				</div>
			</div>
			<div id="kanan">
				<div class="cari">
					<p>Pencarian<br />produk</p>
					<form action="index.php" method="post">
						<ul>
							<li>
								<label for="sort">urut berdasarkan</label>
								<select name="sort" id="sort">
									<option value=""></option>
									<option value="baru">Terbaru</option>
									<option value="asc">Nama barang (A-Z)</option>
									<option value="desc">Nama barang (Z-A)</option>
									<option value="termurah">Harga terendah</option>
									<option value="termahal">Harga termahal</option>
								</select>
							</li>
							<li>
								<input type="submit" value="OK" name="cari" id="cari"/>
							</li>
						</ul>
						<hr />
					</form>
				</div>
				<div id="paging">
				<?
					$page = "index.php";
					
					if(!empty($_POST['sort']) OR !empty($_GET['sortir'])){
						$sort = $_POST['sort'];
						$sortir = $_GET['sortir'];
						
						if($sort == "baru" OR $sortir == "baru"){
							$query = mysql_query ("select * from barang where status = 'baru'");
						}else if($sort == "asc" OR $sortir == "asc"){
							$query = mysql_query ("select * from barang order by nama_barang");
						}else if($sort == "desc" OR $sortir == "desc"){
							$query = mysql_query ("select * from barang order by nama_barang desc");
						}else if($sort == "termurah" OR $sortir == "termurah"){
							$query = mysql_query ("select * from barang order by harga");
						}else{
							$query = mysql_query ("select * from barang order by harga desc");
						}
					}else{
						$query = mysql_query ("select * from barang");
					}
					
					$jmldata = mysql_num_rows($query);
					$jmlhalaman = ceil($jmldata/$batas);
					
					if($halaman > 1){
						$previous = $halaman - 1;
						if(!empty($sort)){
							echo "<a href=$page?sortir=$sort&halaman=1><< Awal</a> | <a href=$page?sortir=$sort&halaman=$previous>Sebelumnya</a>";
						}else{
							echo "<a href=$page?sortir=$sortir&halaman=1><< Awal</a> | <a href=$page?sortir=$sortir&halaman=$previous>Sebelumnya</a>";
						}						
					}else{
						echo "<< Awal | Sebelumnya";
					}
					
					$angka = ($halaman > 3 ? " ... " : " ");
					for($i=$halaman-2;$i<$halaman;$i++){
						if($i<1)
						continue;
							if(!empty($sort)){
								$angka .= "<a href=$page?sortir=$sort&halaman=$i>$i</a>";
							}else{
								$angka .= "<a href=$page?sortir=$sortir&halaman=$i>$i</a>";
							}
					}
					
					$angka .= "<b>$halaman</b>";
					for($i=$halaman+1;$i<($halaman+3);$i++){
						if($i > $jmlhalaman)
						break;
						if(!empty($sort)){
							$angka .= "<a href=$page?sortir=$sort&halaman=$i>$i</a>";
						}else{
							$angka .= "<a href=$page?sortir=$sortir&halaman=$i>$i</a>";
						}
					}
					
					if(!empty($sort)){
						$angka .= ($halaman+2<$jmlhalaman ? " ... <a href=$page?sortir=$sort&halaman=$jmlhalaman>$jmlhalaman</a> " : " ");
					}else{
						$angka .= ($halaman+2<$jmlhalaman ? " ... <a href=$page?sortir=$sortir&halaman=$jmlhalaman>$jmlhalaman</a> " : " ");
					}
					echo "$angka";
					
					if($halaman < $jmlhalaman){
						$next = $halaman + 1;
						if(!empty($sort)){
							echo "<a href=$page?sortir=$sort&halaman=$next>Selanjutnya</a> | <a href=$page?sortir=$sort&halaman=$jmlhalaman>Akhir >></a>";
						}else{
							echo "<a href=$page?sortir=$sortir&halaman=$next>Selanjutnya</a> | <a href=$page?$sortir=$sortir&halaman=$jmlhalaman>Akhir >></a>";
						}

					}else{
						echo "Selanjutnya | Akhir >>";
					}
				?>
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
						<li>|</li>
						<li><a href="tentang.php">Tentang Kami</a></li>
					</ul>
				</section>
			</div>
		</footer>
	</body>
</html>

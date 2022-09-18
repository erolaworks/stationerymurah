<?
	session_start();
	include "koneksi.php";
	
	if(isset($_GET['action']) && ($_GET['action']=="hapus")){
		$id = $_GET['id'];
		
		$action = $_GET['action'];
		
		switch($_GET['action']){
			case'hapus':
			if(isset($_SESSION['cart'][$id])){
				unset($_SESSION['cart'][$id]);
				if(empty($_SESSION['cart'][$id])){
					$pesan = "keranjang barang Anda kosong";
				}
			}else{
				$pesan = "barang yang dimaksud tidak ada";
			}
			break;
		}
	}
	
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
					}
					?>
					</div>
					<img src="img/intro.jpg" alt="intro" />
				</div>
			</div>
			<nav>
				<ul>
					<li><a href="index.php">BERANDA</a></li>
					<li><a href="#">PRODUK</a></li>
					<li><a href="belanja.php">CARA BELANJA</a></li>
					<li><a href="bayar.php">CARA PEMBAYARAN</a></li>
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
				<div class="kontak">
					<div class="badge">
						<h2>KONTAK</h2><br /><h3>KAMI</h3>
						<img src="img/kategori-badge.jpg" alt="kategori" />
					</div>
					<ul>
						<li><a href="#">lorem ipsum</a></li>
						<li><a href="#">lorem ipsum</a></li>
						<li><a href="#">lorem ipsum</a></li>
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
				<div class="keranjang">
				<form action="" method="post">
				<table>
					<tr>
						<td>No.</td>
						<td>Nama Barang</td>
						<td>Pembatalan</td>
					</tr>
					<?
					if(!empty($_SESSION['cart'])){
						$cart = $_SESSION['cart'];
						$no_urut = 0;
						$total = 0;
						foreach ($cart as $key => $value){
							$no_urut++;
							$sql = "select * from barang where kode_barang = '$key'";
							$hasil = mysql_query($sql);
							
							while($data = mysql_fetch_array($hasil)){
							?>
								<tr>
									<td><? echo "$no_urut"; ?></td>
									<td><? echo "$data[nama_barang]"; ?></td>
									<td><a href="?action=hapus&id=<?echo "$key";?>">Batal</a></td>
								</tr>
							<?							
							}
						}
					}else{
						echo "tidak ada barang di keranjang";
					}
					?>
				</table>
				<?
					if(!empty($_SESSION['cart'])){
						echo "<input type='submit' value='oke' name='oke' id='oke' />";
					}else{
						echo "<input type='submit' value='oke' name='oke' id='oke' disabled/>";
					}
				?>
				</form>
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
						<li><a href="#">Produk</a></li>
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

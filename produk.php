<?
	session_start();
	include "koneksi.php";
	
	$halaman = $_GET['halaman'];
	$kategori = $_GET['kat'];
	
	if(!empty($_SESSION['loggedin']) && !empty($_SESSION['username'])){
		if(isset($_GET['action']) && ($_GET['action']=="beli")){
			$id = $_GET['kodebarang'];
			
			if(isset($_SESSION['cart'][$id])){
				$message = "barang sudah pernah dimasukkan";
			}else{
				$sql = mysql_query("select * from barang where kode_barang = '$id'");
				$cekquery = mysql_num_rows($sql);
				
				if($cekquery>0){
					$dataquery = mysql_fetch_array($sql);
					$_SESSION['cart'][$dataquery['kode_barang']]=array("jumlah"=>1);
					$message = "barang sudah dimasukkan di keranjang!";
				}else{
					$message = "barang ini tidak terdaftar!";
				}
			}
		}
	}else{
		$message = "login dahulu untuk dapat memesan barang secara online!";
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
		<?
		if(isset($_GET['kat'])){
		?>
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
						<?
						if(isset($_GET['action']) && ($_GET['action']=="beli")){
						?>
							<h3><?echo "$message";?></h3>
						<?
						}else{
							echo "";
						}
						?>
					</form>
				</div>
				<div id="grid">
				<?
					$batas = 8;
					
					if(empty($halaman)){
						$posisi = 0;
						$halaman = 1;
					}else{
						$posisi = ($halaman-1) * $batas;
					}
					
					$q = mysql_query ("select * from barang where kode_kategori = '$kategori' limit $posisi, $batas");
				?>
				
				<table>
					<tr>
					<?
						$file = "detail.php";
						$jml_kolom = 4;
						$cnt = 0;
						
						while($data = mysql_fetch_object($q)){
							if($cnt >= $jml_kolom){
								echo "<tr></tr>";
								$cnt = 0;
							}
							
							$cnt++;
					?>
						<td>
							<section class="gambar">
							
							<figure>
								<? if ($data->name == null) {
									?>
										<img width="140" height="128" src="img/produk/<?echo "sampel.jpg"; ?>"/>
									<?
									} else {
									?>
										<img width="140" height="128" src="img/produk/<?echo $data->name;?>"/>
									<?
									}
									 ?>

								<figcaption>
								
								<h2><?echo "<a href=$file?barang=$data->kode_barang>$data->nama_barang</a>" ?></h2>
							
									<table>
										<tr>
											<td class="harga"><span><? echo "Rp <a href=#>$data->harga</a>" ?></span></td>
											<td class="beli"><span><?echo "<a href=?kat=$kategori&action=beli&kodebarang=$data->kode_barang>Beli</a>"?></span></td>
										</tr>
									</table>
								</figcaption>
							</figure>
							</section>
						</td>
					<?
					}
					?>
					</tr>					
				</table>
				</div>
				
				<div id="paging">
				<?
					$page = "produk.php";
					$query = mysql_query("select * from barang where kode_kategori = '$kategori'");
					$jmldata = mysql_num_rows($query);
					$jmlhalaman = ceil($jmldata/$batas);
					
					if($halaman > 1){
						$previous = $halaman - 1;
						echo "<a href=$page?kat=$kategori&halaman=1><< Awal</a> | <a href=$page?kat=$kategori&halaman=$previous>Sebelumnya</a>";
					}else{
						echo "<< Awal | Sebelumnya";
					}
					
					$angka = ($halaman > 3 ? " ... " : " ");
					for($i=$halaman-2;$i<$halaman;$i++){
						if($i<1)
						continue;
							$angka .= "<a href=$page?kat=$kategori&halaman=$i>$i</a>";
					}
					
					$angka .= "<b>$halaman</b>";
					for($i=$halaman+1;$i<($halaman+3);$i++){
						if($i > $jmlhalaman)
						break;
						$angka .= "<a href=$page?kat=$kategori&halaman=$i>$i</a>";
					}
					
					$angka .= ($halaman+2<$jmlhalaman ? " ... <a href=$page?kat=$kategori&halaman=$jmlhalaman>$jmlhalaman</a> " : " ");
					echo "$angka";
					
					if($halaman < $jmlhalaman){
						$next = $halaman + 1;
						echo "<a href=$page?kat=$kategori&halaman=$next>Selanjutnya</a> | <a href=$page?kat=$kategori&halaman=$jmlhalaman>Akhir >></a>";
					}else{
						echo "Selanjutnya | Akhir >>";
					}
				?>
				</div>
			</div>
		<?
		}else{
		?>
		<div id="row">
			<section class="barang">
				<a href="produk.php?kat=KAT0001">
					<figure>
						<img src="img/kategori/penapensil.jpg" alt="kategori" />
						<figcaption>Pena / Pensil</figcaption>
					</figure>
				</a>
			</section>
			<section class="barang">
				<a href="produk.php?kat=KAT0002">
					<figure>
						<img src="img/kategori/notebook.jpg" alt="kategori" />
						<figcaption>Notebook / Diary</figcaption>
					</figure>
				</a>
			</section>
			<section class="barang">
				<a href="produk.php?kat=KAT0003">
					<figure>
						<img src="img/kategori/kotakpensil.jpg" alt="kategori" />
						<figcaption>Kotak Pensil</figcaption>
					</figure>
				</a>
			</section>
			<section class="barang">
				<a href="produk.php?kat=KAT0004">
					<figure>
						<img src="img/kategori/kalender.jpg" alt="kategori" />
						<figcaption>Kalender</figcaption>
					</figure>
				</a>
			</section>
		</div>

		<div id="row">
			<section class="barang">
				<a href="produk.php?kat=KAT0005">
					<figure>
						<img src="img/kategori/binder.jpg" alt="kategori" />
						<figcaption>Binder</figcaption>
					</figure>
				</a>
			</section>
			<section class="barang">
				<a href="produk.php?kat=KAT0006">
					<figure>
						<img src="img/kategori/bukualamat.jpg" alt="kategori" />
						<figcaption>Buku Alamat</figcaption>
					</figure>
				</a>
			</section>
			<section class="barang">
				<a href="produk.php?kat=KAT0007">
					<figure>
						<img src="img/kategori/albumfoto.jpg" alt="kategori" />
						<figcaption>Album Foto</figcaption>
					</figure>
				</a>
			</section>
			<section class="barang">
				<a href="produk.php?kat=KAT0008">
					<figure>
						<img src="img/kategori/kartuucapan.jpg" alt="kategori" />
						<figcaption>Kartu Ucapan</figcaption>
					</figure>
				</a>
			</section>
		</div>
		<div id="row">
			<section class="barang">
				<a href="produk.php?kat=KAT0009">
					<figure>
						<img src="img/kategori/stamp.jpg" alt="kategori" />
						<figcaption>Stamp</figcaption>
					</figure>
				</a>
			</section>
			<section class="barang">
				<a href="produk.php?kat=KAT0010">
					<figure>
						<img src="img/kategori/stiker.jpg" alt="kategori" />
						<figcaption>Stiker</figcaption>
					</figure>
				</a>
			</section>
			<section class="barang">
				<a href="produk.php?kat=KAT0011">
					<figure>
						<img src="img/kategori/cddvd.jpg" alt="kategori" />
						<figcaption>CD / DVD</figcaption>
					</figure>
				</a>
			</section>
			<section class="barang">
				<a href="produk.php?kat=KAT0012">
					<figure>
						<img src="img/kategori/usbflashdisk.jpg" alt="kategori" />
						<figcaption>USB Flashdisk</figcaption>
					</figure>
				</a>
			</section>
		</div>
		<?
		}
		?>
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

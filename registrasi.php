<?
	include "koneksi.php";
?>


<!doctype html>
<html>
	<head>
		<title>stationerymurah</title>
		<meta name="stationerymurah" content="stationery"/>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
	</head>
	<body>
		<div id="header">
			<div id="header-container1">
				<div class="minilink">
					<?
						$server = mysql_connect ("localhost","root","");
						$database = mysql_select_db ("stationerymurah");
						
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
						</form><br />	
						<span class="register"><a href="#">Register</a></span>
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
				<div class="bag">
					
				</div>
			</div>
			<div id="kanan">
				<form action="daftarmember.php" method="post" class="daftar">
					<table>
						<tr>
							<td>
								<ul class="label">
									<li><label for="namaawal">Nama Awal</label></li>
									<li><label for="namaakhir">Nama Akhir</label></li>
									<li><label for="email">Email</label></li>
									<li><label for="tanggallahir">Tanggal lahir</label></li>
									<li><label for="username">Username</label></li>
									<li><label for="password">Password</label></li>
								</ul>
							</td>
							<td>
								<ul class="isian">
									<li>
										<input type="text" name="namaawal" id="namaawal"/>
									</li>
									<li>
										<input type="text" name="namaakhir" id="namaakhir"/>
									</li>
									<li>
										<input type="text" name="email" id="email"/>
									</li>
									<li>
										<select name="tanggal" id="tanggal">
											<option value="0">
												<?
													for($i=1;$i<=31;$i++)
													echo "<option value = $i>$i";
												?>
											</option>
										</select>
										
										<select name="bulan" id="bulan">
											<option value="januari">Januari</option>
											<option value="februari">Februari</option>
											<option value="maret">Maret</option>
											<option value="april">April</option>
											<option value="mei">Mei</option>
											<option value="juni">Juni</option>
											<option value="juli">Juli</option>
											<option value="agustus">Agustus</option>
											<option value="september">September</option>
											<option value="oktober">Oktober</option>
											<option value="november">November</option>
											<option value="desember">Desember</option>
										</select>
										
										<select name="tahun" id="tahun">
											<option value="0">
												<?
													$now = (integer) date("Y");
													
													for($i=$now;$i>($now-120);$i--)
													echo "<option value = $i>$i";
												?>
											</option>
										</select>
									</li>
									<li>
										<input type="text" name="username" id="username"/>
									</li>
									<li>
										<input type="password" name="pass" id="pass"/>
									</li>
									<li>
										<input type="submit" name="oke" id="oke" value="Oke"/>
										<input type="reset" name="batal" id="batal" value="Batal"/>
									</li>
								</ul>
							</td>
						</tr>
					</table>
				</form>
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

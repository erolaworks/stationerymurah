
<!doctype html>
<html>
	<head>
		<title>admin-barang</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="style.css" media="screen" type="text/css"/>
		<script>
					function disableElement()	
					{
						document.getElementById("tambah").disabled=true;
						document.getElementById("edit").disabled=true;
						document.getElementById("hapus").disabled=true;
						document.getElementById("submit").disabled=false;
						document.getElementById("reset").disabled=false;
					}
					
					function enableElement()
					{
						document.getElementById("tambah").disabled=false;
						document.getElementById("edit").disabled=false;
						document.getElementById("hapus").disabled=false;
						document.getElementById("submit").disabled=true;
						document.getElementById("reset").disabled=true;
					}
		</script>
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
						</form>							
						<?
					}
				?>
					</div>
					<img src="img/intro.jpg" alt="intro" />
				</div>
			</div>
			<nav>
				<a href="index.php">Beranda</a>
				<a href="">Barang</a>
				<a href="">Kategori</a>
				<a href="">Supplier</a>
				<a href="">Merek</a>
				<a href="">Satuan</a>
				<a href="">Member</a>
			</nav>
		</div>
		
		<div id="container">
			
			<div id="form-input">
				<form action="tambah-kategori.php" method="post" enctype="multipart/form-data">
				<table>
					<tr>
						<td>
							<ul>
								<li>
									<label for="kodekategori">Kode Kategori</label>
									<input type="text" name="kodekategori" id="kodekategori"/>
								</li>
								<li>
									<label for="namakategori">Nama Kategori</label>
									<input type="text" name="namakategori" id="namakategori"/>
								</li>
								
							</ul>
						</td>
						<td>
							<ul>
								<li class="tombol">
									<input type="button" name="tambah" id="tambah" value="tambah" onclick="disableElement()" />
									<input type="button" name="edit" id="edit" value="edit" onclick="disableElement()"/>
									<input type="button" name="hapus" id="hapus" value="hapus" onclick="disableElement()"/>
									<input type="submit" name="<submit></submit>" id="submit" value="simpan" onclick="enableElement()" disabled />
									<input type="reset" name="reset" id="reset" value="batal" onclick="enableElement" disabled />
								</li>
							</ul>
						</td>
					</tr>
				</table>	
				</form>
				<hr/>
				<div id="search">
					<form action="cari.php" method="post">
						<label for="">Kata kunci</label>
						<input type="text" name="cari" id="cari"/>
						<label for="">Jenis pencarian</label>
						<select name="jenis" id="jenis">
							<option value="kodebarang">Kode barang</option>
							<option value="namabarang">Nama barang</option>
							<option value="kategori">Kategori</option>
							<option value="harga">Harga</option>
							<option value="stok">Stok</option>
							<option value="satuan">Satuan</option>
						</select>
						<input type="submit" value="cari" />
					</form>
				</div>
			
			</div>
			<div id="tabeldata">
				<table>
			<tr>
				<td>No.</td>
				<td>KODE KATEGORI</td>
				<td>NAMA KATEGORI</td>
				<td>AKSI</td>
			</tr>
							
				<?
				$i = 1;
				$sql = mysql_query ("select * from kategori");
								
				while ($data = mysql_fetch_array($sql)){
					echo "
						<tr>
						<td>$i</td>
						<td>$data[kode_kategori]</td>
						<td>$data[nama_kategori]</td>
						<td><a href=lihat.php?kode=$data[kode_barang]>lihat</a></td>
						</tr>";
						$i++;
					}
				?>
		</table>
			</div>
		</div>
	</body>
</html>
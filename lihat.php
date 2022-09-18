
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
			
			<?
				$kodebarang = $_GET['kode'];
				$sql = mysql_query ("select kode_barang, nama_barang, tb.kode_supplier, nama_supplier, harga, stok, tb.kode_kategori, nama_kategori, tb.kode_satuan, nama_satuan, status, tanggalekspayer, name from barang tb left join supplier ts on tb.kode_supplier = ts.kode_supplier left join kategori tk on tb.kode_kategori = tk.kode_kategori left join satuan sa on tb.kode_satuan = sa.kode_satuan where kode_barang = '$kodebarang'");
				$datasql = mysql_fetch_array($sql);
				$objsql = mysql_fetch_object($sql);
				
				
			?>
			
			<div id="form-input">
				<form action="tambah-barang.php" method="post" enctype="multipart/form-data" name="forminput">
				<table>
					<tr>
						<td>
							<ul>
								<li>
									<label for="kodebarang">Kode Barang</label>
									<input type="text" name="kodebarang" id="kodebarang" value="<? echo substr("$datasql[kode_barang]",7); ?>"/>
								</li>
								<li>
									<label for="namabarang">Nama Barang</label>
									<input type="text" name="namabarang" id="namabarang" value="<? echo "$datasql[nama_barang]"; ?>"/>
								</li>
								<li>
									<label for="supplier">Supplier</label>
									<select name="supplier" id="supplier">
										<option value="<? echo "$datasql[kode_supplier]"; ?>"><? echo "$datasql[nama_supplier]"; ?></option>
										<option value="0">
											<?
												$query = mysql_query("select * from supplier");
												while($data = mysql_fetch_array($query)){
													echo "<option value = $data[kode_supplier]>$data[nama_supplier]";
												}
											?>
										</option>
									</select>
								</li>
								<li>
									<label for="harga">Harga</label>
									<input type="text" name="harga" id="harga" value="<? echo "$datasql[harga]"; ?>"/>
								</li>
								<li>
									<label for="stok">Stok</label> 
									<input type="text" name="stok" id="stok" value="<? echo "$datasql[stok]"; ?>"/>
								</li>
								<li>
									<label for="kategori">Kategori</label>
									<select name="kategori" id="kategori">
										<option value="<? echo "$datasql[kode_kategori]";?>"><? echo "$datasql[nama_kategori]"; ?></option>
										<option value="0">
											<?
												$query = mysql_query("select * from kategori");
												while($data = mysql_fetch_array($query)){
													echo "<option value = $data[kode_kategori]>$data[nama_kategori]";
												}
											?>
										</option>
									</select>
								</li>
							</ul>
						</td>
						<td>
							<ul>
								<li>
									<label for="satuan">Satuan</label>
									<select name="satuan" id="satuan">
										<option value="<? echo "$datasql[kode_satuan]"; ?>"><? echo "$datasql[nama_satuan]"; ?></option>
										<option value="0">
											<?
												$query = mysql_query("select * from satuan");
												while($data = mysql_fetch_array($query)){
													echo "<option value = $data[kode_satuan]>$data[nama_satuan]";
												}
											?>
										</option>
									</select>
								</li>
								<li>
									<label for="status">Status</label>
									<select name="status" id="status" value="<? echo "$data[status]"; ?>">
										<option value="0"></option>
										<option value="baru">Baru</option>
										<option value="hot">Hot</option>
									</select>
								</li>
								<li>
									<label for="expayer">Tanggal Expayer</label>
									<select name="tanggal" id="tanggal">
										<option value="0">
										<?
											for($i=1;$i<=31;$i++)
											echo "<option value = $i>$i";
										?>
										</option>
									</select>
									<select name="bulan" id="bulan">
										<option value="0"></option>
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
									<label for="cover">Cover</label>
									<input type="file" name="F1"/>
									<img width='40px' height='70px' src="img/produk/<? echo "$datasql[name]"; ?>" alt="" />
								</li>
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
					<form action="" method="post">
						<label for="">Kata kunci</label>
						<input type="text" name="cari" id="cari"/>
						<label for="">Jenis pencarian</label>
						<select name="" id="">
							<option value="">Kode barang</option>
							<option value="">Nama barang</option>
							<option value="">Kategori</option>
							<option value="">Harga</option>
							<option value="">Stok</option>
							<option value="">Satuan</option>
						</select>
						<input type="submit" value="cari" />
					</form>
				</div>
			
			</div>
			<div id="tabeldata">
				<table>
			<tr>
				<td>No.</td>
				<td>KODE BARANG</td>
				<td>NAMA BARANG</td>
				<td>HARGA</td>
				<td>KATEGORI</td>
				<td>STOK</td>
				<td>SATUAN</td>
				<td>AKSI</td>
			</tr>
							
				<?
				$i = 1;
				$sql = mysql_query ("select kode_barang, nama_barang, harga, nama_kategori, stok, nama_satuan from barang tb left join kategori tk on tb.kode_kategori = tk.kode_kategori left join satuan ts on tb.kode_satuan = ts.kode_satuan");
								
				while ($data = mysql_fetch_array($sql)){
					echo "
						<tr>
						<td>$i</td>
						<td>$data[kode_barang]</td>
						<td>$data[nama_barang]</td>
						<td>$data[harga]</td>
						<td>$data[nama_kategori]</td>
						<td>$data[stok]</td>
						<td>$data[nama_satuan]</td>
						<td><a href=?kode=$data[kode_barang]>lihat</a></td>
						</tr>";
						$i++;
					}
				?>
		</table>
			</div>
		</div>
	</body>
</html>
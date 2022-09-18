
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
						$server = mysql_connect ("localhost","root","root");
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
				<a href="?admin=barang">Barang</a>
				<a href="?admin=kategori">Kategori</a>
				<a href="?admin=supplier">Supplier</a>
				<a href="?admin=merek">Merek</a>
				<a href="?admin=satuan">Satuan</a>
				<a href="?admin=member">Member</a>
			</nav>
		</div>
		
		<div id="container">
			
			<div id="form-input">
				
				<?
					$admin = $_GET['admin'];
					$page = "admin-barang.php";
					
					if($admin == "barang"){
					?>
							<form action="tambah.php?menu=barang" method="post" enctype="multipart/form-data">
							<table>
								<tr>
									<?
									if(isset($_GET['kode'])){
										
										$kodebarang = $_GET['kode'];
										$sql = mysql_query ("select kode_barang, nama_barang, tb.kode_supplier, nama_supplier, harga, stok, tb.kode_kategori, nama_kategori, tb.kode_satuan, nama_satuan, status, tanggalekspayer, name from barang tb left join supplier ts on tb.kode_supplier = ts.kode_supplier left join kategori tk on tb.kode_kategori = tk.kode_kategori left join satuan sa on tb.kode_satuan = sa.kode_satuan where kode_barang = '$kodebarang'");
										$datasql = mysql_fetch_array($sql);
										$objsql = mysql_fetch_object($sql);
									?>
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
												<select name="status" id="status" value="">
													<option value="<? echo "$datasql[status]"; ?>"><? echo "$datasql[status]"; ?></option>
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
									<?
									}else{
									?>
									<td>
										<ul>
											<li>
												<label for="kodebarang">Kode Barang</label>
												<input type="text" name="kodebarang" id="kodebarang"/>
											</li>
											<li>
												<label for="namabarang">Nama Barang</label>
												<input type="text" name="namabarang" id="namabarang"/>
											</li>
											<li>
												<label for="supplier">Supplier</label>
												<select name="supplier" id="supplier">
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
												<input type="text" name="harga" id="harga"/>
											</li>
											<li>
												<label for="stok">Stok</label>
												<input type="text" name="stok" id="stok"/>
											</li>
											<li>
												<label for="kategori">Kategori</label>
												<select name="kategori" id="kategori">
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
													<select name="status" id="status">
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
										<?
										}
										?>
								</tr>
							</table>	
						</form>
						<hr/>
						<div id="search">
							<form action="<?echo "$page?admin=barang";?>" method="post">
								<label for="kata">Kata kunci</label>
								<input type="text" name="cari" id="cari"/>
								<label for="jenis">Jenis pencarian</label>
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
					<?	
					}else if($admin == "kategori"){
					?>
						<form action="tambah.php?menu=kategori" method="post" enctype="multipart/form-data">
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
										kat
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
						<hr />
						<div id="search">
							<form action="admin-barang.php?admin=kategori" method="post">
								<label for="kata">Kata kunci</label>
								<input type="text" name="cari" id="cari"/>
								<label for="jenis">Jenis pencarian</label>
								<select name="jenis" id="jenis">
									<option value="kodekategori">Kode kategori</option>
									<option value="namakategori">Nama kategori</option>
								</select>
								<input type="submit" value="cari" />
							</form>
						</div>
					<?
					}else if($admin == "supplier"){
					?>
						<form action="tambah.php?menu=supplier" method="post" enctype="multipart/form-data">
						<table>
							<tr>
								<td>
									<ul>
										<li>
											<label for="kodesupplier">Kode Supplier</label>
											<input type="text" name="kodesupplier" id="kodesupplier"/>
										</li>
										<li>
											<label for="namasupplier">Nama Supplier</label>
											<input type="text" name="namasupplier" id="namasupplier"/>
										</li>
									</ul>
								</td>
								<td>
									<ul>
										<li>
											<label for="alamat">Alamat</label>
											<textarea name="alamat" id="alamat" cols="30" rows="1"></textarea>
										</li>
										<li>
											<label for="kota">Kota</label>
											<input type="text" name="" id="kota"/>
										</li>
										<li>
											<label for="telepon">Nomor Telepon</label>
											<input type="text" name="telepon" id="telepon"/>
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
						<hr />
						<div id="search">
							<form action="admin-barang.php?admin=supplier" method="post">
								<label for="kata">Kata kunci</label>
								<input type="text" name="cari" id="cari"/>
								<label for="cari">Jenis pencarian</label>
								<select name="jenis" id="jenis">
									<option value="kodesupplier">Kode supplier</option>
									<option value="namasupplier">Nama supplier</option>
								</select>
								<input type="submit" value="cari" />
							</form>
						</div>
					<?
					}else if($admin == "merek"){
					?>
						<form action="tambah.php?menu=merek" method="post" enctype="multipart/form-data">
						<table>
							<tr>
								<td>
									<ul>
										<li>
											<label for="kodemerek">Kode Merek</label>
											<input type="text" name="kodemerek" id="kodemerek"/>
										</li>
										<li>
											<label for="namamerek">Nama Merek</label>
											<input type="text" name="namamerek" id="namamerek"/>
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
						<hr />
						<div id="search">
							<form action="admin-member.php?admin=merek" method="post">
								<label for="kata">Kata kunci</label>
								<input type="text" name="cari" id="cari"/>
								<label for="jenis">Jenis pencarian</label>
								<select name="jenis" id="jenis">
									<option value="kodemerek">Kode Merek</option>
									<option value="namamerek">Nama Merek</option>
								</select>
								<input type="submit" value="cari" />
							</form>
						</div>
					<?
					}if ($admin == "satuan"){
					?>
						<form action="tambah.php?menu=satuan" method="post" enctype="multipart/form-data">
						<table>
							<tr>
								<td>
									<ul>
										<li>
											<label for="kodesatuan">Kode Satuan</label>
											<input type="text" name="kodesatuan" id="kodesatuan"/>
										</li>
										<li>
											<label for="namasatuan">Nama Satuan</label>
											<input type="text" name="namasatuan" id="namasatuan"/>
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
						<hr />
						<div id="search">
							<form action="admin-barang.php?admin=satuan" method="post">
								<label for="kata">Kata kunci</label>
								<input type="text" name="cari" id="cari"/>
								<label for="jenis">Jenis pencarian</label>
								<select name="jenis" id="jenis">
									<option value="kodesatuan">Kode Satuan</option>
									<option value="namasatuan">Nama Satuan</option>
								</select>
								<input type="submit" value="cari" />
							</form>
						</div>
					<?
					}else if($admin == "member"){
					?>
						<form action="tambah.php?menu=member" method="post" enctype="multipart/form-data">
						<table>
							<tr>
								<td>
									<ul>
										<li>
											<label for="username">Username</label>
											<input type="text" name="username" id="username"/>
										</li>
										<li>
											<label for="namaawal">Nama Awal</label>
											<input type="text" name="namaawal" id="namaawal"/>
										</li>
										<li>
											<label for="namaakhir">Nama Akhir</label>
											<input type="text" name="namaakhir" id="namaakhir"/>
										</li>
									</ul>
								</td>
								<td>
									<ul>
										<li>
											<label for="password">Password</label>
											<input type="text" name="password" id="password"/>
										</li>
										<li>
											<label for="email">Email</label>
											<input type="text" name="email" id="email"/>
										</li>
										<li>
											<label for="tanggallahir">Tanggal Lahir</label>
											<select name="tanggal" id="tanggal">
												<option value="tanggal">
													<?
														for($i=1;$i<=31;$i++)
														echo "<option value=$i>$i";
													?>
												</option>
											</select>
											<select name="bulan" id="bulan">
												<option value="Januari">Januari</option>
												<option value="Februari">Februari</option>
												<option value="Maret">Maret</option>
												<option value="April">April</option>
												<option value="Mei">Mei</option>
												<option value="Juni">Juni</option>
												<option value="Juli">Juli</option>
												<option value="Agustus">Agustus</option>
												<option value="September">September</option>
												<option value="Oktober">Oktober</option>
												<option value="November">November</option>
												<option value="Desember">Desember</option>
											</select>
											<select name="tahun" id="tahun">
												<option value="0">
													<?
														$now = (integer) date("Y");
														
														for($i=$now;$i>($now-120);$i--);
														echo "<option value=$i>$i";
													?>
												</option>
											</select>
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
						<hr />
						<div id="search">
							<form action="admin-barang.php?admin=member" method="post">
								<label for="kata">Kata kunci</label>
								<input type="text" name="cari" id="cari"/>
								<label for="jenis">Jenis pencarian</label>
								<select name="jenis" id="jenis">
									<option value="0"></option>
									<option value="username">Username</option>
									<option value="namaawal">Nama awal</option>
									<option value="namaakhir">Nama akhir</option>
									<option value="password">password</option>
									<option value="email">email</option>
								</select>
								<input type="submit" value="cari" />
							</form>
						</div>
					<?
					}
					?>
			</div>
			
			
			<div id="tabeldata">
				<?
				if($admin == barang){
				?>
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
					if(!empty($_POST['cari']) && !empty($_POST['jenis'])){
						$cari = $_POST['cari'];
						$jenis = $_POST['jenis'];
						
						if($jenis == "kodebarang"){
							$sql = mysql_query ("select kode_barang, nama_barang, harga, nama_kategori, stok, nama_satuan from barang tb left join kategori tk on tb.kode_kategori = tk.kode_kategori left join satuan ts on tb.kode_satuan = ts.kode_satuan where kode_barang LIKE '%$cari%'");
						}else if($jenis == "namabarang"){
							$sql = mysql_query ("select kode_barang, nama_barang, harga, nama_kategori, stok, nama_satuan from barang tb left join kategori tk on tb.kode_kategori = tk.kode_kategori left join satuan ts on tb.kode_satuan = ts.kode_satuan where nama_barang LIKE '%$cari%'");
						}else if($jenis == "kategori"){
							$sql = mysql_query ("select kode_barang, nama_barang, harga, nama_kategori, stok, nama_satuan from barang tb left join kategori tk on tb.kode_kategori = tk.kode_kategori left join satuan ts on tb.kode_satuan = ts.kode_satuan where nama_kategori LIKE '%$cari%'");
						}else if($jenis == "harga"){
							$sql = mysql_query ("select kode_barang, nama_barang, harga, nama_kategori, stok, nama_satuan from barang tb left join kategori tk on tb.kode_kategori = tk.kode_kategori left join satuan ts on tb.kode_satuan = ts.kode_satuan where harga LIKE '%$cari%'");
						}else if($jenis == "stok"){
							$sql = mysql_query ("select kode_barang, nama_barang, harga, nama_kategori, stok, nama_satuan from barang tb left join kategori tk on tb.kode_kategori = tk.kode_kategori left join satuan ts on tb.kode_satuan = ts.kode_satuan where stok LIKE '%$cari%'");
						}else{
							$sql = mysql_query ("select kode_barang, nama_barang, harga, nama_kategori, stok, nama_satuan from barang tb left join kategori tk on tb.kode_kategori = tk.kode_kategori left join satuan ts on tb.kode_satuan = ts.kode_satuan where satuan LIKE '%$cari%'");
						}
						
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
							<td><a href=?admin=barang&kode=$data[kode_barang]>lihat</a></td>
							</tr>";
							$i++;
						}
					}else{
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
							<td><a href=?admin=barang&kode=$data[kode_barang]>lihat</a></td>
							</tr>";
							$i++;
						}
					}
					?>
				</table>
				<?
				}else if($admin == "kategori"){
				?>
					<table>
					<tr>
						<td>No.</td>
						<td>KODE KATEGORI</td>
						<td>NAMA KATEGORI</td>
						<td>AKSI</td>
					</tr>
									
						<?
						$i = 1;
						
						if(!empty($_POST['cari']) && !empty($_POST['jenis'])){
							$cari = $_POST['cari'];
							$jenis = $_POST['jenis'];
							
							if($jenis == "kodekategori"){
								$sql = mysql_query ("select * from kategori where kode_kategori like '%$cari%'");
							}else{
								$sql = mysql_query ("select * from kategori where nama_kategori like '%$cari%'");
							}
							while ($data = mysql_fetch_array($sql)){
							echo "
								<tr>
								<td>$i</td>
								<td>$data[kode_kategori]</td>
								<td>$data[nama_kategori]</td>
								<td><a href=lihat.php?kode=$data[kode_kategori]>lihat</a></td>
								</tr>";
								$i++;
							}
						}else{
							$sql = mysql_query ("select * from kategori");
							
							while ($data = mysql_fetch_array($sql)){
							echo "
								<tr>
								<td>$i</td>
								<td>$data[kode_kategori]</td>
								<td>$data[nama_kategori]</td>
								<td><a href=lihat.php?kode=$data[kode_kategori]>lihat</a></td>
								</tr>";
								$i++;
							}
						}
						
						?>
					</table>
				<?
				}else if($admin == "supplier"){
				?>
					<table>
					<tr>
						<td>No.</td>
						<td>KODE SUPPLIER</td>
						<td>NAMA SUPPLIER</td>
						<td>ALAMAT</td>
						<td>KOTA</td>
						<td>TELEPON</td>
						<td>AKSI</td>
					</tr>
									
						<?
						$i = 1;
						
						if(!empty($_POST['cari']) && !empty($_POST['jenis'])){
							$cari = $_POST['cari'];
							$jenis = $_POST['jenis'];
							
							if($jenis == "kodesupplier"){
								$sql = mysql_query ("select * from supplier where kode_supplier like '%$cari%'");
							}else if($jenis == "namasupplier"){
								$sql = mysql_query ("select * from supplier where nama_supplier like '%$cari%'");
							}
							
							while ($data = mysql_fetch_array($sql)){
							echo "
								<tr>
								<td>$i</td>
								<td>$data[kode_supplier]</td>
								<td>$data[nama_supplier]</td>
								<td>$data[alamat]</td>
								<td>$data[kota]</td>
								<td>$data[telepon]</td>
								<td><a href=lihat.php?kode=$data[kode_supplier]>lihat</a></td>
								</tr>";
								$i++;
							}
						}else{
							$sql = mysql_query ("select * from supplier");
										
							while ($data = mysql_fetch_array($sql)){
							echo "
								<tr>
								<td>$i</td>
								<td>$data[kode_supplier]</td>
								<td>$data[nama_supplier]</td>
								<td>$data[alamat]</td>
								<td>$data[kota]</td>
								<td>$data[telepon]</td>
								<td><a href=lihat.php?kode=$data[kode_supplier]>lihat</a></td>
								</tr>";
								$i++;
							}
						}
						?>
					</table>
				<?
				}else if($admin == "merek"){
				?>
					<table>
					<tr>
						<td>No.</td>
						<td>KODE MEREK</td>
						<td>NAMA MEREK</td>
						<td>AKSI</td>
					</tr>
									
						<?
						$i = 1;
						
						if(!empty($_POST['cari']) && !empty($_POST['jenis'])){
							$cari = $_POST['cari'];
							$jenis = $_POST['jenis'];
							
							if($jenis == "kodemerek"){
								$sql = mysql_query ("select * from merek where kode_merek like '%$cari%'");
							}else{
								$sql = mysql_query ("select * from merek where nama_merek like '%$cari%'");
							}
							while ($data = mysql_fetch_array($sql)){
							echo "
								<tr>
								<td>$i</td>
								<td>$data[kode_merek]</td>
								<td>$data[nama_merek]</td>
								<td><a href=lihat.php?kode=$data[kode_merek]>lihat</a></td>
								</tr>";
								$i++;
							}
						}else{
							$sql = mysql_query ("select * from merek");
										
							while ($data = mysql_fetch_array($sql)){
							echo "
								<tr>
								<td>$i</td>
								<td>$data[kode_merek]</td>
								<td>$data[nama_merek]</td>
								<td><a href=lihat.php?kode=$data[kode_merek]>lihat</a></td>
								</tr>";
								$i++;
							}
						}
						?>
					</table>
				<?
				}else if($admin == "satuan"){
				?>
					<table>
					<tr>
						<td>No.</td>
						<td>KODE SATUAN</td>
						<td>NAMA SATUAN</td>
						<td>AKSI</td>
					</tr>
									
						<?
						$i = 1;
						
						if(!empty($_POST['cari']) && !empty($_POST['jenis'])){
							$cari = $_POST['cari'];
							$jenis = $_POST['jenis'];
							
							if($jenis == "kodesatuan"){
								$sql = mysql_query ("select * from satuan where kode_satuan like '%$cari%'");
							}else{
								$sql = mysql_query ("select * from satuan where nama_satuan like '%$cari%'");
							}
							while ($data = mysql_fetch_array($sql)){
							echo "
								<tr>
								<td>$i</td>
								<td>$data[kode_satuan]</td>
								<td>$data[nama_satuan]</td>
								<td><a href=lihat.php?kode=$data[kode_satuan]>lihat</a></td>
								</tr>";
								$i++;
							}
						}else{
							$sql = mysql_query ("select * from merek");
										
							while ($data = mysql_fetch_array($sql)){
							echo "
								<tr>
								<td>$i</td>
								<td>$data[kode_satuan]</td>
								<td>$data[nama_satuan]</td>
								<td><a href=lihat.php?kode=$data[kode_satuan]>lihat</a></td>
								</tr>";
								$i++;
							}
						}
						?>
					</table>
				<?
				}else{
				?>
					<table>
					<tr>
						<td>No.</td>
						<td>USERNAME</td>
						<td>NAMA AWAL</td>
						<td>NAMA AKHIR</td>
						<td>PASSWORD</td>
						<td>EMAIL</td>
						<td>TANGGAL LAHIR</td>
						<td>AKSI</td>
					</tr>
									
						<?
						$i = 1;
						
						if(!empty($_POST['cari']) && !empty($_POST['jenis'])){
							$cari = $_POST['cari'];
							$jenis = $_POST['jenis'];
							
							if($jenis == "username"){
								$sql = mysql_query ("select * from member where username like '%$cari%'");
							}else if($jenis == "namaawal"){
								$sql = mysql_query ("select * from member where namaawal like '%$cari%'");
							}else if($jenis == "namaakhir"){
								$sql = mysql_query ("select * from member where namaakhir like '%$cari%'");
							}else if($jenis == "password"){
								$sql = mysql_query ("select * from member where password like '%$cari%'");
							}else if($jenis == "email"){
								$sql = mysql_query ("select * from member where email like '%$cari%'");
							}
							
							while ($data = mysql_fetch_array($sql)){
							echo "
								<tr>
								<td>$i</td>
								<td>$data[username]</td>
								<td>$data[namaawal]</td>
								<td>$data[namaakhir]</td>
								<td>$data[password]</td>
								<td>$data[email]</td>
								<td>$data[tanggallahir]</td>
								<td><a href=lihat.php?kode=$data[username]>lihat</a></td>
								</tr>";
								$i++;
							}
						}else{
							$sql = mysql_query ("select * from member");
							while ($data = mysql_fetch_array($sql)){
							echo "
								<tr>
								<td>$i</td>
								<td>$data[username]</td>
								<td>$data[namaawal]</td>
								<td>$data[namaakhir]</td>
								<td>$data[password]</td>
								<td>$data[email]</td>
								<td>$data[tanggallahir]</td>
								<td><a href=lihat.php?kode=$data[username]>lihat</a></td>
								</tr>";
								$i++;
							}
						}
						?>
					</table>
				<?
				}
				?>
			</div>
			
		</div>
	</body>
</html>
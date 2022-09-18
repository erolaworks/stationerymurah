<?
	include "koneksi.php";
	
	$menu = $_GET['menu'];
	
	if($menu == "barang"){
		$kodebarang = $_POST['kodebarang'];
		$namabarang = $_POST['namabarang'];
		$harga = $_POST['harga'];
		$stok = $_POST['stok'];
		$kategori =  $_POST['kategori'];
		$satuan = $_POST['satuan'];
		$supplier = $_POST['supplier'];
		$tanggal = $_POST['tanggal'];
		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];
		$status = $_POST['status'];
		$F1 = $_FILES['F1']['tmp_name'];
		$F1_name = $_FILES['F1']['name'];
		$F1_type = $_FILES['F1']['type'];
		$F1_size = $_FILES['F1']['size'];

		$query = mysql_query ("select * from barang where kode_barang = '$kategori$kodebarang'");
		$cekquery = mysql_num_rows($query);
		
		if(empty($kodebarang)){
			echo "Kode barang tidak boleh kosong";
		}else if(empty($namabarang)){
			echo "judul barang tidak boleh kosong";
		}else if(empty($kategori)){
			echo "kategori tidak boleh kosong";
		}else if($cekquery>0){
			echo "data sudah pernah dimasukkan! Silahkan masukkan data lain";
		}else{
			$simpandata = mysql_query("insert into barang (kode_barang,nama_barang,harga,stok,kode_kategori,kode_satuan,type,size,status,kode_supplier,tanggalekspayer,name) values ('$kategori$kodebarang','$namabarang','$harga','$stok','$kategori','$satuan','$F1_type','$F1_size','$status','$supplier','$tanggal/$bulan/$tahun','$F1_name')");
			echo "data tersimpan";
			
			if($simpandata){
				$move = move_uploaded_file ($F1, 'img/produk/'.$F1_name);
				if($move){
					echo "gambar tersimpan <br />";
					echo "$F1_name <br />";
					echo "$F1_type <br />";
					echo "$F1_size <br />";
				}else{
					echo "gagal diupload";
				}
			}
		}
		echo "<meta http-equiv='refresh' content='2;admin-barang.php?admin=barang'/>";
	}else if($menu == "kategori"){
		$kodekategori = $_POST['kodekategori'];
		$namakategori = $_POST['namakategori'];
			
		$query = mysql_query ("select * from kategori where kode_kategori = 'KAT$kodekategori'");
		$cekquery = mysql_num_rows($query);
		
		if(empty($kodekategori)){
			echo "kode kategori tidak boleh kosong";
		}else if(empty($namakategori)){
			echo "nama kategori tidak boleh kosong";
		}else if($cekquery>0){
			echo "data kategori sudah pernah dimasukkan! Silahkan masukkan data lainnya.";
		}else{
			$input = mysql_query ("insert into kategori values ('KAT$kodekategori','$namakategori')");
			
			echo "data berhasil dimasukkan.";
		}
		echo "<meta http-equiv='refresh' content='2;admin-barang.php?admin=kategori'/>";
	}else if($menu == "supplier"){
		$kodesupplier = $_POST['kodesupplier'];
		$namasupplier = $_POST['namasupplier'];
		$alamat = $_POST['alamat'];
		$kota = $_POST['kota'];
		$telepon = $_POST['telepon'];
		
		$query = mysql_query ("select * from supplier where kode_supplier = '$kodesupplier'");
		$cekquery = mysql_num_rows($query);
		
		if(empty($kodesupplier)){
			echo "kode supplier tidak boleh kosong";
		}else if(empty($namasupplier)){
			echo "nama supplier tidak boleh kosong";
		}else if($cekquery>0){
			echo "data sudah pernah dimasukkan! Silahkan masukkan data lain.";
		}else{
			$input = mysql_query("insert into supplier (kode_supplier,nama_supplier,alamat,kota,telepon) values ('$kodesupplier','$namasupplier','$alamat','$kota','$telepon')");
			
			echo "data berhasil dimasukkan";
		}
		echo "<meta http-equiv='refresh' content='2;admin-barang.php?admin=supplier'/>";
	}else if($menu == "merek"){
		$kodemerek = $_POST['kodemerek'];
		$namamerek = $_POST['namamerek'];
		
		$query = mysql_query("select * from merek where kode_merek = '$kodemerek'");
		$cekquery = mysql_num_rows($query);
		
		if(empty($kodemerek)){
			echo "kode merek tidak boleh kosong";
		}else if(empty($namamerek)){
			echo "nama merek tidak boleh kosong";
		}else if($cekquery>0){
			echo "data sudah pernah dimasukkan! Silahkan masukkan data lainnya.";
		}else{
			$input = mysql_query("insert into merek values ('$kodemerek','$namamerek')");
			
			echo "data sudah dimasukkan";
		}
		echo "<meta http-equiv='refresh' content='2;admin-barang.php?admin=merek'/>";
	}else if($menu == "satuan"){
		$kodesatuan = $_POST['kodesatuan'];
		$namasatuan = $_POST['namasatuan'];
		
		$query = mysql_query("select * from satuan where kode_satuan = '$kodesatuan'");
		$cekquery = mysql_num_rows($cekquery);
		
		if(empty($kodesatuan)){
			echo "kode satuan tidak boleh kosong";
		}else if(empty($namasatuan)){
			echo "nama satuan tidak boleh kosong";
		}else if($cekquery>0){
			echo "data sudah pernah dimasukkan! Silahkan masukkan data lainnya.";
		}else{
			$input = mysql_query("insert into satuan values ('$kodesatuan','$namasatuan')");
			
			echo "data sudah dimasukkan";
		}
		echo "<meta http-equiv='refresh' content='2;admin-barang.php?admin=satuan'/>";
	}else{
		$username = $_POST['username'];
		$namaawal = $_POST['namaawal'];
		$namaakhir = $_POST['namaakhir'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$tanggal = $_POST['tanggal'];
		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];
		
		$query = mysql_query("select * from member where username = '$username'");
		$cekquery = mysql_num_rows($query);
		
		if(empty($username)){
			echo "username tidak boleh kosong";
		}else if(empty($password)){
			echo "password tidak boleh kosong";
		}else if(empty($namaawal)){
			echo "nama awal tidak boleh kosong";
		}else if (empty($namaakhir)){
			echo "nama akhir tidak boleh kosong";
		}else if(empty($email)){
			echo "email tidak boleh kosong";
		}else if($cekquery>0){
			echo "data sudah pernah dimasukkan! Silahkan masukkan data lainnya.";
		}else{
			$input = mysql_query("insert into member values ('$namaawal','$namaakhir','$username','$password','$email','$tanggal/$bulan/$tahun')");
			
			echo "data sudah dimasukkan.";
		}
		echo "<meta http-equiv='refresh' content='2;admin-barang.php?admin=member'/>";
	}
?>

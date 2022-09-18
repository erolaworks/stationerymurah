<?
	include "koneksi.php";
	
	$kodesupplier = $_POST['kodesupplier'];
	$namasupplier = $_POST['namasupplier'];
	$alamat = $_POST['alamat'];
	$telepon = $_POST['telepon'];
	
	$query = mysql_query ("select * from supplier where kode_supplier = '$kodesupplier'");
	$cekquery = mysql_num_rows($query);
	
	if(empty($kodesupplier)){
		echo "Kode supplier tidak boleh kosong";
	}else if(empty($namasupplier)){
		echo "Nama supplier tidak boleh kosong";
	}else if($cekquery>0){
		echo "Data sudah pernah dimasukkan! Silahkan masukkan data yang berbeda.";
	}else{
		$input = mysql_query ("insert into supplier (kode_supplier,nama_supplier,alamat,telepon) values ('$kodesupplier','$namasupplier','$alamat','$telepon')");
		
		echo "data berhasil dimasukkan";
	}
?>
<meta http-equiv="refresh" content="2;admin-supplier.php"/>


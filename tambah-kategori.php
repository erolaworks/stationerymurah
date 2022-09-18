<?
	include "koneksi.php";
	
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
?>

<meta http-equiv="refresh" content="2;admin-kategori.php"/>
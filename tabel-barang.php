<?
	include "koneksi.php";
?>

<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="style.css" media="screen" type="text/css"/>
	</head>
	<body>
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
				<td colspan="2">Aksi</td>
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
						<td><a href=#>Edit</a></td>
						<td><a href=#>Hapus</a></td>
						</tr>";
						$i++;
					}
				?>
		</table>
	</div>
	</body>
</html>


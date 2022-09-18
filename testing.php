<?
	$server = mysql_connect ("localhost","root","");
	$database = mysql_select_db ("stationerymurah");

	$halaman = $_GET['halaman'];
	$kategori = $_GET['kat'];
?>

<html>
	<body>
		<div>
		<?
			$batas = 9;
			
			if(empty($halaman)){
				$posisi = 0;
				$halaman = 1;
			}else{
				$posisi = ($halaman-1) * $batas;
			}
			
			$q = mysql_query("select * from barang where kode_kategori = 'KAT0001' limit $posisi, $batas");
		?>	
		<table>
			<tr>
			<?
			$file = "detail.php";
			
			$jml_kolom = 3;
			$cnt = 0;
			
			while($data = mysql_fetch_object($q)){
				if($cnt >= $jml_kolom){
					echo "<tr></tr>";
					$cnt = 0;
				}
				$cn++;
			?>
				<td>
					<section class="detail">
						<figure>
							<img valign='bottom' src="img/produk/<?echo $data->name;?>" alt="tes" />
						</figure>
					</section>
				</td>
			<?
			}
			?>
			</tr>
		</table>
		
		</div>
	</body>
</html>
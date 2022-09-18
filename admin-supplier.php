<!doctype html>
<html>
	<head>
		<title></title>
		<meta />
		<link rel="stylesheet" href="" />
	</head>
	<body>
		<form action="tambah-supplier.php" method="post">
		<ul>
			<li>
				<label for="kodesupplier">Kode Supplier</label>
				<input type="text" name="kodesupplier" id="kodesupplier"/>
			</li>
			<li>
				<label for="namasupplier">Nama Supplier</label>
				<input type="text" name="namasupplier" id="namasupplier"/>
			</li>
			<li>
				<label for="alamat">Alamat</label>
				<textarea name="alamat" id="alamat" cols="30" rows="10"></textarea>
			</li>
			<li>
				<label for="telepon">Telepon</label>
				<input type="text" name="telepon" id="telepon"/>
			</li>
			<li>
				<input type="submit" name="oke" id="oke" value="oke"/>
				<input type="reset" name="oke" id="oke" value="cancel"/>
			</li>
		</ul>
		</form>
	</body>
</html>
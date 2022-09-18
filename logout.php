<?php 
	
	session_start();
	
	include "koneksi.php"; 
	
	if(isset($_SESSION['username'])){
		unset($_SESSION['username']);
	}	
?> 

<meta http-equiv="refresh" content="0;index.php">  
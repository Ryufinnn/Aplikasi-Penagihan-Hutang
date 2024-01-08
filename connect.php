<?php

$server="localhost";
$username="root";
$pw="";
$db="db_hutangpiutang";
$connect=mysql_connect($server,$username,$pw);

	if($connect) {
		mysql_select_db($db) or die("Database tidak ditemukan");
		echo "<b> </b>";
	}else {
		echo "<b> Koneksi Gagal </b>";
	}

?>
<?php

$page=isset($_GET['p']) ? $_GET['p'] : 'home';
if($page=='home'){
	include 'home.php';
}elseif ($page=='hutangpelanggan') {
	include 'hutangpelanggan.php';
}elseif ($page=='hutangtoko') {
	include 'hutangtoko.php';
}elseif ($page=='detailpelanggan') {
	include 'detailpelanggan.php';
}elseif ($page=='detailtoko') {
	include 'detailtoko.php';
}

?>
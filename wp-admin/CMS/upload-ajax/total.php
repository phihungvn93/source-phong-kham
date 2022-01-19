<?php
	require_once "../checklogin.php";
	require_once "../class_db.php";
	$db = new db;
	$total = 0;
	$id_dathen = $_GET['id_dathen'];
	$sql = "select id from file where ID_DatHen = {$id_dathen}";
	$kq = mysql_query($sql);
	$total = mysql_num_rows($kq);
	echo $total;
?>
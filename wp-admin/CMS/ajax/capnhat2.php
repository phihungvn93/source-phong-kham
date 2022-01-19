<?php 
	require_once "../class_quantri.php";
	$qt = new quantri;
	$str = $_GET['str'];
	$id = $_GET['id'];
	mysql_query("UPDATE dathen set ChienDich = '{$str}' where ID_DatHen = {$id}");
?>
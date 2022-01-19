<?php
	require_once "class_quantri.php";
	$qt = new quantri;
	
	$sql = $_GET['sql'];
	mysql_query($sql);	
?>
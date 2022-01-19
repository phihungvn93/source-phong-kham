<?php
	require_once "class_quantri.php";
	$qt = new quantri;
	$bang= "quangcao";
	$ttu=$_GET['ttu'];
	$id=$_GET['id'];

	settype($id,"int");
	settype($ttu,"int");

	$qt->SuaThuTu($bang, 'idSlider', $id,$ttu);
?>
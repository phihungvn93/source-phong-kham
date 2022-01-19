<?php
	require_once "checklogin.php";
	require_once "class_quantri.php";
	$qt = new quantri;
	$idTL=$_GET['idTL'];
	settype($idTL,"int");
	if ($idTL<=0) die ("Không biết danh muc cần xóa");
	$qt->XoaTraLoi($idTL);

	header("location:main.php?p=cauhoi_xem");
?>

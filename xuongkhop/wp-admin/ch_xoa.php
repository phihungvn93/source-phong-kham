<?
	require_once "checklogin.php";
	require_once "class_quantri.php";
	$qt = new quantri;
	$idDH=$_GET['idCH']; 
	settype($idDH,"int");
	if ($idDH<=0) die ("Không biết danh muc cần xóa");
	$qt->XoaCauHoi($idDH);
	
	header("location:main.php?p=ch_xem");
?>

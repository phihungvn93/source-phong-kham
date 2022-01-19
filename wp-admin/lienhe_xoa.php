<?
	require_once "checklogin.php";
	require_once "class_quantri.php";
	$qt = new quantri;
	$idDH=$_GET['idLH']; 
	settype($idDH,"int");
	if ($idDH<=0) die ("Không biết danh muc cần xóa");
	$qt->XoaDangKy($idDH);
	
	header("location:main.php?p=lienhe_xem");
?>

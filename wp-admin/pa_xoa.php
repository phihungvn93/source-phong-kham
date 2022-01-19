<?
	require_once "checklogin.php";
	require_once "class_quantri.php";
	$qt = new quantri;
	$idSP=$_GET['id'];

	settype($idSP,"int");
	if ($idSP<=0) die ("Không biết loại sản phẩm cần xóa");
	$qt->XoaPA($idSP);
	header("location:main.php?p=pa_xem");
?>
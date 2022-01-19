<?php
	session_start();
	require_once "checklogin.php";
	if($_SESSION['quyen']['col_xoa']==0) header("location:main.php?p=dh_xem");
	require_once "class_quantri.php";
	$qt = new quantri;
	$id=$_GET['id'];

	settype($id,"int");
	if ($id<=0) die ("Không biết dh cần xóa");
	$qt->XoaDH($id);
	header("location:main.php?p=dh_xem");
?>
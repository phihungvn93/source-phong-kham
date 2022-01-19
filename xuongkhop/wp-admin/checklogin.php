<?php
	session_start();
	if (isset($_SESSION['tg_login_id'])== false){
		$_SESSION['error']='Ban chua dang nhap';
		$_SESSION['back']=$_SERVER['REQUEST_URI'];
		header('location:login.php'); 
		exit();
	}
	else if ($_SESSION['tg_login_level']<0){
		$_SESSION['error']='Bạn không có quyền truy cập vào trang này';
		$_SESSION['back']=$_SERVER['REQUEST_URI'];
		header('location:login.php');
		exit();
	}
?>

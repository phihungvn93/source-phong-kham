<?php
	require_once "checklogin.php";
	session_start();
	$id = $_SESSION['kt_login_id'];
	settype($id, "int");
	$Pass = $_GET['Pass'];
	$Pass = md5($Pass);
	require_once("dbcon.php");
	$sql = "SELECT * FROM users WHERE idUser='$id' AND Pass ='$Pass'";
	$user = mysql_query($sql);
	if (mysql_num_rows($user) != 1)
		echo "Mật khẩu nhập không đúng !!!";
?>

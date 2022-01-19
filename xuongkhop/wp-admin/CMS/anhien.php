<?php
	session_start();
	require_once "class_quantri.php";
	$qt = new quantri;
	$bang=$_GET['bang'];
	$cot=$_GET['cot'];
	$ma=$_GET['ma'];
	$id=$_GET['id'];

	settype($id,"int");
	$val = $qt->LayDaDen($bang,$cot, $ma, $id);
	if ($val == 0)	
		$val = 1;
	else{
		if($_SESSION['quyen']['tick_den'] == 1){
			$val = 0;
		}
	}
	$qt->DoiDaDen($bang,$cot, $ma, $id,$val);
	$date = gmdate("Y-m-d H:i:s",time()+7*3600);
	$kq = mysql_query("UPDATE dathen set NgayGioDenKham = '{$date}' where {$ma} = {$id} and NgayGioDenKham = '1970-01-01 00:00:00'");
	echo $val;
?>
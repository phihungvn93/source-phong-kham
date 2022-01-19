<?php 
	session_start();
	require_once "../class_quantri.php";
	$qt = new quantri;
	$str = $_GET['str'];
	$id = $_GET['id'];
	
	$dh = $qt->ChiTietDH($id);
	$row = mysql_fetch_assoc($dh);
	$BenhThucTe = $row['BenhThucTe'];
	if($row['BenhThucTe'] != $str) {
		$update = " {Nguồn ".$row['BenhThucTe']." &rarr; ".$str."} ";
		mysql_query("UPDATE dathen set BenhThucTe = '{$str}' where ID_DatHen = {$id}");
		if(mysql_affected_rows()>0){
				$now = gmdate("H:i:s",time()+7*3600);
				$ktbs = mysql_query("select KyTuBacSi from bstv where ID_BacSi = {$row['IDBacSiTuVan']}");
				$row_ktbs = mysql_fetch_row($ktbs);
				$KyTuBacSi = $row_ktbs[0];
				if($update != ''){
					$action = $now." ".$KyTuBacSi.$row['MaDatHen']." Sửa :".$update;
					$qt->log_insert($action);
				}
			}
	}
?>
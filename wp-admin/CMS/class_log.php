<?php
	require_once "class_db.php";
	class log extends db{
		function check_user_exist(){
			$now = gmdate("Y-m-d",time()+7*3600);
			$sql = "select id from log where idUser = {$_SESSION['tg_login_id']} and Ngay = '{$now}'";
			$kq = mysql_query($sql);
			$row = mysql_fetch_row($kq);
			return $row[0];
		}
		function log_insert(){
			$id = $this->check_user_exist();
			if($id==''){
				$sql = "insert into log values("",)";
			}
			else{
				$sql = "update";
			}	
		}
	}
?>
<?php 
require_once "class_db.php";
class rating extends db {
	public function VotebyId($idTT){

		$sql="SELECT *
            from ratings
            WHERE  id = $idTT";
		$kq = mysql_query($sql,$this->conn);
		return $kq;
	}
	public function checkVote($idTT){

		$sql="SELECT count(*) FROM ratings WHERE id = $idTT
			";
		$rs = mysql_query($sql,$this->conn);
		$row_rs = mysql_fetch_row($rs);
		$totalRows = $row_rs[0];
		return $totalRows;
	}
	public function addVote($idTT,$json_ip,$total_votes,$total_value){

		$sql="INSERT INTO ratings (id,used_ips,total_votes,total_value)
		VALUES ($idTT, '$json_ip', '$total_votes','$total_value')";
		$kq = mysql_query($sql,$this->conn);
		return $kq;
	}
	public function updateVote($idTT,$json_ip,$total_votes,$total_value){

		$sql="Update ratings
            Set used_ips = '$json_ip',total_votes = '$total_votes', total_value = '$total_value'
            WHERE  id = $idTT";
		$kq = mysql_query($sql,$this->conn);
		return $kq;
	}
	public function addIP($idTT,$json_ip){

		$sql="Update ratings
            Set used_ips = '$json_ip'
            WHERE  id = $idTT";
		$kq = mysql_query($sql,$this->conn);
		return $kq;
	}
	public function checkIP($idTT,$ip_current){

		$sql="SELECT count(*) FROM ratings WHERE id = $idTT and 
            	used_ips like '%$ip_current%'
			";
		$rs = mysql_query($sql,$this->conn);
		$row_rs = mysql_fetch_row($rs);
		$totalRows = $row_rs[0];
		return $totalRows;
	}
}
?>
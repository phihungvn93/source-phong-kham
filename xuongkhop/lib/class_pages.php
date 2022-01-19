<?php
require_once "class_db.php";
class qly_pa extends db{

    public function LayTieuDeKD($idPa){
		$sql="SELECT TieuDeKD  FROM pages WHERE idPa = '$idPa'
			";
		$kq = mysql_query($sql,$this->conn);
		$row_trang = mysql_fetch_assoc($kq);
        return $row_trang['TieuDeKD'];
	}
	public function LayID($TieuDeKD){
		$sql="SELECT idPa  FROM pages WHERE TieuDeKD = '$TieuDeKD'
			";
		$kq = mysql_query($sql,$this->conn);
		$row_trang = mysql_fetch_assoc($kq);
        return $row_trang['idPa'];
	}
	public function LayIDGroup($idPa){
		$sql="SELECT idGroup  FROM pages WHERE idPa = '$idPa'
			";
		$kq = mysql_query($sql,$this->conn);
		$row_trang = mysql_fetch_assoc($kq);
        return $row_trang['idGroup'];
	}
	public function LayNoiDung($idPa){
		$sql="SELECT NoiDung  FROM pages WHERE idPa = '$idPa'
			";
		$kq = mysql_query($sql,$this->conn);
		$row_trang = mysql_fetch_assoc($kq);
        return $row_trang['NoiDung'];
	}
	public function Pages($idPa){
		$sql="SELECT TieuDe, NoiDung, idGroup
            from pages
            WHERE  idPa = $idPa";
		$kq = mysql_query($sql,$this->conn);
		return $kq;
	}
	public function ListPages($idGroup, &$totalRows, $pageNum=1, $pageSize = 10){
        $startRow = ($pageNum-1)*$pageSize;
		$sql="SELECT TieuDe, TomTat, TieuDeKD, UrlHinh
            from pages
            WHERE  AnHien = 1 and idGroup = $idGroup
			ORDER BY idPa desc
			LIMIT $startRow , $pageSize
			";
		$kq = mysql_query($sql,$this->conn);
		$sql="SELECT count(*) FROM pages WHERE AnHien = 1 and idGroup = $idGroup
			";
		$rs= mysql_query($sql);
		$row_rs = mysql_fetch_row($rs);
		$totalRows = $row_rs[0];
		return $kq;
	}
	public function LayTitle($idPa){
		$sql="SELECT Title  FROM pages WHERE idPa = '$idPa'
			";
		$kq = mysql_query($sql,$this->conn);
		$row_trang = mysql_fetch_assoc($kq);
        return $row_trang['Title'];
	}
	public function LayDes($idPa){
		$sql="SELECT Des  FROM pages WHERE idPa = '$idPa'
			";
		$kq = mysql_query($sql,$this->conn);
		$row_trang = mysql_fetch_assoc($kq);
        return $row_trang['Des'];
	}
	public function LayKeyword($idPa){
		$sql="SELECT Keyword  FROM pages WHERE idPa = '$idPa'
			";
		$kq = mysql_query($sql,$this->conn);
		$row_trang = mysql_fetch_assoc($kq);
        return $row_trang['Keyword'];
	}
	public function LayCauHoi($idCL)
	{
		$sql="SELECT * FROM cauhoi WHERE idCL = '$idCL'";
		$kq = mysql_query($sql,$this->conn);		
		return $kq;
	}
	public function LayCauTraLoi($idCH)
	{
		$sql="SELECT * FROM traloi WHERE idCH = '$idCH'";
		$kq = mysql_query($sql,$this->conn);		
		return $kq;
	}
	public function NhapSDT_GoiLai()
	{
		if($_SESSION['last_session_request'] > time() - 10){
			echo "<script>alert('Bạn nhập quá nhanh, vui lòng chờ trong giây lát để nhập lại !!!' );</script>";
		}
		else
		{
			$sdt=$this->XoaDinhDang($_POST['sodienthoai']);
			//if (get_magic_quotes_gpc()== false) {
               	$sdt = mysql_real_escape_string($sdt);
              //}
			$sdt1=$sdt."---http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; 
			$conn2 = mysql_connect("localhost","codevu_dakhoa555","nhocmiss@2");
				mysql_select_db("codevu_dakhoa555", $conn2);
				mysql_query("set names 'utf8'");
							
			$sql="INSERT INTO `sodienthoai` (				
					`sdt` ,
					`NgayGioDK`,`IP`
					)
					VALUES ('".$sdt1."',  '".date("Y-m-d H:i:s")."','".$this->getClientIP()."');";
			mysql_query($sql,$conn2);
			
			echo "<script>alert('Số điện thoại ".$sdt." đã được gửi đến chúng tôi. Chúng tôi sẽ gọi lại cho bạn trong thời gian sớm nhất !!!' );</script>";
		}
		$_SESSION['last_session_request'] = time();
	}
	function getClientIP() {	
		if (isset($_SERVER)) {
	
			if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
				return $_SERVER["HTTP_X_FORWARDED_FOR"];
	
			if (isset($_SERVER["HTTP_CLIENT_IP"]))
				return $_SERVER["HTTP_CLIENT_IP"];
	
			return $_SERVER["REMOTE_ADDR"];
		}
	
		if (getenv('HTTP_X_FORWARDED_FOR'))
			return getenv('HTTP_X_FORWARDED_FOR');
	
		if (getenv('HTTP_CLIENT_IP'))
			return getenv('HTTP_CLIENT_IP');
	
		return getenv('REMOTE_ADDR');
	}
}
?>
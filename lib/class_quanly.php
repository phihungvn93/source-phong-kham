<?php
require_once "class_db.php";
class quanly extends db{

    public function LienHe()
	{
		$HoTen = $_POST['HoTen'];
		$CongTy = $_POST['CongTy'];
		$DiaChi = $_POST['DiaChi'];
        $DienThoai = $_POST['DienThoai'];
        $Email = $_POST['Email'];
		$TieuDe = $_POST['TieuDe'];
        $NoiDung = $_POST['NoiDung'];

        $HoTen = parent::XoaDinhDang($HoTen);
		$CongTy = parent::XoaDinhDang($CongTy);
		$DiaChi = parent::XoaDinhDang($DiaChi);
        $DienThoai = parent::XoaDinhDang($DienThoai);
        $Email = parent::XoaDinhDang($Email);
		$TieuDe = parent::XoaDinhDang($TieuDe);
        $NoiDung = parent::XoaDinhDang($NoiDung);

		$NoiDung = nl2br($NoiDung);

		$sql = "INSERT INTO  lienhe	(HoTen, CongTy, DiaChi, DienThoai, Email, TieuDe, NoiDung)
		   		VALUES ('$HoTen', '$CongTy', '$DiaChi', '$DienThoai', '$Email', '$TieuDe', '$NoiDung')";
        mysql_query($sql);
	}
	public function LienHe2()
	{
	 	$HoTen = $_POST['HoTen'];
        $DienThoai = $_POST['DienThoai'];

        $HoTen = parent::XoaDinhDang($HoTen);
        $DienThoai = parent::XoaDinhDang($DienThoai);

		$sql = "INSERT INTO  dangky (HoTen,DThoai,NgayDK)
		   		VALUES ('$HoTen','$DienThoai',NOW())";
        mysql_query($sql);
	}
	public function LienHe3()
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
							
			$sql="INSERT INTO `sodienthoai` (				
					`sdt` ,
					`NgayGioDK`,`IP`
					)
					VALUES ('".$sdt1."',  '".date("Y-m-d H:i:s")."','".$this->getClientIP()."');";
			 mysql_query($sql);
			
			echo "<script>alert('Số điện thoại ".$sdt." đã được gửi đến chúng tôi. Chúng tôi sẽ gọi lại cho bạn trong thời gian sớm nhất !!!' );</script>";
		}
		$_SESSION['last_session_request'] = time();
	}
	public function LienHe4($ghichu)
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
							
			$sql="INSERT INTO `sodienthoai` (				
					`sdt` ,
					`NgayGioDK`,`IP`,`Ghichu`
					)
					VALUES ('".$sdt1."',  '".date("Y-m-d H:i:s")."','".$this->getClientIP()."','".$ghichu."');";
			 mysql_query($sql);
			
			echo "<script>alert('Số điện thoại ".$sdt." đã được gửi đến chúng tôi. Chúng tôi sẽ gọi lại cho bạn trong thời gian sớm nhất !!!' );</script>";
		}
		$_SESSION['last_session_request'] = time();
	}
	public function LienHe5($sdt,$ghichu)
	{
	 	if($_SESSION['last_session_request'] > time() - 10){
			return "'Bạn nhập quá nhanh, vui lòng chờ trong giây lát để nhập lại !!!' )";
		}
		else
		{
			$sdt=$this->XoaDinhDang($sdt);
			//if (get_magic_quotes_gpc()== false) {
               	$sdt = mysql_real_escape_string($sdt);
              //}
			$sdt1=$sdt."---http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI]; 
							
			$sql="INSERT INTO `sodienthoai` (				
					`sdt` ,
					`NgayGioDK`,`IP`,`Ghichu`
					)
					VALUES ('".$sdt1."',  '".date("Y-m-d H:i:s")."','".$this->getClientIP()."','".$ghichu."');";
			 mysql_query($sql);
			
			return "Số điện thoại ".$sdt." đã được gửi đến chúng tôi. Chúng tôi sẽ gọi lại cho bạn trong thời gian sớm nhất !!!";
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

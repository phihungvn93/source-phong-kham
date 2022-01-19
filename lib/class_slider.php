<?php
require_once "class_db.php";
class qly_slider extends db{

    public function ListSlider($so,$idPa=0){
		if($idPa=="") $idPa=0;
		$sql="SELECT TieuDe, TieuDeKD, UrlHinh, Link
            from quangcao
            WHERE  AnHien =1 and idLoai = $idPa 
            Order By ThuTu ASC
            Limit 0, $so
            ";
		$kq = mysql_query($sql,$this->conn);
		if(mysql_num_rows($kq)>0)
		{
			return $kq;	
		}
		else
		{
			$sql="SELECT TieuDe, TieuDeKD, UrlHinh, Link
            from quangcao
            WHERE  AnHien =1 and idLoai = 0 
            Order By ThuTu ASC
            Limit 0, $so
            ";
			return mysql_query($sql,$this->conn);
		}		
	}
}
?>
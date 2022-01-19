<?php
require_once "class_db.php";
class qly_tin extends db{
	public function LayID($TieuDeKD){
		$sql="SELECT idTT  FROM tintuc WHERE TieuDeKD = '$TieuDeKD'
			";
		$kq = mysql_query($sql,$this->conn);
		$row_trang = mysql_fetch_assoc($kq);
        return $row_trang['idTT'];
	}
	public function LayNoiDung($idTT){
		$sql="SELECT NoiDung  FROM tintuc WHERE idTT = '$idTT'
			";
		$kq = mysql_query($sql,$this->conn);
		$row_trang = mysql_fetch_assoc($kq);
        return $row_trang['NoiDung'];
	}
	public function TinTuc($idTT){
		if($_SESSION["idTin_DaXem"]!=$idTT)
		{
			$_SESSION["idTin_DaXem"]=$idTT;
			mysql_query("Update tintuc Set LuotXem = LuotXem + 1 WHERE  idTT = $idTT",$this->conn) ; 
		}
		
		$sql="SELECT TieuDe, NoiDung, idCL, idLoai,NgayDang,LuotXem, idCon,Tags, UrlHinh
            from tintuc
            WHERE  idTT = $idTT";
		$kq = mysql_query($sql,$this->conn);
		return $kq;

	}
	public function TinTucbyId($idTT){

		$sql="SELECT TieuDe, TieuDeKD, UrlHinh, TomTat, NoiDung, idCL, idLoai,NgayDang,LuotXem, idCon
            from tintuc
            WHERE  idTT = $idTT";
		$kq = mysql_query($sql,$this->conn);
		return $kq;
	}
    public function ListTinMoi($idLoai, $idCL, $start, $sotin){
		$sql="SELECT idTT,TieuDe, TieuDeKD, NgayDang, UrlHinh, TomTat, LuotXem 
            from tintuc
            WHERE  AnHien = 1 and 
            	(idLoai = $idLoai or $idLoai = -1) and 
            		(idCL = $idCL or $idCL = -1)
            Order By NgayDang desc
            Limit $start, $sotin
            ";
		$kq = mysql_query($sql,$this->conn);
		return $kq;
	}
	public function ListTin_Where($idLoai, $idCL, $start, $sotin,$where = "",$order_by = ""){
		$sql="SELECT TieuDe, TieuDeKD, NgayDang, UrlHinh, TomTat, LuotXem
            from tintuc
            WHERE  AnHien = 1 and 
					(idLoai = $idLoai or $idLoai = -1) and 
            		(idCL = $idCL or $idCL = -1) 
					".$where."
					".$order_by."
            Limit $start, $sotin
            ";
		$kq = mysql_query($sql,$this->conn);
		return $kq;
	}
	public function ListTinLoai($idLoai, &$totalRows, $pageNum=1, $pageSize = 10){
        $startRow = ($pageNum-1)*$pageSize;
		$sql="SELECT TieuDe, TomTat, TieuDeKD, UrlHinh, NgayDang , LuotXem
            from tintuc
            WHERE  AnHien = 1 and 
            	(idLoai = $idLoai or 
            		idCL = $idLoai or idCon = $idLoai)
			ORDER BY idTT desc
			LIMIT $startRow , $pageSize
			";
		$kq = mysql_query($sql,$this->conn);
		$sql="SELECT count(*) FROM tintuc WHERE AnHien = 1 and 
					(idLoai = $idLoai or 
            		idCL = $idLoai or idCon = $idLoai)
			";

		$rs= mysql_query($sql);
		$row_rs = mysql_fetch_row($rs);
		$totalRows = $row_rs[0];
		return $kq;
	}
	public function TimKiem($tukhoa, &$totalRows, $pageNum=1, $pageSize = 10){
		$tukhoa = $this->XoaDinhDang($tukhoa);
        $startRow = ($pageNum-1)*$pageSize;
		$sql="SELECT TieuDe, TomTat, TieuDeKD, UrlHinh
            from tintuc
            WHERE  AnHien = 1 and 
            	(idLoai = 74 or 
            		idCL = 74 or idCon = 74) and 
            	(TieuDe like '%$tukhoa%' OR TomTat like '%$tukhoa%' OR NoiDung like '%$tukhoa%')
			ORDER BY idTT desc
			LIMIT $startRow , $pageSize
			";
		$kq = mysql_query($sql,$this->conn);
		$sql="SELECT count(*) FROM tintuc WHERE AnHien = 1 and 
            	(TieuDe like '%$tukhoa%' OR TomTat like '%$tukhoa%' OR NoiDung like '%$tukhoa%')
			";
		$rs= mysql_query($sql);
		$row_rs = mysql_fetch_row($rs);
		$totalRows = $row_rs[0];
		return $kq;
	}
	public function TimKiemTag($tukhoa, &$totalRows, $pageNum=1, $pageSize = 10){
		$tukhoa = $this->XoaDinhDang($tukhoa);
        $startRow = ($pageNum-1)*$pageSize;
		$sql="SELECT TieuDe, TomTat, TieuDeKD, UrlHinh
            from tintuc
            WHERE  AnHien = 1 and 
            	(Tags like '%$tukhoa%')
			ORDER BY idTT desc
			LIMIT $startRow , $pageSize
			";
		$kq = mysql_query($sql,$this->conn);
		$sql="SELECT count(*) FROM tintuc WHERE AnHien = 1 and 
            	(TieuDe like '%$tukhoa%' OR TomTat like '%$tukhoa%' OR NoiDung like '%$tukhoa%')
			";
		$rs= mysql_query($sql);
		$row_rs = mysql_fetch_row($rs);
		$totalRows = $row_rs[0];
		return $kq;
	}
	public function LayHinh($idTT){
		$sql="SELECT UrlHinh FROM tintuc WHERE idTT = '$idTT'
			";
		$kq = mysql_query($sql,$this->conn);
		$row_trang = mysql_fetch_assoc($kq);
        return $row_trang['UrlHinh'];
	}
	public function LayTitle($idTT){
		$sql="SELECT Title  FROM tintuc WHERE idTT = '$idTT'
			";
		$kq = mysql_query($sql,$this->conn);
		$row_trang = mysql_fetch_assoc($kq);
        return $row_trang['Title'];
	}
	public function LayDes($idTT){
		$sql="SELECT Des  FROM tintuc WHERE idTT = '$idTT'
			";
		$kq = mysql_query($sql,$this->conn);
		$row_trang = mysql_fetch_assoc($kq);
        return $row_trang['Des'];
	}
	public function LayKeyword($idTT){
		$sql="SELECT Keyword  FROM tintuc WHERE idTT = '$idTT'
			";
		$kq = mysql_query($sql,$this->conn);
		$row_trang = mysql_fetch_assoc($kq);
        return $row_trang['Keyword'];
	}
}
?>
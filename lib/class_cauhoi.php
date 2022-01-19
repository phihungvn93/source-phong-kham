<?php
require_once "class_db.php";
class qly_cauhoi extends db{

    public function CauHoiMoi(&$totalRows, $pageNum=1, $pageSize = 10,$idCL){
		$startRow = ($pageNum-1)*$pageSize;
		$sql="SELECT idCH, cauhoi.idCL, TieuDeCH, TieuDeCHKD, DescriptionCH, TieuDe, TieuDeKD, NgayTao
            FROM cauhoi, loai
            WHERE cauhoi.AnHien = 1 and cauhoi.idCL = loai.idLoai and (idCL = $idCL or $idCL = -1)
			ORDER BY idCH DESC
            LIMIT $startRow , $pageSize
			";
		$kq = mysql_query($sql,$this->conn);
		$sql="SELECT count(*)
            FROM cauhoi, loai
            WHERE cauhoi.AnHien = 1 and cauhoi.idCL = loai.idLoai and (idCL = $idCL or $idCL = -1)
			";
		$rs= mysql_query($sql);
		$row_rs = mysql_fetch_row($rs);
		$totalRows = $row_rs[0];
		return $kq;
	}
	public function LayTenLoai($TenLoaiKD){
		$sql="SELECT TieuDe
            from loai
            WHERE  TieuDeKD = '$TenLoaiKD' AND AnHien = 1
            ";
		$kq = mysql_query($sql,$this->conn);
		$loai =  mysql_fetch_assoc($kq);
		return $loai['TieuDe'];
	}
	public function LayidCL($TenLoaiKD){
		$sql="SELECT idLoai
            from loai
            WHERE  TieuDeKD = '$TenLoaiKD' AND AnHien = 1
            ";
		$kq = mysql_query($sql,$this->conn);
		$loai =  mysql_fetch_assoc($kq);
		return $loai['idLoai'];
	}
	public function CauHoiChiTiet($idCH){
		$sql="SELECT idCH, TieuDeCH, NoiDungCH, TieuDe, TieuDeKD
            from cauhoi, loai
            WHERE  idCH = '$idCH' AND loai.idLoai = cauhoi.idCL
            ";
		$kq = mysql_query($sql,$this->conn);
		return $kq;
	}
	function ThemCauHoi()
	{
		$HoTen = $_POST['HoTen'];
		$DienThoai = $_POST['DienThoai'];
		$Email = $_POST['Email'];

		$TieuDeCH = $_POST['TieuDeCH'];
		$NoiDungCH = $_POST['NoiDungCH'];
        $idCL = $_POST['Cha'];


		settype($idCL,'int');
		$HoTen = parent::XoaDinhDang($HoTen);
		$DienThoai = parent::XoaDinhDang($DienThoai);
		$Email = parent::XoaDinhDang($Email);
		$TieuDeCH = parent::XoaDinhDang($TieuDeCH);
		$NoiDungCH = parent::XoaDinhDang($NoiDungCH);

		$TieuDeCHKD = parent::stripUnicode($TieuDeCH);
        $DescriptionCH = parent::RutGon($NoiDungCH,10,100);
       	$NgayTao = date('Y-m-d');

		print_r($_POST);
		$sql = "INSERT INTO  cauhoi	(HoTen, DienThoai, TieuDeCH, NoiDungCH, NgayTao, Email, TieuDeCHKD, DescriptionCH, idCL)
	   VALUES ('$HoTen', '$DienThoai', '$TieuDeCH', '$NoiDungCH', '$NgayTao', '$Email', '$TieuDeCHKD', '$DescriptionCH', $idCL)";
       mysql_query($sql);
       $idCH = mysql_insert_id();
       $TieuDeCHKD = $idCH."-".$TieuDeCHKD;
       $sql="UPDATE cauhoi
            SET TieuDeCHKD = '$TieuDeCHKD'
            WHERE idCH = $idCH
            ";
        mysql_query($sql);
	}
	public function TongCH($idCL){		
		$sql="SELECT count(*)
            FROM cauhoi
            WHERE AnHien = 1 and idCL = $idCL";
		$rs= mysql_query($sql);
		$row_rs = mysql_fetch_row($rs);
		$totalRows = $row_rs[0];
		return $totalRows;
	}
    public function TraLoiChiTiet($idCH){
		$sql="SELECT NoiDungTL
            from traloi
            WHERE  idCH = '$idCH'
            ORDER BY idTL desc
            ";
		$kq = mysql_query($sql,$this->conn);
		return $kq;
	}
}
?>
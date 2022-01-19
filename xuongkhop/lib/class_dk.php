<?php
require_once "class_db.php";
class qly_dk extends db{

    function DangKyKhamBenh()
	{
		$HoTen = $_GET['HoTen'];
		$DThoai = $_GET['DThoai'];
		$Tuoi = $_GET['Tuoi'];
		$GioiTinh = $_GET['GioiTinh'];
		$Chuyenkhoa = $_GET['Chuyenkhoa'];
		$TrieuChung = $_GET['TrieuChung'];		
		$NgayDK = $_GET['NgayDK'];

		$HoTen = parent::XoaDinhDang($HoTen);
		$DThoai = parent::XoaDinhDang($DThoai);
		$Tuoi = parent::XoaDinhDang($Tuoi);
		$GioiTinh = parent::XoaDinhDang($GioiTinh);
		$Chuyenkhoa = parent::XoaDinhDang($Chuyenkhoa);
		$TrieuChung = parent::XoaDinhDang($TrieuChung);
				
		$NgayDK = date('Y-m-d',strtotime(str_replace('/', '-', $NgayDK)));		
		
		$sql = "INSERT INTO `dangky` ( `HoTen`, `Tuoi`,`GioiTinh`, `DThoai`, `Email`, `DiaChi`, `NgayDK`, `Chuyenkhoa`, `GhiChu`, `TrieuChung`) VALUES ( '$HoTen', '$Tuoi','$GioiTinh', '$DThoai', 'Email', 'DiaChi','$NgayDK', '$Chuyenkhoa', 'ghichu', '$TrieuChung');";

	   	mysql_query($sql);
	}

    function DangKyKB() {
		$HoTen = $_GET['HoTen'];
		$Email = $_GET['Email'];
		$Tuoi = $_GET['Tuoi'];
		$DThoai = $_GET['DThoai'];
		$TrieuChung = $_GET['TrieuChung'];		
		$NgayDK = date('Y-m-d');

		$HoTen = parent::XoaDinhDang($HoTen);
		$Email = parent::XoaDinhDang($Email);
		$Tuoi = parent::XoaDinhDang($Tuoi);
		$DThoai = parent::XoaDinhDang($DThoai);
		$TrieuChung = parent::XoaDinhDang($TrieuChung);
		$sql = "INSERT INTO `dangky` ( `HoTen`, `Email`, `Tuoi`, `DThoai`, `TrieuChung`, `NgayDK`) VALUES ( '$HoTen', '$Email','$Tuoi', '$DThoai', '$TrieuChung', '$NgayDK');";
	   	return mysql_query($sql);
	}

	function FindPhone($where) {
		$sql = "SELECT * FROM dangky ".$where.";";
		$result = mysql_query($sql);
		return mysql_num_rows($result);
	}
}
?>
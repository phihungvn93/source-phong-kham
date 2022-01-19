<?php
	require_once "classDB.php";
	class api extends db
	{
		public $user="";
		public $pass="";
		public $datearr="";
		function __construct($user="",$pass="",$date=""){
		//	$args = func_get_args();
			$this->user = $user;
			$this->pass = $pass;
			$this->datearr = $date;
			
		}
		function jsonRemoveUnicodeSequences($struct) {
			return preg_replace("/\\\\u([a-f0-9]{4})/e", "iconv('UCS-4LE','UTF-8',pack('V', hexdec('U$1')))", json_encode($struct));
		}
		function getTheGioi()
		{
			$title="Thế Giới";
			$NgayGioDenKham = date("Y-m-d",strtotime($this->datearr));
			$tc = $this->ListDH_DaDen($NgayGioDenKham);

			$daden = $this->ListDH_DaDen($NgayGioDenKham,1);
			$chuaden = $this->ListDH_DaDen($NgayGioDenKham,0);
			$return = array("phongkham"=> "$title" ,"tongcong"=>$tc,"daden"=>$daden,"chuaden" =>$chuaden);
			return $this->jsonRemoveUnicodeSequences($return);			
		}
		public function ListDH_DaDen($NgayGioDenKham,$DaDen=-1){
			$NgayGioDenKham = Date($NgayGioDenKham);
			$sql = "select count(*) from dathen WHERE  TinhTrang = 0 and (DaDen = $DaDen OR $DaDen = -1) AND DATE_FORMAT( NgayGioDenKham,  '%Y-%m-%d') = '$NgayGioDenKham'";
			$kq = mysql_query($sql);
			$row = mysql_fetch_row($kq);
			$totalRows_DaDen = $row[0];
			return $totalRows_DaDen;
		}
		public function ListDH($id=-1,$NgayGioDenKham)
		{
			//$NgayGioDenKham = date("Y-m-d",strtotime($NgayGioDenKham));
			$sql="SELECT LoaiBenh,DaDen,GioiTinh, concat(KyTuBacSi,MaDatHen) as MaHen,Nguon  
				FROM  dathen ,bstv
				WHERE dathen.IDBacSiTuVan = bstv.ID_BacSi and (IDBacSiTuVan =$id Or $id=-1) and TinhTrang = 0
				AND DATE_FORMAT( NgayGioDenKham,  '%Y-%m-%d') = '$NgayGioDenKham'
				ORDER BY ID_DatHen DESC";

			$kq = mysql_query($sql);
			$data = array();
			while($row = mysql_fetch_assoc($kq))
			{
				$data[] = $row;
			}
			
			return $data;
		}
		function getTheGioiTheoNgay($tungay,$denngay)
		{
			$title="Thế Giới";
			$tungay = date("Y-m-d",strtotime($tungay));
			$denngay = date("Y-m-d",strtotime($denngay));
					
			$tc = $this->ListDH_DaDenTheoNgayThang($tungay,$denngay);
			$daden = $this->ListDH_DaDenTheoNgayThang($tungay,$denngay,1);
			$chuaden = $this->ListDH_DaDenTheoNgayThang($tungay,$denngay,0);
	
			$return = array("phongkham"=> "$title" ,"tongcong"=>$tc,"daden"=>$daden,"chuaden" =>$chuaden);
			return $this->jsonRemoveUnicodeSequences($return);			
		}
		
		
		public function ListDH_DaDenTheoNgayThang($tungay,$denngay,$DaDen=-1){
			$tungay = Date($tungay);
			$denngay = Date($denngay);
			$sql = "select count(*) from dathen WHERE  TinhTrang = 0 and (DaDen = $DaDen OR $DaDen = -1) AND DATE_FORMAT( NgayGioDenKham,  '%Y-%m-%d') between '$tungay' and '$denngay'";
			$kq = mysql_query($sql);
			$row = mysql_fetch_row($kq);
			$totalRows_DaDen = $row[0];
			return $totalRows_DaDen;
		}
	
	}
 ?>
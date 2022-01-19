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
		function getDaiDong()
		{
			$title="Đại Đông";
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
		
	
	}
 ?>
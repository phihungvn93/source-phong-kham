<?php
	require_once "class_db.php";
	class quantri extends db
	{	   
		/* log */
		function check_user_exist(){
			$now = gmdate("Y-m-d",time()+7*3600);
			$sql = "select id from log where idUser = {$_SESSION['tg_login_id']} and Ngay = '{$now}'";
			$kq = mysql_query($sql);
			$row = mysql_fetch_row($kq);
			return $row[0];
		}
		function log_detail($id){
			$sql = "select * from log where id = $id";
			return mysql_query($sql);
		}
		function log_insert($action){
			$now = gmdate("Y-m-d",time()+7*3600);
			$id = $this->check_user_exist();
			echo "dasdasdas".$id;
			if($id==''){
				$sql = "insert into log values('',{$_SESSION['tg_login_id']},'{$now}','{$action}')";
				mysql_query($sql);
			}
			else{
				$kq = $this->log_detail($id);
				$row = mysql_fetch_assoc($kq);
				$act_now = $row['Action'];
				$act_now.= "###".$action;
				$sql = "update log set Action = '{$act_now}' where id = $id";
				mysql_query($sql);
			}	
		}
		function log_list($pageNum,$pageSize,&$totalRow){
			$sql = "select count(id) from log";
			$kq = mysql_query($sql);
			$row = mysql_fetch_row($kq);
			$totalRow = $row[0];
			$start = ($pageNum-1)*$pageSize;
			$sql = "select * from log order by Ngay desc limit $start,$pageSize";
			return mysql_query($sql);
		}
		
		
		
		/* log */
        public function ListDH($id,&$totalRows, $pageNum, $pageSize, $Where ){
			$startRow = ($pageNum-1)*$pageSize;
				$sql="SELECT * 
				FROM  dathen ,bstv
				WHERE dathen.IDBacSiTuVan = bstv.ID_BacSi and (IDBacSiTuVan =$id Or $id=-1) and TinhTrang = 0 $Where 
				ORDER BY ID_DatHen DESC
				LIMIT $startRow , $pageSize
				";
				$kq = mysql_query($sql) or die (mysql_error());
				$sql="SELECT count(*)
	    				FROM  dathen,bstv
						WHERE dathen.IDBacSiTuVan = bstv.ID_BacSi and (IDBacSiTuVan =$id Or $id=-1) and TinhTrang = 0 $Where
				";
			$rs= mysql_query($sql) or die(mysql_error());;
			$row_rs = mysql_fetch_row($rs);
			$totalRows = $row_rs[0];
			return $kq;
		}
		function ListDH2($id, $pageNum, $pageSize, $Where ){
			$startRow = ($pageNum-1)*$pageSize;
				$sql="SELECT * 
				FROM  dathen ,bstv
				WHERE dathen.IDBacSiTuVan = bstv.ID_BacSi and (IDBacSiTuVan =$id Or $id=-1) and TinhTrang = 0 $Where 
				ORDER BY ID_DatHen DESC
				LIMIT $startRow , $pageSize
				";
				$kq = mysql_query($sql) or die (mysql_error());
				
			return $kq;
		}
		public function ListDH_DaDen($id,$DaDen,$Where){
			$sql = "select count(*) from dathen,bstv WHERE dathen.IDBacSiTuVan = bstv.ID_BacSi and (IDBacSiTuVan =$id Or $id=-1) and TinhTrang = 0 and DaDen = $DaDen $Where";
			$kq = mysql_query($sql);
			$row = mysql_fetch_row($kq);
			$totalRows_DaDen = $row[0];
			return $totalRows_DaDen;
		}
		public function XoaDH($id){
			settype($id, "int");
			if ($id<=0) return;
			$sql="Update dathen set TinhTrang = 1 WHERE ID_DatHen=$id";
			mysql_query($sql) or die(mysql_error());

			if(mysql_affected_rows()>0){
				$now = gmdate("H:i:s",time()+7*3600);
				$chitiet = $this->ChiTietDH($id);
				$row = mysql_fetch_assoc($chitiet);
				$ktbs = mysql_query("select KyTuBacSi from bstv where ID_BacSi = {$row['IDBacSiTuVan']}");
				$row_ktbs = mysql_fetch_row($ktbs);
				$action = $now.": Xóa đặt hẹn ".$row_ktbs[0].$row['MaDatHen'];
				$this->log_insert($action);	
			}
		}
		public function ThemDH(){
		
		if($_SESSION['last_session_request'] > time() - 5){
			//dont make
		}
		else
		{			
			//Tiếp nhận dữ liệu từ form
			$MaDatHen = $_POST['MaDatHen'];
			$TenBenhNhan = $_POST['TenBenhNhan'];
            $SoDT = $_POST['SoDT'];
			$nam = date("Y");
			$NgayGioDenKham = $_POST['NgayDenKham']." ".$_POST['GioDenKham'].":00" ;				
			$NgayGioDatHen = $_POST['NgayGioDatHen'];			
            $LoaiBenh = $_POST['LoaiBenh'];
			$Tuoi = $_POST['Tuoi'];
			$GioiTinh = $_POST['GioiTinh'];
			$DiaChi = $_POST['DiaChi'];
            $BSKham = $_POST['BSKham'];
			$ID_BacSiDT = $_POST['ID_BacSiDT'];	
			$GhiChu = $_POST['GhiChu'];
			$Nguon = $_POST['Nguon'];
			$NgayGioDenKham = date("y-m-d H:i:s",strtotime($NgayGioDenKham));
			$NgayGioDatHen = date("y-m-d H:i:s",strtotime($NgayGioDatHen));
			$idTP = $_POST['idTP'];
			$idQuan = $_POST['idQuan'];
			
			//chèn vào db
			$sql="INSERT INTO `dathen` (`ID_DatHen`, `MaDatHen`, `TenBenhNhan`, `SoDT`,`Tuoi`,`GioiTinh`,`DiaChi`, `NgayGioDenKham`, `LoaiBenh`,`BenhThucTe`, `BSKham`, `IDBacSiTuVan`, `DaDen`, `GhiChu`, `Nguon`,`NgayGioDatHen`,`ID_Update`,`DieuTri`,idTP,idQuan,ID_BacSiDT) VALUES (NULL, '$MaDatHen', '$TenBenhNhan', '$SoDT','$Tuoi','$GioiTinh','$DiaChi', '$NgayGioDenKham', '$LoaiBenh','', '$BSKham', '".$_SESSION['tg_login_id']."', '0', '$GhiChu', '$Nguon','$NgayGioDatHen',".$_SESSION['tg_login_id'].",'0',$idTP,$idQuan,$ID_BacSiDT);";
			mysql_query($sql) or die(mysql_error());
			if(mysql_affected_rows()>0){
				$now = gmdate("H:i:s",time()+7*3600);
				$action = $now." Thêm đặt hẹn";
				$this->log_insert($action);	
			}
			}
		$_SESSION['last_session_request'] = time();
		}
        public function ChiTietDH($id){
			$sql = "SELECT * FROM dathen WHERE ID_DatHen=$id";
			$kq = mysql_query($sql) or die (mysql_error());
			return $kq;
		}// xem chi tiết thể loại để chỉnh sữa
        public function SuaDH($id){
			
			//Tiếp nhận dữ liệu từ form			
			$TenBenhNhan = $_POST['TenBenhNhan'];
            $SoDT = $_POST['SoDT'];
            $NgayGioDenKham = $_POST['NgayGioDenKham'];
            $LoaiBenh = $_POST['LoaiBenh'];
			$BenhThucTe = $_POST['BenhThucTe'];
			$Tuoi = $_POST['Tuoi'];
			$GioiTinh = $_POST['GioiTinh'];
			$DiaChi = $_POST['DiaChi'];
            $BSKham = $_POST['BSKham'];
			$ID_BacSiDT = $_POST['ID_BacSiDT'];	settype($ID_BacSiDT,"int");
			$GhiChu = $_POST['GhiChu'];
			$Nguon = $_POST['Nguon'];
			$DaDen = $_POST['DaDen'];
			$DieuTri = $_POST['DieuTri'];
			$NgayGioDenKham = date("Y-m-d H:i",strtotime($NgayGioDenKham));
			$ID_Update = $_SESSION['tg_login_id'];
			$idTP = $_POST['idTP'];
			$idQuan = $_POST['idQuan'];
			
			$dh = $this->ChiTietDH($id);
			$row = mysql_fetch_assoc($dh);
			if($DaDen == 0){
				if($row['DaDen'] == 1){
					if($_SESSION['quyen']['tick_den'] == 0) $DaDen = 1;
				}		
			}
			$n = date("Y-m-d H:i",strtotime($row['NgayGioDenKham']));
			
			$update = "";
			if($row['TenBenhNhan'] != $TenBenhNhan) $update .= " {".$row['TenBenhNhan']." &rarr; ".$TenBenhNhan."} ";
			if($row['SoDT'] != $SoDT) $update .= " {DT ".$row['SoDT']." &rarr; ".$SoDT."} ";
			if($n != $NgayGioDenKham) $update .= " {Ngày đến khám ".$row['NgayGioDenKham']." &rarr; ".$NgayGioDenKham."} ";
			if($row['LoaiBenh'] != $LoaiBenh) $update .= " {".$row['LoaiBenh']." &rarr; ".$LoaiBenh."} ";
			if($row['BenhThucTe'] != $BenhThucTe) $update .= " {Nguồn ".$row['BenhThucTe']." &rarr; ".$BenhThucTe."} ";
			if($row['Tuoi'] != $Tuoi) $update .= " {".$row['Tuoi']." &rarr; ".$Tuoi."} ";
			if($row['GioiTinh'] != $GioiTinh) {
				if($GioiTinh == 1) $update .= " {Nữ &rarr; Nam} ";
				else $update .= " {Nam &rarr; Nữ} ";		
			}
			if($row['DiaChi'] != $DiaChi) $update .= " {Địa chỉ ".$row['DiaChi']." &rarr; ".$DiaChi."} ";
			//if($row['BSKham'] != $BSKham) $update .= " {BS khám ".$row['BSKham']." &rarr; ".$BSKham."} ";
			if($row['GhiChu'] != $GhiChu) $update .= " {Ghi chú ".$row['GhiChu']." &rarr; ".$GhiChu."} ";
			if($row['DaDen'] != $DaDen) {
				if($DaDen == 1) $update .= " {Không đến &rarr; Đã đến} ";
				else $update .= " {Đã đến &rarr; Không đến} ";
			}
			if($row['DieuTri'] != $DieuTri) {
				if($DieuTri == 1) $update .= " {Chưa DTrị &rarr; Đã DTrị} ";
				else $update .= " {Đã DTrị &rarr; Chưa DTrị} ";
			}
			if($row['Nguon'] != $Nguon) $update .= " {web ".$row['Nguon']." &rarr; ".$Nguon."} ";
			if($row['idTP'] != $idTP) {
				$TenTP_old = $this->TP_detail($row['idTP']);
				$TenTP_new = $this->TP_detail($idTP);
				$update .= " {".$TenTP_old." &rarr; ".$TenTP_new."} ";		
			}
			if($row['idQuan'] != $idQuan) {
				$TenQuan_old = $this->Quan_detail($row['idQuan']);
				$TenQuan_new = $this->Quan_detail($idQuan);
				$update .= " {".$TenQuan_old." &rarr; ".$TenQuan_new."} ";		
			}
			if($row['ID_BacSiDT'] != $ID_BacSiDT) {
				$TenBS_old = $this->BS_detail($row['ID_BacSiDT']);
				$TenBS_new = $this->BS_detail($ID_BacSiDT);
				$update .= " {".$TenBS_old." &rarr; ".$TenBS_new."} ";		
			}
			//chèn vào db
        	$sql="UPDATE dathen
            SET TenBenhNhan = '$TenBenhNhan',
                SoDT = '$SoDT',
                NgayGioDenKham = '$NgayGioDenKham',
                LoaiBenh = '$LoaiBenh',
				BenhThucTe = '$BenhThucTe',
				Tuoi = '$Tuoi',
				GioiTinh = '$GioiTinh',
				DiaChi = '$DiaChi',
                BSKham = '$BSKham',
                GhiChu = '$GhiChu',
				DaDen = '$DaDen',
				DieuTri = '$DieuTri',
				Nguon = '$Nguon' ,
				ID_Update = $ID_Update,
				idTP = $idTP,
				idQuan = $idQuan,
				ID_BacSiDT = $ID_BacSiDT
            WHERE ID_DatHen = $id
            ";
            mysql_query($sql) or die(mysql_error());
			if(mysql_affected_rows()>0){
				$now = gmdate("H:i:s",time()+7*3600);
				$ktbs = mysql_query("select KyTuBacSi from bstv where ID_BacSi = {$row['IDBacSiTuVan']}");
				$row_ktbs = mysql_fetch_row($ktbs);
				$KyTuBacSi = $row_ktbs[0];
				if($update != ''){
					$action = $now." ".$KyTuBacSi.$row['MaDatHen']." Sửa :".$update;
					$this->log_insert($action);	
				}
			}
		}
		function LaySoDHMoiNhat($idBS){			
			$sql = "Select MaDatHen from dathen where IDBacSiTuVan = $idBS and  MONTH(NgayGioDatHen) = ".date("m")." and Year(NgayGioDatHen) = ".date("Y")." Order by MaDatHen * 1 DESC ";
			$kq = mysql_query($sql,$this->conn);
			$row_trang = mysql_fetch_assoc($kq);
	        if($row_trang['MaDatHen']>100)
				return $row_trang['MaDatHen'];
			else
				return 100;	
			;
		}
		
		//----------------- Bác Sĩ -----------------------------//
		public function ListBSTV($id,$pageNum, $pageSize, $Where ){
			$startRow = ($pageNum-1)*$pageSize;
				$sql="SELECT * 
				FROM  bstv
				WHERE ID_BacSi =$id Or $id=-1
				ORDER BY ID_BacSi DESC
				LIMIT $startRow , $pageSize
				";
				$kq = mysql_query($sql) or die (mysql_error());				
			return $kq;
		}
		
		//----------------- Tài Khoản -----------------------------//
        public function ListTK(&$totalRows, $pageNum, $pageSize, $TieuDe){
			$startRow = ($pageNum-1)*$pageSize; 
			if ($TieuDe != ""){
				$sql="	SELECT idUser, User, idGroup
				FROM  users
				WHERE User like '%$TieuDe%'
				ORDER BY idUser DESC
				LIMIT $startRow , $pageSize
				";
				$kq = mysql_query($sql) or die (mysql_error());
				$sql="SELECT count(*)
	    				FROM  users
	    				WHERE User like '%$TieuDe%'
				";
			}else{
				$sql="	SELECT idUser, User, idGroup
				FROM  users
				ORDER BY idUser DESC
				LIMIT $startRow , $pageSize
				";
				$kq = mysql_query($sql) or die (mysql_error());
				$sql="SELECT count(*)
	    				FROM  users
				";
			}
			$rs= mysql_query($sql) or die(mysql_error());;
			$row_rs = mysql_fetch_row($rs);
			$totalRows = $row_rs[0];
			return $kq;
		}
        public function ThemTK()
		{
            $User= $_POST['User'];
            $Pass = $_POST['Pass'];
			$idGroup = $_POST['idGroup'];

			$User = parent::XoaDinhDang($User);
			$Pass = parent::XoaDinhDang($Pass);
			$Pass = md5($Pass);
			settype($idGroup,"int");

			//Chèn dữ liệu vào database
			$sql="INSERT INTO users (User, Pass, idGroup)
				VALUES ('$User', '$Pass', '$idGroup')";
			mysql_query($sql) or die (mysql_error());
		}
        public function ChiTietTK($id){
			$sql = "SELECT * FROM bstv WHERE ID_BacSi=$id";
			$kq = mysql_query($sql) or die (mysql_error());
			return $kq;
		}// xem chi tiết thể loại để chỉnh sữa
		public function SuaTKMK($id)
		{
            $MatKhau = $_POST['Pass'];
			$MatKhau = parent::XoaDinhDang($MatKhau);
			$MatKhau = md5($MatKhau);

			$sql="UPDATE bstv
				SET MatKhau = '$MatKhau'
                WHERE ID_BacSi = $id
                ";
			mysql_query($sql) or die(mysql_error());
		}
		public function SuaTKCV($idSP)
		{
			$idGroup = $_POST['idGroup'];
			settype($idGroup,"int");

			//Cập nhật vào db
			$sql="UPDATE users
				SET idGroup = '$idGroup'
                WHERE idUser = $idSP
                ";
			mysql_query($sql) or die(mysql_error());
		}
        public function XoaTK($idDM)
		{
			settype($idDM,"int");
			$sql="DELETE FROM users WHERE idUser=$idDM";
			mysql_query($sql) or die(mysql_error());
		}		
		//-----------------------------An Hien ---------------------//
		public function LayDaDen($bang, $cot, $ma, $id){
			$sql="SELECT $cot FROM $bang WHERE $ma = '$id'";
			$kq = mysql_query($sql,$this->conn);
			$row_trang = mysql_fetch_assoc($kq);
	        return $row_trang[$cot];
		}
		public function DoiDaDen($bang, $cot,$ma, $id, $val){
			//Phai lam them khi check vao da den thi cap nhat ngay gio hien tai. Khi tiep tan dung may
			$sql="UPDATE $bang
				SET $cot = '$val'
                WHERE $ma = $id
                ";
			mysql_query($sql) or die(mysql_error());
			if(mysql_affected_rows()>0){
				$now = gmdate("H:i:s",time()+7*3600);
				$dh = $this->ChiTietDH($id);
				$row = mysql_fetch_assoc($dh);
				$ktbs = mysql_query("select KyTuBacSi from bstv where ID_BacSi = {$row['IDBacSiTuVan']}");
				$row_ktbs = mysql_fetch_row($ktbs);
				$KyTuBacSi = $row_ktbs[0];
				if($val == 1)
					$action = $now." Sửa ".$KyTuBacSi." ".$row['MaDatHen'].": Chưa đến &rarr; Đã đến";
				else
					$action = $now." Sửa ".$KyTuBacSi." ".$row['MaDatHen'].": Đã đến &rarr; Chưa đến";
				$this->log_insert($action);	
			}
		}		    
		public function SuaThuTu($bang, $ma, $id, $doi){
			$sql="UPDATE $bang
				SET ThuTu = '$doi'
                WHERE $ma = $id
                ";
			mysql_query($sql) or die(mysql_error());
		}
		
		//----------------------------- Thống Kê ---------------------//
		public function TongPages(){
			$sql="SELECT count(*) as Tong FROM pages WHERE idGroup = '1'";
			$kq = mysql_query($sql,$this->conn);
			$row_trang = mysql_fetch_assoc($kq);
	        return $row_trang['Tong'];
		}
		public function TongTB(){
			$sql="SELECT count(*) as Tong FROM pages WHERE idGroup = '2'";
			$kq = mysql_query($sql,$this->conn);
			$row_trang = mysql_fetch_assoc($kq);
	        return $row_trang['Tong'];
		}
		public function TongTT(){
			$sql="SELECT count(*) as Tong FROM tintuc";
			$kq = mysql_query($sql,$this->conn);
			$row_trang = mysql_fetch_assoc($kq);
	        return $row_trang['Tong'];
		}	
		public function ThongKeNguoiDenKham($id,$from="",$to=""){
			$mang = array();
			$sql = "select count(*) as KQ from dathen where (IDBacSiTuVan =$id Or $id=-1) and DaDen = 1 and TinhTrang=0 ";
			$kq = mysql_query($sql,$this->conn);
			$row_trang = mysql_fetch_assoc($kq);
			$mang["denkham"]=$row_trang['KQ'];
			$sql = "select count(*) as KQ from dathen where (IDBacSiTuVan =$id Or $id=-1) and DaDen = 0 and TinhTrang=0 ";
			$kq = mysql_query($sql,$this->conn);
			$row_trang = mysql_fetch_assoc($kq);
			$mang["chuaden"]=$row_trang['KQ'];
			return $mang;
		}
		public function ThongKe_Mang_NgayThangVaDatHen($id,&$mang,$from="",$to=""){
			$sql = "select cast(`dathen`.`NgayGioDenKham` as date) AS `NgayGioDenKham`,count(0) AS `SoNguoiDH` from `dathen` where `dathen`.`TinhTrang` = 0 and NgayGioDenKham between '$from' and '$to' and (IDBacSiTuVan =$id Or $id=-1) group by cast(`dathen`.`NgayGioDenKham` as date) ";
			$kq = mysql_query($sql,$this->conn);			
			while($row = mysql_fetch_assoc($kq))
			{
				$mang[$row["NgayGioDenKham"]]=$row["SoNguoiDH"];				
			}				
			return true;
		}
		public function ThongKe_Mang_NgayThangVaNguoiKham($id,&$mang,$from="",$to=""){
			$sql = "select cast(`dathen`.`NgayGioDenKham` as date) AS `NgayGioDenKham`,count(0) AS `SoNguoiDen` from `dathen` where `dathen`.`DaDen` = 1 and `dathen`.`TinhTrang` = 0 and NgayGioDenKham between '$from' and '$to' and (IDBacSiTuVan =$id Or $id=-1) group by cast(`dathen`.`NgayGioDenKham` as date)  ";
			$kq = mysql_query($sql,$this->conn);			
			while($row = mysql_fetch_assoc($kq))
			{
				$mang[$row["NgayGioDenKham"]]=$row["SoNguoiDen"];
			}
			return true;
		}				
		public function ThongKe_Mang_BenhDatHen($id,&$mang,$from="",$to=""){
			$sql = "select LoaiBenh,count(*) AS `SoNguoi` from `dathen` where `dathen`.`TinhTrang` = 0 and (IDBacSiTuVan =$id Or $id=-1) and NgayGioDenKham between '$from' and '$to' group by LoaiBenh order by `SoNguoi` desc ";
			$kq = mysql_query($sql,$this->conn);			
			while($row = mysql_fetch_assoc($kq))
			{
				$mang[$row["LoaiBenh"]]=$row["SoNguoi"];
			}
			return true;
		}
		public function ThongKe_Mang_BenhThucTe($id,&$mang,$from="",$to=""){
			$sql = "select BenhThucTe,count(*) AS `SoNguoi` from `dathen` where `dathen`.`TinhTrang` = 0 and `dathen`.`DieuTri` = 1 and (IDBacSiTuVan =$id Or $id=-1) and NgayGioDenKham between '$from' and '$to' group by BenhThucTe order by `SoNguoi` desc  ";
			$kq = mysql_query($sql,$this->conn);			
			while($row = mysql_fetch_assoc($kq))
			{
				$mang[$row["BenhThucTe"]]=$row["SoNguoi"];
			}
			return true;
		}
		public function ThongKe_Mang_GioiTinh($id,&$mang,$from="",$to=""){
			 $sql = "select GioiTinh,count(*) AS `SoNguoi` from `dathen` where `dathen`.`TinhTrang` = 0 and (IDBacSiTuVan =$id Or $id=-1) and NgayGioDenKham between '$from' and '$to' group by GioiTinh order by `SoNguoi` desc  ";
			$kq = mysql_query($sql,$this->conn);			
			while($row = mysql_fetch_assoc($kq))
			{
				$mang[$row["GioiTinh"]]=$row["SoNguoi"];
			}
			return true;
		}	
		public function ThongKe_Mang_Nguon($id,&$mang,$from="",$to=""){
			 $sql = "select Nguon,count(*) AS `SoNguoi` from `dathen` where `dathen`.`TinhTrang` = 0 and (IDBacSiTuVan =$id Or $id=-1) and NgayGioDenKham between '$from' and '$to' group by Nguon order by `SoNguoi` desc  ";
			$kq = mysql_query($sql,$this->conn);			
			while($row = mysql_fetch_assoc($kq))
			{
				$mang[$row["Nguon"]]=$row["SoNguoi"];
			}
			return true;
		}
		public function TP_list(){
			$sql = "select * from provinces order by ordering asc";
			return mysql_query($sql);
		}	
		public function Quan_list($idTP=-1){
			$sql = "select * from wards where (province_id = $idTP OR $idTP = -1)";
			return mysql_query($sql);
		}
		public function TP_detail($idTP){
			$sql = "select title from provinces where id = {$idTP}";
			$kq = mysql_query($sql);
			$row = mysql_fetch_row($kq);
			return $row[0];
		}
		public function Quan_detail($idQuan){
			$sql = "select title from wards where id = {$idQuan}";
			$kq = mysql_query($sql);
			$row = mysql_fetch_row($kq);
			return $row[0];
		}
		public function getFile($id_dathen){
			$sql = "select url from file where ID_DatHen = {$id_dathen}";
			$kq = mysql_query($sql);
			//$row = mysql_fetch_row($sql);
			return $kq;
		}
		/* bac si */
		public function BacSi_DT_list(){
			$sql = "select * from bstv where idGroup = 6";
			return mysql_query($sql);
		}
		public function ListDH_bacsi($id,&$totalRows, $pageNum, $pageSize, $Where ){
			$startRow = ($pageNum-1)*$pageSize;
				$sql="SELECT * 
				FROM  dathen ,bstv
				WHERE dathen.ID_BacSiDT = bstv.ID_BacSi and (dathen.ID_BacSiDT =$id Or $id=-1) and TinhTrang = 0 $Where 
				ORDER BY ID_DatHen DESC
				LIMIT $startRow , $pageSize
				";
				$kq = mysql_query($sql) or die (mysql_error());
				$sql="SELECT count(*)
	    				FROM  dathen,bstv
						WHERE dathen.ID_BacSiDT = bstv.ID_BacSi and (dathen.ID_BacSiDT =$id Or $id=-1) and TinhTrang = 0 $Where
				";
			$rs= mysql_query($sql) or die(mysql_error());;
			$row_rs = mysql_fetch_row($rs);
			$totalRows = $row_rs[0];
			return $kq;
		}
		public function ListDH_DaDen_bacsi($id,$DaDen,$Where){
			$sql = "select count(*) from dathen,bstv WHERE dathen.ID_BacSiDT = bstv.ID_BacSi and (dathen.ID_BacSiDT =$id Or $id=-1) and TinhTrang = 0 and DaDen = $DaDen $Where";
			$kq = mysql_query($sql);
			$row = mysql_fetch_row($kq);
			$totalRows_DaDen = $row[0];
			return $totalRows_DaDen;
		}
		public function BS_detail($id){
			$sql = "select TenBS from bstv where ID_BacSi = $id";
			$kq = mysql_query($sql);
			$row = mysql_fetch_row($kq);
			return $row[0]; 
		}
	}
?>
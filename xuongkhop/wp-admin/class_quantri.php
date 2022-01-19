<?php
	require_once "../lib/class_db.php";
	class quantri extends db
	{
	   //----------------- Công Dụng -----------------------------//
         public function ListPA(&$totalRows, $pageNum, $pageSize, $TieuDe){
			$startRow = ($pageNum-1)*$pageSize;
			if ($TieuDe != ""){
				$sql="	SELECT idPa, TieuDe, Des, AnHien, TieuDeKD,TomTat
				FROM  pages
				WHERE TieuDe like '%$TieuDe%' AND idGroup='1'
				ORDER BY idPa DESC
				LIMIT $startRow , $pageSize
				";
				$kq = mysql_query($sql) or die (mysql_error());
				$sql="SELECT count(*)
	    				FROM  pages
	    				WHERE TieuDe like '%$TieuDe%' AND idGroup=1
				";
			}else{
				$sql="	SELECT idPa, TieuDe, Des, AnHien, TieuDeKD, TomTat
				FROM  pages
				ORDER BY idPa DESC
				LIMIT $startRow , $pageSize
				";
				$kq = mysql_query($sql) or die (mysql_error());
				$sql="SELECT count(*)
	    				FROM  pages
				";
			}
			$rs= mysql_query($sql) or die(mysql_error());;
			$row_rs = mysql_fetch_row($rs);
			$totalRows = $row_rs[0];
			return $kq;
		}
        public function ThemPA()
		{
            $TieuDe= $_POST['TieuDe'];
            $idGroup= $_POST['idGroup'];
			$NoiDung = $_POST['NoiDung'];
			$UrlHinh = $_POST['UrlHinh'];
			$TomTat = $_POST['TomTat'];
			$Title = $_POST['Title'];
			$Des = $_POST['Des'];
			$Keyword = $_POST['Keyword'];

			$TieuDe = parent::XoaDinhDang($TieuDe);
			$Title = parent::XoaDinhDang($Title);
			$Des = parent::XoaDinhDang($Des);
			$Keyword = parent::XoaDinhDang($Keyword);
			$TieuDeKD = parent::stripUnicode($TieuDe);
			//$UrlHinh = parent::stripUnicode($UrlHinh);

			$NgayDang = gmdate('Y/m/d H:i:s', time() + 7*3600);

			//Chèn dữ liệu vào database
			$sql="INSERT INTO pages (TieuDe, TieuDeKD, NoiDung, Des, idGroup, NgayDang, Title, Keyword,UrlHinh,TomTat)
				VALUES ('$TieuDe', '$TieuDeKD', '$NoiDung', '$Des', $idGroup , '$NgayDang', '$Title', '$Keyword', '$UrlHinh', '$TomTat')";
			mysql_query($sql) or die (mysql_error());
		}
        public function ChiTietPA($idSP){
			$sql = "SELECT * FROM pages WHERE idPa=$idSP";
			$kq = mysql_query($sql) or die (mysql_error());
			return $kq;
		}// xem chi tiết thể loại để chỉnh sữa
		public function SuaPA($idSP)
		{
            $TieuDe= $_POST['TieuDe'];
			$idGroup= $_POST['idGroup'];
			$NoiDung = $_POST['NoiDung'];
			$Title = $_POST['Title'];
			$UrlHinh = $_POST['UrlHinh'];
			$TomTat = $_POST['TomTat'];
			$Des = $_POST['Des'];
			$Keyword = $_POST['Keyword'];

			$TieuDe = parent::XoaDinhDang($TieuDe);
			$Title = parent::XoaDinhDang($Title);
			$Des = parent::XoaDinhDang($Des);
			$Keyword = parent::XoaDinhDang($Keyword);
			$TieuDeKD = parent::stripUnicode($TieuDe);
			//$UrlHinh = parent::stripUnicode($UrlHinh);

			$NgayDang = gmdate('Y/m/d H:i:s', time() + 7*3600);

			//Cập nhật vào db
			$sql="UPDATE pages
				SET TieuDe = '$TieuDe',
                    Title = '$Title',
                    Des = '$Des',
					idGroup = $idGroup,
					UrlHinh = '$UrlHinh',
					TomTat = '$TomTat',
                    Keyword = '$Keyword',
                    NoiDung = '$NoiDung',
                    NgayDang = '$NgayDang',
                    TieuDeKD = '$TieuDeKD'
                WHERE idPa = $idSP
                ";
			mysql_query($sql) or die(mysql_error());
		}
        public function XoaPA($idDM)
		{
			settype($idDM,"int");
			$sql="DELETE FROM pages WHERE idPa=$idDM";
			mysql_query($sql) or die(mysql_error());
		}

		//----------------- Thiết Bị -----------------------------//
        public function ListTB(&$totalRows, $pageNum, $pageSize, $TieuDe){
			$startRow = ($pageNum-1)*$pageSize;
			if ($TieuDe != ""){
				$sql="	SELECT idPa, TieuDe, TomTat, AnHien, UrlHinh
				FROM  pages
				WHERE TieuDe like '%$TieuDe%' AND idGroup=2
				ORDER BY idPa DESC
				LIMIT $startRow , $pageSize
				";
				$kq = mysql_query($sql) or die (mysql_error());
				$sql="SELECT count(*)
	    				FROM  pages
	    				WHERE TieuDe like '%$TieuDe%' AND idGroup=2
				";
			}else{
				$sql="	SELECT idPa, TieuDe, TomTat, AnHien, UrlHinh
				FROM  pages
				WHERE idGroup=2
				ORDER BY idPa DESC
				LIMIT $startRow , $pageSize
				";
				$kq = mysql_query($sql) or die (mysql_error());
				$sql="SELECT count(*)
	    				FROM  pages
	    				WHERE idGroup=2
				";
			}
			$rs= mysql_query($sql) or die(mysql_error());;
			$row_rs = mysql_fetch_row($rs);
			$totalRows = $row_rs[0];
			return $kq;
		}
        public function ThemTB()
		{
            $TieuDe= $_POST['TieuDe'];
			$NoiDung = $_POST['NoiDung'];
			$UrlHinh = $_POST['UrlHinh'];
			$TomTat = $_POST['TomTat'];
			$Title = $_POST['Title'];
			$Des = $_POST['Des'];
			$Keyword = $_POST['Keyword'];

			$TieuDe = parent::XoaDinhDang($TieuDe);
			$UrlHinh = parent::XoaDinhDang($UrlHinh);
			$Title = parent::XoaDinhDang($Title);
			$Des = parent::XoaDinhDang($Des);
			$Keyword = parent::XoaDinhDang($Keyword);
			$TieuDeKD = parent::stripUnicode($TieuDe);

			$NgayDang = gmdate('Y/m/d H:i:s', time() + 7*3600);

			//Chèn dữ liệu vào database
			$sql="INSERT INTO pages (TieuDe, TieuDeKD, NoiDung, Des, idGroup, NgayDang, Title, TomTat, UrlHinh, Keyword)
				VALUES ('$TieuDe', '$TieuDeKD', '$NoiDung', '$Des', '2', '$NgayDang', '$Title',  '$TomTat', '$UrlHinh', '$Keyword')";
			mysql_query($sql) or die (mysql_error());
		}
		public function SuaTB($idSP)
		{
            $TieuDe= $_POST['TieuDe'];
			$NoiDung = $_POST['NoiDung'];
			$UrlHinh = $_POST['UrlHinh'];
			$TomTat = $_POST['TomTat'];
			$Title = $_POST['Title'];
			$Des = $_POST['Des'];
			$Keyword = $_POST['Keyword'];

			$TieuDe = parent::XoaDinhDang($TieuDe);
			$UrlHinh = parent::XoaDinhDang($UrlHinh);
			$Title = parent::XoaDinhDang($Title);
			$Des = parent::XoaDinhDang($Des);
			$Keyword = parent::XoaDinhDang($Keyword);
			$TieuDeKD = parent::stripUnicode($TieuDe);

			$NgayDang = gmdate('Y/m/d H:i:s', time() + 7*3600);

			//Cập nhật vào db
			$sql="UPDATE pages
				SET TieuDe = '$TieuDe',
                    Title = '$Title',
                    Des = '$Des',
                    Keyword = '$Keyword',
                    NoiDung = '$NoiDung',
                    NgayDang = '$NgayDang',
                    UrlHinh = '$UrlHinh',
                    TomTat = '$TomTat',
                    TieuDeKD = '$TieuDeKD'
                WHERE idPa = $idSP
                ";
			mysql_query($sql) or die(mysql_error());
		}
		//----------------- Danh Mục -----------------------------//
        public function ListDM(&$totalRows, $pageNum, $pageSize, $TieuDe,$idCha=-1){
			$startRow = ($pageNum-1)*$pageSize;
			if ($TieuDe != ""){
				$sql="	SELECT idLoai, TieuDe, AnHien, Parent, Menu, Home, ThuTu
				FROM  loai
				WHERE ($idCha = -1 OR Parent = $idCha ) and TieuDe like '%$TieuDe%'
				ORDER BY idLoai DESC
				LIMIT $startRow , $pageSize
				";
				$kq = mysql_query($sql) or die (mysql_error());
				$sql="SELECT count(*)
	    				FROM  loai
	    				WHERE ($idCha = -1 OR Parent = $idCha ) and TieuDe like '%$TieuDe%'
				";
			}else{
				$sql="	SELECT idLoai, TieuDe, AnHien, Parent, Menu, Home, ThuTu
				FROM  loai
				WHERE ($idCha = -1 OR Parent = $idCha ) 
				ORDER BY idLoai DESC
				LIMIT $startRow , $pageSize
				";
				$kq = mysql_query($sql) or die (mysql_error());
				$sql="SELECT count(*)
	    				FROM  loai
						WHERE ($idCha = -1 OR Parent = $idCha ) 
				";
			}
			$rs= mysql_query($sql) or die(mysql_error());;
			$row_rs = mysql_fetch_row($rs);
			$totalRows = $row_rs[0];
			return $kq;
		}
        public function ThemDM()
		{
            $TieuDe= $_POST['TieuDe'];
            $UrlHinh= $_POST['UrlHinh'];
            $Title= $_POST['Title'];
            $Des= $_POST['Des'];
            $Parent= $_POST['Parent'];
            $Keyword= $_POST['Keyword'];
            $TomTat= $_POST['TomTat'];

            settype($Parent, "int");
            $TieuDe = parent::XoaDinhDang($TieuDe);
            $UrlHinh = parent::XoaDinhDang($UrlHinh);
            $Title = parent::XoaDinhDang($Title);
            $Keyword = parent::XoaDinhDang($Keyword);
            $Des = parent::XoaDinhDang($Des);
			$TieuDeKD = parent::stripUnicode($TieuDe);
			//Chèn dữ liệu vào database
			$sql="INSERT INTO loai (TieuDe, TieuDeKD, UrlHinh, Title, Des, Parent, Keyword, TomTat)
				VALUES ('$TieuDe', '$TieuDeKD', '$UrlHinh', '$Title', '$Des', '$Parent', '$Keyword', '$TomTat')";
			mysql_query($sql) or die (mysql_error());
		}
        public function ChiTietDM($idSP){
			$sql = "SELECT * FROM loai WHERE idLoai=$idSP";
			$kq = mysql_query($sql) or die (mysql_error());
			return $kq;
		}// xem chi tiết thể loại để chỉnh sữa
		public function SuaDM($idSP)
		{
            $TieuDe= $_POST['TieuDe'];
            $UrlHinh= $_POST['UrlHinh'];
            $Title= $_POST['Title'];
            $Des= $_POST['Des'];
            $Parent= $_POST['Parent'];
            $Keyword= $_POST['Keyword'];
            $TomTat= $_POST['TomTat'];

            settype($Parent, "int");
            $TieuDe = parent::XoaDinhDang($TieuDe);
            $UrlHinh = parent::XoaDinhDang($UrlHinh);
            $Title = parent::XoaDinhDang($Title);
            $Keyword = parent::XoaDinhDang($Keyword);
            $Des = parent::XoaDinhDang($Des);
			$TieuDeKD = parent::stripUnicode($TieuDe);
			//Cập nhật vào db
			$sql="UPDATE loai
				SET TieuDe = '$TieuDe',
					UrlHinh = '$UrlHinh',
					TomTat = '$TomTat',
					Title = '$Title',
					Des = '$Des',
					Parent = '$Parent',
					Keyword = '$Keyword',
                    TieuDeKD = '$TieuDeKD'
                WHERE idLoai = $idSP
                ";
			mysql_query($sql) or die(mysql_error());
		}
        public function XoaDM($idDM)
		{
			settype($idDM,"int");
			$sql="DELETE FROM loai WHERE idLoai=$idDM";
			mysql_query($sql) or die(mysql_error());
		}
		//---------------------------- Dang Ky Kham --------------------------------//

        public function ListDK(&$totalRows, $pageNum, $pageSize, $sdt, $IP){
			$startRow = ($pageNum-1)*$pageSize;
			if ($sdt != ""){
				$where = " and sdt like '%$sdt%' ";
			}
			if ($IP != ""){
				$where = " and IP like '%$IP%' ";
			}
				$sql="	SELECT *
				FROM  sodienthoai
				Where 1=1 {$where}
				ORDER BY id_sdt DESC
				LIMIT $startRow , $pageSize
				";
				$kq = mysql_query($sql) or die (mysql_error());
				$sql="SELECT count(*)
	    				FROM  sodienthoai
						Where 1=1 {$where} 
				";
			
			$rs= mysql_query($sql) or die(mysql_error());;
			$row_rs = mysql_fetch_row($rs);
			$totalRows = $row_rs[0];
			return $kq;
		}
		
		public function SuaDK($idSDT){
			
            $Ghichu = $_POST['Ghichu'];

			//chèn vào db
        	$sql="UPDATE sodienthoai
            SET Ghichu = '$Ghichu' 
            WHERE id_sdt = $idSDT
            ";
            mysql_query($sql) or die(mysql_error());
		}
		//---------------------------- Tin Tức --------------------------------//

        public function ListTT(&$totalRows, $pageNum, $pageSize, $TieuDe){
			$startRow = ($pageNum-1)*$pageSize;
			if ($TieuDe != ""){
				$sql="	SELECT idTT, TieuDe, TieuDeKD, TomTat, AnHien, UrlHinh
				FROM  tintuc
				WHERE TieuDe like '%$TieuDe%'
				ORDER BY idTT DESC
				LIMIT $startRow , $pageSize
				";
				$kq = mysql_query($sql) or die (mysql_error());
				$sql="SELECT count(*)
	    				FROM  tintuc
	    				WHERE TieuDe like '%$TieuDe%'
				";
			}else{
				$sql="	SELECT idTT, TieuDe, TieuDeKD, TomTat, AnHien, UrlHinh
				FROM  tintuc
				ORDER BY idTT DESC
				LIMIT $startRow , $pageSize
				";
				$kq = mysql_query($sql) or die (mysql_error());
				$sql="SELECT count(*)
	    				FROM  tintuc
				";
			}
			$rs= mysql_query($sql) or die(mysql_error());;
			$row_rs = mysql_fetch_row($rs);
			$totalRows = $row_rs[0];
			return $kq;
		}
		public function XoaTT($idSP){
			settype($idSP, "int");
			if ($idSP<=0) return;
			$sql="DELETE FROM tintuc WHERE idTT=$idSP";
			mysql_query($sql) or die(mysql_error());
		}
				
		public function Preview(){
			//Tiếp nhận dữ liệu từ form
			$UrlHinh = $_POST['UrlHinh'];
			$TieuDe = $_POST['TieuDe'];
            $Des = $_POST['Des'];
            $Keyword = $_POST['Keyword'];
            $Title = $_POST['Title'];
            $NoiDung = $_POST['NoiDung'];
            $TomTat = $_POST['TomTat'];
            $idLoai = $_POST['idLoai'];
            $idCL = $_POST['idCL'];


			//Kiểm tra dữ liệu đã nhận
			settype($idLoai,"int");
            settype($idCL,"int");
            $UrlHinh = parent::XoaDinhDang($UrlHinh);
            $TieuDe = parent::XoaDinhDang($TieuDe);
            $Des = parent::XoaDinhDang($Des);
            $Keyword = parent::XoaDinhDang($Keyword);
            $Title = parent::XoaDinhDang($Title);
            $TieuDe1 = str_replace('-', '', $TieuDe);
            $TieuDe1 = str_replace(':', '', $TieuDe1);
            $TieuDe1 = str_replace('|', '', $TieuDe1);
			$TieuDeKD = parent::stripUnicode($TieuDe1);
			$TieuDeKD = $TieuDeKD."-1";
			$NgayDang = gmdate('Y/m/d H:i:s', time() + 7*3600);

			//chèn vào db
        	$sql="UPDATE tintuc
            SET TieuDe = '$TieuDe',
                UrlHinh = '$UrlHinh',
                Des = '$Des',
                Keyword = '$Keyword',
                Title = '$Title',
                TomTat = '$TomTat',
                NoiDung = '$NoiDung',
                idLoai = $idLoai,
                idCL = $idCL,
                NgayDang = '$NgayDang'
           		WHERE idTT = 1
            ";
            mysql_query($sql) or die(mysql_error());
		}
		
		public function ThemTT(){
			//Tiếp nhận dữ liệu từ form
			$UrlHinh = $_POST['UrlHinh'];
			$TieuDe = $_POST['TieuDe'];
            $Des = $_POST['Des'];
            $Keyword = $_POST['Keyword'];
            $Tags = $_POST['Tags'];
            $Title = $_POST['Title'];
            $NoiDung = $_POST['NoiDung'];
            $TomTat = $_POST['TomTat'];
            $idLoai = $_POST['idLoai'];
            $idCL = $_POST['idCL'];
            $idCon = $_POST['idCon'];


			//Kiểm tra dữ liệu đã nhận
			settype($idLoai,"int");
            settype($idCL,"int");
            settype($idCon,"int");
            $UrlHinh = parent::XoaDinhDang($UrlHinh);
            $TieuDe = parent::XoaDinhDang($TieuDe);
            $Des = parent::XoaDinhDang($Des);
            $Keyword = parent::XoaDinhDang($Keyword);
            $Tags = parent::XoaDinhDang($Tags);
            $Title = parent::XoaDinhDang($Title);
            $TieuDe1 = str_replace('-', '', $TieuDe);
            $TieuDe1 = str_replace(':', '', $TieuDe1);
            $TieuDe1 = str_replace('|', '', $TieuDe1);
			$TieuDeKD = parent::stripUnicode($TieuDe1);
			$NgayDang = gmdate('Y/m/d H:i:s', time() + 7*3600);


			//chèn vào db
			$sql="INSERT INTO   tintuc (idLoai, idCL, idCon, TieuDe, TieuDeKD, TomTat, NoiDung, Title, Keyword,Tags, Des, UrlHinh, NgayDang)
			  		VALUES ($idLoai, $idCL, $idCon, '$TieuDe', '$TieuDeKD', '$TomTat', '$NoiDung', '$Title', '$Keyword','$Tags', '$Des', '$UrlHinh', '$NgayDang')";
			mysql_query($sql) or die(mysql_error());
			$idTT = mysql_insert_id();
			$TieuDeKD = $TieuDeKD."-".$idTT;
			$sql="UPDATE tintuc
            SET TieuDeKD = '$TieuDeKD'
            WHERE idTT = $idTT
            ";
            mysql_query($sql) or die(mysql_error());
		}
        public function ChiTietTT($idSP){
			$sql = "SELECT * FROM tintuc WHERE idTT=$idSP";
			$kq = mysql_query($sql) or die (mysql_error());
			return $kq;
		}// xem chi tiết thể loại để chỉnh sữa
        public function SuaTT($idSP){
			//Tiếp nhận dữ liệu từ form
			$UrlHinh = $_POST['UrlHinh'];
			$TieuDe = $_POST['TieuDe'];
            $Des = $_POST['Des'];
            $Keyword = $_POST['Keyword'];
            $Tags = $_POST['Tags'];
            $Title = $_POST['Title'];
            $NoiDung = $_POST['NoiDung'];
            $TomTat = $_POST['TomTat'];
            $idLoai = $_POST['idLoai'];
            $idCL = $_POST['idCL'];
			$idCon = $_POST['idCon'];


			//Kiểm tra dữ liệu đã nhận
			settype($idLoai,"int");
            settype($idCL,"int");
            settype($idCon,"int");
            $UrlHinh = parent::XoaDinhDang($UrlHinh);
            $TieuDe = parent::XoaDinhDang($TieuDe);
            $Des = parent::XoaDinhDang($Des);
            $Keyword = parent::XoaDinhDang($Keyword);
            $Tags = parent::XoaDinhDang($Tags);
            $Title = parent::XoaDinhDang($Title);
            $TieuDe1 = str_replace('-', '', $TieuDe);
            $TieuDe1 = str_replace(':', '', $TieuDe1);
            $TieuDe1 = str_replace('|', '', $TieuDe1);
			$TieuDeKD = parent::stripUnicode($TieuDe1);
			$TieuDeKD = $TieuDeKD."-".$idSP;
			$NgayDang = gmdate('Y/m/d H:i:s', time() + 7*3600);

			//chèn vào db
        	$sql="UPDATE tintuc
            SET TieuDe = '$TieuDe',
            	TieuDeKD = '$TieuDeKD',
                UrlHinh = '$UrlHinh',
                Des = '$Des',
                Keyword = '$Keyword',
                Tags = '$Tags',
                Title = '$Title',
                TomTat = '$TomTat',
                NoiDung = '$NoiDung',
                idLoai = $idLoai,
                idCL = $idCL,
				idCon = $idCon
            WHERE idTT = $idSP
            ";
            mysql_query($sql) or die(mysql_error());
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
        public function ChiTietTK($idSP){
			$sql = "SELECT * FROM users WHERE idUser=$idSP";
			$kq = mysql_query($sql) or die (mysql_error());
			return $kq;
		}// xem chi tiết thể loại để chỉnh sữa
		public function SuaTKMK($idSP)
		{
            $Pass = $_POST['Pass'];
			$Pass = parent::XoaDinhDang($Pass);
			$Pass = md5($Pass);

			$sql="UPDATE users
				SET Pass = '$Pass'
                WHERE idUser = $idSP
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
		//----------------- Slider -----------------------------//
        public function ListSL(&$totalRows, $pageNum, $pageSize, $TieuDe){
			$startRow = ($pageNum-1)*$pageSize;
			if ($TieuDe != ""){
				$sql="	SELECT idSlider, TieuDe, UrlHinh, AnHien, ThuTu
				FROM  quangcao
				WHERE TieuDe like '%$TieuDe%'
				ORDER BY idSlider DESC
				LIMIT $startRow , $pageSize
				";
				$kq = mysql_query($sql) or die (mysql_error());
				$sql="SELECT count(*)
	    				FROM  quangcao
	    				WHERE TieuDe like '%$TieuDe%'
				";
			}else{
				$sql="	SELECT idSlider, TieuDe, UrlHinh, AnHien, ThuTu
				FROM  quangcao
				ORDER BY idSlider DESC
				LIMIT $startRow , $pageSize
				";
				$kq = mysql_query($sql) or die (mysql_error());
				$sql="SELECT count(*)
	    				FROM  quangcao
				";
			}
			$rs= mysql_query($sql) or die(mysql_error());;
			$row_rs = mysql_fetch_row($rs);
			$totalRows = $row_rs[0];
			return $kq;
		}
        public function ThemSL()
		{
            $TieuDe= $_POST['TieuDe'];
            $UrlHinh = $_POST['UrlHinh'];
            $Link = $_POST['Link'];
			$idLoai = $_POST['idLoai'];

            $TieuDe = parent::XoaDinhDang($TieuDe);
			$UrlHinh = parent::XoaDinhDang($UrlHinh);
			$Link = parent::XoaDinhDang($Link);
			$TieuDeKD = parent::stripUnicode($TieuDe);

			//Chèn dữ liệu vào database
			$sql="INSERT INTO quangcao (TieuDe, Link, UrlHinh, TieuDeKD,idLoai)
				VALUES ('$TieuDe', '$Link', '$UrlHinh', '$TieuDeKD','$idLoai')";
			mysql_query($sql) or die (mysql_error());
		}
        public function ChiTietSL($idSP){
			$sql = "SELECT * FROM quangcao WHERE idSlider=$idSP";
			$kq = mysql_query($sql) or die (mysql_error());
			return $kq;
		}// xem chi tiết thể loại để chỉnh sữa
		public function SuaSL($idSP)
		{
            $TieuDe= $_POST['TieuDe'];
            $UrlHinh = $_POST['UrlHinh'];
            $Link = $_POST['Link'];
			$idLoai = $_POST['idLoai'];

            $TieuDe = parent::XoaDinhDang($TieuDe);
			$UrlHinh = parent::XoaDinhDang($UrlHinh);
			$Link = parent::XoaDinhDang($Link);
			$TieuDeKD = parent::stripUnicode($TieuDe);

			//Cập nhật vào db
			$sql="UPDATE quangcao
				SET TieuDe = '$TieuDe',
                    UrlHinh = '$UrlHinh',
                    TieuDeKD = '$TieuDeKD',
                    Link = '$Link',
					idLoai = '$idLoai'
                WHERE idSlider = $idSP
                ";
			mysql_query($sql) or die(mysql_error());
		}
        public function XoaSL($idDM)
		{
			settype($idDM,"int");
			$sql="DELETE FROM quangcao WHERE idSlider =$idDM";
			mysql_query($sql) or die(mysql_error());
		}
		//-----------------------------An Hien ---------------------//
		public function LayAnHien($bang, $ma, $id){
			$sql="SELECT AnHien FROM $bang WHERE $ma = '$id'";
			$kq = mysql_query($sql,$this->conn);
			$row_trang = mysql_fetch_assoc($kq);
	        return $row_trang['AnHien'];
		}
		public function DoiAnHien($bang, $ma, $id, $AnHien){
			$sql="UPDATE $bang
				SET AnHien = '$AnHien'
                WHERE $ma = $id
                ";
			mysql_query($sql) or die(mysql_error());
		}
		//----------------------------- Menu ---------------------//
		public function LayMenu($bang, $ma, $id){
			$sql="SELECT Menu FROM $bang WHERE $ma = '$id'";
			$kq = mysql_query($sql,$this->conn);
			$row_trang = mysql_fetch_assoc($kq);
	        return $row_trang['Menu'];
		}
		public function DoiMenu($bang, $ma, $id, $doi){
			$sql="UPDATE $bang
				SET Menu = '$doi'
                WHERE $ma = $id
                ";
			mysql_query($sql) or die(mysql_error());
		}
		// --------------------------- câu hỏi ---------------------------//
        //Quản Lý câu hỏi
		public function ListCauHoi(&$totalRows, $pageNum, $pageSize)
		{				
            $startRow = ($pageNum-1)*$pageSize;
			$sql="	SELECT *
				FROM  cauhoi
				ORDER BY idCH DESC 
				LIMIT $startRow , $pageSize
				";
			$kq = mysql_query($sql) or die (mysql_error());	
			$sql="SELECT count(*)
				FROM  cauhoi
				";
			$rs= mysql_query($sql) or die(mysql_error());;
			$row_rs = mysql_fetch_row($rs);
			$totalRows = $row_rs[0];
			return $kq;
		}
        public function XoaCauHoi($idSP){
			settype($idSP, "int");
			if ($idSP<=0) return; 
			$sql="DELETE FROM cauhoi WHERE idCH=$idSP";
			mysql_query($sql) or die(mysql_error());		
		}
		public function ThemCauHoi(){
			$idLoai = $_POST["idLoai"];
			$Noidungcauhoi = $_POST["Noidungcauhoi"]; 
			$Noidungtraloi = $_POST["Noidungtraloi"]; 
			$sql="INSERT INTO `cauhoi` (`idCL`, `TieuDeCH`, `TieuDeCHKD`, `KeywordCH`, `DescriptionCH`, `HoTen`, `Email`, `DienThoai`, `NoiDungCH`, `AnHien`, `NgayTao`, `TongTL`) VALUES ('$idLoai', '', '', '', '', '', '', '', '$Noidungcauhoi', '0', '', '0');";
			mysql_query($sql) or die(mysql_error());
			
			$idCH = mysql_insert_id();		
			$sql="INSERT INTO  `traloi` (`idCH` ,`NoiDungTL` ,`AnHien`)VALUES ('$idCH',  '$Noidungtraloi',  '0');";
			mysql_query($sql) or die(mysql_error());
		}
        public function ChiTietCauHoi($idDH)
		{	
			$sql="SELECT *
				   FROM cauhoi
				   WHERE idCH = $idDH
				   ";
			$kq = mysql_query($sql) or die (mysql_error());
			return $kq;
		}
        public function CapNhatCauHoi($idSP){
			//Tiếp nhận dữ liệu từ form	
			
			$TieuDeCH = $_POST['TieuDeCH'];         
            $NoiDungCH = $_POST['NoiDungCH'];
            $KeywordCH = $_POST['KeywordCH'];
            $AnHien = $_POST['AnHien'];
            $idCL = $_POST['idCL'];			
			
			//Kiểm tra dữ liệu đã nhận
			settype($AnHien,"int");
            settype($idCL,"int");
			
			$TieuDeCH = trim(strip_tags($TieuDeCH));
            $KeywordCH = trim(strip_tags($KeywordCH));
            $DescriptionCH = trim(strip_tags($NoiDungCH));
			
			if (get_magic_quotes_gpc()== false) {				
				$TieuDeCH = mysql_real_escape_string($TieuDeCH);
                $KeywordCH = mysql_real_escape_string($KeywordCH);
                $DescriptionCH = mysql_real_escape_string($DescriptionCH);
			}
			
            $TieuDeCHKD = parent::stripUnicode($TieuDeCH);
			$DescriptionCH = parent::RutGon($DescriptionCH,100,150);
            
			//chèn vào db
        	$sql="UPDATE cauhoi
            SET TieuDeCH = '$TieuDeCH', 
                NoiDungCH = '$NoiDungCH',                
                DescriptionCH = '$DescriptionCH', 
                TieuDeCHKD = '$TieuDeCHKD', 
                KeywordCH = '$KeywordCH',
                AnHien = $AnHien,
                idCL = $idCL
            WHERE idCH = $idSP
            ";		
            mysql_query($sql) or die(mysql_error());	
		}
        
        // --------------------------- trả lời câu hỏi ---------------------------//
        //Quản Lý Khám  Bệnh
		public function ListTraLoi($idCH)
		{	
			$sql="SELECT *
				   FROM traloi WHERE idCH = $idCH
                   ORDER BY idTL desc
                   ";
			$kq = mysql_query($sql) or die (mysql_error());
			return $kq;
		}
        
        public function XoaTraLoi($idSP){
			settype($idSP, "int");
			if ($idSP<=0) return; 
			$sql="DELETE FROM traloi WHERE idTL=$idSP";
			mysql_query($sql) or die(mysql_error());		
		}
        public function ChiTietTraLoi($idDH)
		{	
			$sql="SELECT *
				   FROM traloi
				   WHERE idTL = $idDH
				   ";
			$kq = mysql_query($sql) or die (mysql_error());
			return $kq;
		}
        
        public function CapNhatTraLoi($idSP){
			//Tiếp nhận dữ liệu từ form	
			
			$NoiDungTL = $_POST['NoiDungTL'];  
            $AnHien = $_POST['AnHien'];
			
			//Kiểm tra dữ liệu đã nhận
			settype($AnHien,"int");
			
			
			
            
			//chèn vào db
        	$sql="UPDATE traloi
            SET NoiDungTL = '$NoiDungTL',  
                AnHien = $AnHien
            WHERE idTL = $idSP
            ";		
            mysql_query($sql) or die(mysql_error());	
		}
		//----------------- Option -----------------------------//
        public function ListOP(&$totalRows, $pageNum, $pageSize, $TieuDe){
			$startRow = ($pageNum-1)*$pageSize;
			if ($TieuDe != ""){
				echo $sql="	SELECT idOp, NameOp, ValueOp
				FROM  option
				WHERE NameOp like '%$TieuDe%'
				ORDER BY idOp
				LIMIT $startRow , $pageSize
				";
				$kq = mysql_query($sql) or die (mysql_error());
				$sql="SELECT count(*)
	    				FROM  option
	    				WHERE NameOp like '%$TieuDe%'
				";
			}else{
				echo $sql="	SELECT idOp, NameOp, ValueOp
				FROM  option
				ORDER BY idOp
				LIMIT $startRow , $pageSize
				";
				$kq = mysql_query($sql) or die (mysql_error());
				$sql="SELECT count(*)
	    				FROM  option
				";
			}
			$rs= mysql_query($sql) or die(mysql_error());;
			$row_rs = mysql_fetch_row($rs);
			$totalRows = $row_rs[0];
			return $kq;
		}
		public function SuaOP($id, $doi){
			$sql="UPDATE option
				SET ValueOp = '$doi'
                WHERE idOp = $id
                ";
			mysql_query($sql) or die(mysql_error());
		}
		//----------------------------- Home ---------------------//
		public function LayHome($bang, $ma, $id){
			$sql="SELECT Home FROM $bang WHERE $ma = '$id'";
			$kq = mysql_query($sql,$this->conn);
			$row_trang = mysql_fetch_assoc($kq);
	        return $row_trang['Home'];
		}
		public function DoiHome($bang, $ma, $id, $doi){
			$sql="UPDATE $bang
				SET Home = '$doi'
                WHERE $ma = $id
                ";
			mysql_query($sql) or die(mysql_error());
		}
		public function SuaThuTu($bang, $ma, $id, $doi){
			$sql="UPDATE $bang
				SET ThuTu = '$doi'
                WHERE $ma = $id
                ";
			mysql_query($sql) or die(mysql_error());
		}
		public function LayTenDM($idLoai){
			$sql="SELECT TieuDe FROM loai WHERE idLoai = '$idLoai'";
			$kq = mysql_query($sql,$this->conn);
			$row_trang = mysql_fetch_assoc($kq);
	        return $row_trang['TieuDe'];
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
		public function TongDM(){
			$sql="SELECT count(*) as Tong FROM loai";
			$kq = mysql_query($sql,$this->conn);
			$row_trang = mysql_fetch_assoc($kq);
	        return $row_trang['Tong'];
		}
		public function TongCH(){
			$sql="SELECT count(*) as Tong FROM cauhoi";
			$kq = mysql_query($sql,$this->conn);
			$row_trang = mysql_fetch_assoc($kq);
	        return $row_trang['Tong'];
		}
		public function TongSL(){
			$sql="SELECT count(*) as Tong FROM quangcao";
			$kq = mysql_query($sql,$this->conn);
			$row_trang = mysql_fetch_assoc($kq);
	        return $row_trang['Tong'];
		}
		public function TongTK(){
			$sql="SELECT count(*) as Tong FROM users";
			$kq = mysql_query($sql,$this->conn);
			$row_trang = mysql_fetch_assoc($kq);
	        return $row_trang['Tong'];
		}
		public function ListGY(&$totalRows, $pageNum, $pageSize, $sdt, $IP){
			$startRow = ($pageNum-1)*$pageSize;
			if ($sdt != ""){
				$where = " and SDT like '%$sdt%' ";
			}
			if ($IP != ""){
				$where = " and IP like '%$IP%' ";
			}
				$sql="	SELECT *
				FROM  gopy
				Where 1=1 {$where}
				ORDER BY idGY DESC
				LIMIT $startRow , $pageSize
				";
				$kq = mysql_query($sql) or die (mysql_error());
				$sql="SELECT count(*)
	    				FROM  gopy
						Where 1=1 {$where} 
				";
			
			$rs= mysql_query($sql) or die(mysql_error());;
			$row_rs = mysql_fetch_row($rs);
			$totalRows = $row_rs[0];
			return $kq;
		}
	}
?>
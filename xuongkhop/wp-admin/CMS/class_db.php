<?php
class db {
	public $conn = NULL;
	public $result = NULL;
	public $host="localhost";
	public $user="admin_cms_yhct";
	public $pass="nhocmiss@2";
	public $database="admin_cms_yhct";
	function __construct(){
		$this->conn = mysql_connect($this->host, $this->user, $this->pass);
		mysql_select_db($this -> database, $this->conn);
		mysql_query("set names 'utf8'");
	}
	function getdata($sql) {
		if (is_resource($this->conn)) {
		   if (is_resource($this->result)) mysql_free_result($this->result);
		   $this->result = mysql_query( $sql, $this->conn  );
		}
	}
	function fetchRow() {
		if (is_resource($this->result)) {
		   $row = mysql_fetch_assoc($this->result);
		   if (is_array($row))  return $row;
		}
		return FALSE;
	}

	public function DanhMuc($idLoai, $Parent){
		$sql="SELECT * FROM loai WHERE (idLoai = $idLoai or $idLoai = -1) and (Parent = $Parent or $Parent = -1) and AnHien=1
			";
		$kq = mysql_query($sql,$this->conn);
        return $kq;
	}
	function pagesLink($totalRows, $pageNum=1, $pageSize=5){
		$baseURL = $_SERVER['PHP_SELF'];
		parse_str($_SERVER['QUERY_STRING'],$arr);
		unset($arr['pageNum']);
		$str="";
		foreach($arr as $k=> $v) $str.= "&{$k}={$v}";
		$baseURL .="?".$str;

		if ($totalRows<=0) return "";
		$totalPages = ceil($totalRows/$pageSize);
		if ($totalPages<=1) return "";

		$firstLink="";  $prevLink="";  $lastLink="";  $nextLink="";

		if ($pageNum > 1) {
			$firstLink = "<a href='$baseURL'>Trang đầu</a>";
			$prevPage = $pageNum - 1;
			$prevLink="<a href='$baseURL&pageNum=$prevPage'>Trang trước</a>";
		}
		if ($pageNum < $totalPages) {
			$lastLink = "<a href='$baseURL&pageNum=$totalPages'>Trangcuối</a>";
			$nextPage = $pageNum + 1;
			$nextLink = "<a href='$baseURL&pageNum=$nextPage'>Trang kế</a>";
		}
		return $firstLink.$prevLink.$nextLink.$lastLink;
	}//PagesLink

	function pagesList($totalRows , $pageNum=1, $pageSize = 5, $offset = 5){
		$baseURL = $_SERVER['PHP_SELF'];
		parse_str($_SERVER['QUERY_STRING'],$arr);
		unset($arr['pageNum']);
		foreach($arr as $k=> $v) $str.= "&{$k}={$v}";
		$baseURL .="?".$str;

		if ($totalRows<=0) return "";
		$totalPages = ceil($totalRows/$pageSize);
		if ($totalPages<=1) return "";

		$firstLink="";  $prevLink="";  $lastLink="";  $nextLink="";

		if ($pageNum > 1) {
			$firstLink = "<a href='$baseURL'><img src='img/phantrang_first.png' width=16px height=16px /></a>";
			$prevPage = $pageNum - 1;
			$prevLink="<a href='$baseURL&pageNum=$prevPage'><img src='img/phantrang_previous.png' width=16px height=16px /></a>";
		}

		$from = $pageNum - $offset;
		$to = $pageNum + $offset;
		if ($from <=0) { $from = 1;   $to = $offset*2; }
		if ($to > $totalPages) { $to = $totalPages; }
		$links = "";
		for($j = $from; $j <= $to; $j++) {
			{
				if ($j==$pageNum)
					$links= $links . "<span class='phan_trang'>$j</span>";
				else
					$links= $links . "<a class='trang' href = '$baseURL&pageNum=$j'>$j</a>";
			}

		} //for
		if ($pageNum < $totalPages) {
			$lastLink = "<a href='$baseURL&pageNum=$totalPages'><img src='img/phantrang_last.png' width=16px height=16px /></a>";
			$nextPage = $pageNum + 1;
			$nextLink = "<a href='$baseURL&pageNum=$nextPage'><img src='img/phantrang_next.png' width=16px height=16px /></a>";
		}

		return $firstLink.$prevLink.$links.$nextLink.$lastLink;
	} // function pagesList

	function pagesList1($baseURL, $totalRows , $pageNum=1, $pageSize = 5, $offset = 5){
		if ($totalRows<=0) return "";
		$totalPages = ceil($totalRows/$pageSize);
		if ($totalPages<=1) return "";

		$firstLink="";  $prevLink="";  $lastLink="";  $nextLink="";

		if ($pageNum > 1) {
			$firstLink = "<a class='phantrang_hinh' href='$baseURL/'><img src='img/phantrang_first.png' width=16px height=16px /></a>";
			$prevPage = $pageNum - 1;
			$prevLink="<a class='phantrang_hinh' href='$baseURL/page-$prevPage.html'><img src='img/phantrang_previous.png' width=16px height=16px /></a>";
		}


		$from = $pageNum - $offset;
		$to = $pageNum + $offset;
		if ($from <=0) { $from = 1;   $to = $offset*2; }
		if ($to > $totalPages) { $to = $totalPages; }
		$links = "";
		for($j = $from; $j <= $to; $j++) {
			{
				if ($j==$pageNum)
					$links= $links . "<span class='phan_trang'>$j</span>";
				else{
					if ($j == 1)
						$links= $links . "<a href = '$baseURL/'>$j</a>";
					else
						$links= $links . "<a href = '$baseURL/page-$j.html'>$j</a>";
				}
					
			}
		} //for
		if ($pageNum < $totalPages) {
			$lastLink = "<a class='phantrang_hinh' href='$baseURL/page-$totalPages.html'><img src='img/phantrang_last.png' width=16px height=16px /></a>";
			$nextPage = $pageNum + 1;
			$nextLink = "<a class='phantrang_hinh' href='$baseURL/page-$nextPage.html'><img src='img/phantrang_next.png' width=16px height=16px /></a>";
		}
		return $firstLink.$prevLink.$links.$nextLink.$lastLink;
	} // function pagesList1
	function smtpmailer($to, $from, $from_name, $subject, $body, $username, $password) {
		   require_once "phpmailer_v5.1/class.phpmailer.php";
		   require_once "phpmailer_v5.1/class.smtp.php";
		   require_once "phpmailer_v5.1/class.pop3.php";
		   global $error;
		   $mail = new PHPMailer();  // create a new object
		   $mail->IsSMTP(); // enable SMTP
		   $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
		   $mail->SMTPAuth = true;  // authentication enabled
		   $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
		   $mail->Host = 'smtp.gmail.com';
		   $mail->Port = 465;
		   $mail->Username = $username;
		   $mail->Password = $password;
		   $mail->SetFrom($from, $from_name);
		   $mail->Subject = $subject;
		   $mail->Body = $body;
		   $mail->AddAddress($to);
		   $mail->CharSet="utf-8";
		   $mail->IsHTML(true);
		   if(!$mail->Send()) {
			   $error = 'Mail error: '.$mail->ErrorInfo;
			   return false;
		   } else {
			   $error = 'Đã gửi thư';
			   return true;
		   }
	}//function

	function ChuoiNgauNhien($sokytu){
			$chuoi="ABCDEFGHIJKLMNOPQRSTUVWXYZWabcdefghijklmnopqrstuvwxyzw0123456789";
			for ($i=0; $i < $sokytu; $i++){
				$vitri = mt_rand( 0 ,strlen($chuoi) );
				$giatri= $giatri . substr($chuoi,$vitri,1 );
			}
			return $giatri;
	}
	function stripUnicode($str)
		{
            $str = str_replace(array(',', '<', '>', '&', '{', '}', '*', '?', '/', '"'), array(' '), $str);
			$str = mb_convert_case($str, MB_CASE_LOWER, "UTF-8");
			if(!$str) return false;
			$unicode = array
			(
			 'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
			 'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
			 'd'=>'đ',
			 'D'=>'Đ',
			 'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
			 'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
			 'i'=>'í|ì|ỉ|ĩ|ị',
			 'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
			 'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
			 'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
			 'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
			 'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
			 'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
			 'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
			);

			foreach($unicode as $khongdau=>$codau)
			{
			  $arr = explode("|",$codau);
			  $str = str_replace($arr,$khongdau,$str);
              $str = trim(strip_tags($str));
              if (get_magic_quotes_gpc()== false) {
               	$str = mysql_real_escape_string($str);
              }
              $str = preg_replace('/\s+/',' ',$str);
			  $str = str_replace(" ","-",$str);
			}
			return $str;
		}
	function XoaDinhDang ($chuoi){
		$str = trim(strip_tags($chuoi));		
	    if (get_magic_quotes_gpc()== false) {
	    	$str = mysql_real_escape_string($str);
	    }
	    return $str;
	}
    function RutGon($ChuoiGoc, $CountCut, $SoKyTyCat){
        if(strlen($ChuoiGoc) > $CountCut) {
            $cOutput = mb_substr($ChuoiGoc, 0, $SoKyTyCat, "UTF-8");
            while(substr($cOutput, -1) != " ") {
                $cOutput = substr($cOutput, 0, strlen($cOutput)-1);
            } $cOutput = $cOutput."...";
        }
        else{
           $cOutput = $ChuoiGoc;
        }
        return $cOutput;
    }
	function XoaDauNgang($tenhinh){
        $tenhinh[0] = mb_strtoupper($tenhinh[0]);
        $chuoi = str_replace("-"," ",$tenhinh);
        return $chuoi;
	}
	function getCurrentPageURL() {
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
} //class db
?>
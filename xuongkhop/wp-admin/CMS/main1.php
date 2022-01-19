<?php
	ob_start();
	date_default_timezone_set("Asia/Bangkok");
	require_once("checklogin.php");
	$p = $_GET['p'];
?>
<style>
<?php
if($_SESSION['tg_login_level']==0){
	?>
    .col_den{}
	.col_dieutri{display:none;}
	.col_diachi{display:none}
	.col_ngaydathen{}
	.col_bskham{display:none;}
	.col_benhthucte{display:none;}
	.search_ngaykham{}
	.trichxuat{display:none;}
    <?php
}
elseif($_SESSION['tg_login_level']==1){
	?>
    .col_den{}
	.col_diachi{display:none;}
	.col_ngaydathen{}
	.col_dieutri{}
    <?php	
}
elseif($_SESSION['tg_login_level']==2){
	?>
    .col_den{}
	.col_diachi{display:none;}
	.col_ngaydathen{display:none}
	.col_dieutri{display:none;}
    <?php
}
elseif($_SESSION['tg_login_level']==3){
	?>
    .col_den{display:none}
	.col_diachi{display:none;}
	.col_dieutri{display:none;}
    <?php
}
?>
</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ProAdmin</title>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<link rel="stylesheet" href="css/accordionmenu.css" type="text/css" media="screen" />
<link href="css/styles.css" rel="stylesheet" type="text/css" />

<script>
	$(document).ready(function() 
	{	
		setTimeout(hieuchinh,500);		
	});
	
	function hieuchinh()
	{
		var h1 = $("#leftcolumn").height();
		var h2 = $("#content").height();
		var m = h1;
		if (h2 > h1) m = h2;
		$("#leftcolumn").height(m+41);
		$("#content").height(m);
		
	}
</script>

</head>
<body>

<!--// Horisontal submenu edit starts -->
<div style="float:left;color:white;position:absolute;
	height:26px;
	z-index:5;
	left: 10px;
	top: 77px;
	right:0px;
"> 
  <a style="color:white" href="javascript:history.go(-1)"><img style="vertical-align:text-bottom" src="images/goback.png" width="18" height="17" /> Trở Về</a> &nbsp; <a style="color:white" href="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"><img  style="vertical-align:text-bottom" src="images/refresh.png" width="18" height="17" /> Làm mới</a>
  
&nbsp; <a style="color:white" target="_blank" href="https://www.google.com/maps/dir//Ph%C3%B2ng+Kh%C3%A1m+%C4%90a+Khoa+Th%E1%BA%BF+Gi%E1%BB%9Bi,+648+V%C3%B5+V%C4%83n+Ki%E1%BB%87t,+ph%C6%B0%E1%BB%9Dng+1,+H%E1%BB%93+Ch%C3%AD+Minh,+700000/@10.751934,106.684881,17z/data=!4m13!1m4!3m3!1s0x31752f03fb522c23:0x11dcb2769653d036!2zUGjDsm5nIEtow6FtIMSQYSBLaG9hIFRo4bq_IEdp4bubaQ!3b1!4m7!1m0!1m5!1m1!1s0x31752f03fb522c23:0x11dcb2769653d036!2m2!1d106.684881!2d10.751934"><img  style="vertical-align:text-bottom" src="images/chiduong.png" width="18" height="17" /> Chỉ đường</a>  
</div>
<div class="bodytext" id="submenu"> 
  <marquee style="color:#FFF" scrolldelay="200">Chúc mấy pé một ngày làm việc vui vẻ. ♫ ♫ ♫ ♫ ♫ ♫ ♫ ♫ ♫ ♫ ♫ ♫ ♫ ♫ ♫ ♫ ♫  </marquee>
</div>

<!--// Horisontal submenu edit ends -->
<!--// Logo edit starts -->

<div id="logo">
  <div align="center">
    <img src="images/logo.png" alt="logo" style="  width: 220px;  margin-top: 5px;" />
  </div>
</div>

<!--// logo edit ends -->
<!--// Arrows edit starts -->

<script type="text/javascript">
$(document).ready(function() {
// Create two variable with the names of the months and days in an array
var monthNames = [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12" ]; 
var dayNames= ["Chủ nhật","Thứ hai","Thứ ba","Thứ tư","Thứ năm","Thứ sáu","Thứ bảy"]

// Create a newDate() object
var newDate = new Date();
// Extract the current date from Date object
newDate.setDate(newDate.getDate());
// Output the day, date, month and year    
$('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

setInterval( function() {
	// Create a newDate() object and extract the seconds of the current time on the visitor's
	var seconds = new Date().getSeconds();
	// Add a leading zero to seconds value
	$("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
	},1000);
	
setInterval( function() {
	// Create a newDate() object and extract the minutes of the current time on the visitor's
	var minutes = new Date().getMinutes();
	// Add a leading zero to the minutes value
	$("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
    },1000);
	
setInterval( function() {
	// Create a newDate() object and extract the hours of the current time on the visitor's
	var hours = new Date().getHours();
	// Add a leading zero to the hours value
	$("#hours").html(( hours < 10 ? "0" : "" ) + hours);
    }, 1000);
	
}); 
</script>
<div class="clock">
<div id="Date"></div>

<ul>
	<li id="hours"> </li>
    <li id="point">:</li>
    <li id="min"> </li>
    <li id="point">:</li>
    <li id="sec"> </li>
</ul>

</div>


<div class="bodytext" id="hello">
<div style="float:left">
Chào Bác Sĩ : <span style="color:#39F;font-size:18px"><?=$_SESSION['tg_login_user']?>  </span>
  <br />
    
    <a href="main.php?p=tk_doi">Đổi Mật Khẩu</a> | <a href="thoat.php">Thoát</a>
</div>
<div style="float:right;width:63px;margin-right:10px;">
 <img src="images/<?=$_SESSION['tg_login_user']?>.jpg" alt="user_icon" width="60" height="60" border="0" style="border-radius:36px;" />
</div>
</div>
<!--// arrows edit ends -->



<div style="display: none;" class="bodytext" id="dropdown">

		
	 
<div class="clear"> </div>
</div>
<div id="content"> 
<?php 
					switch ($p)
						{	
							case "dk_xem":
								include "dk_xem.php";
								break;
														
							case "pa_xem":
								include "pa_xem.php";
								break;
							case "pa_chinh":
								include "pa_chinh.php";
								break;
							case "pa_them":
								include "pa_them.php";
								break;

							case "tb_xem":
								include "tb_xem.php";
								break;
							case "tb_chinh":
								include "tb_chinh.php";
								break;
							case "tb_them":
								include "tb_them.php";
								break;

							case "dh_xem":
								include "dh_xem.php";
								break;
							case "dh_chinh":
								include "dh_chinh.php";
								break;
							case "dh_them":
								include "dh_them.php";
								break;

							case "tk_xem":
								include "tk_xem.php";
								break;
							case "tk_mk":
								include "tk_mk.php";
								break;
							case "tk_cv":
								include "tk_cv.php";
								break;
							case "tk_doi":
								include "tk_doi.php";
								break;
							case "tk_them":
								include "tk_them.php";
								break;

							case "sl_xem":
								include "sl_xem.php";
								break;
							case "sl_chinh":
								include "sl_chinh.php";
								break;
							case "sl_them":
								include "sl_them.php";
								break;

							case "tt_xem":
								include "tt_xem.php";
								break;
							case "tt_chinh":
								include "tt_chinh.php";
								break;
							case "tt_them":
								include "tt_them.php";
								break;								
							
							case "ch_xem": 
								include "ch_xem.php";
								break;
							case "ch_chitiet": 
								include "ch_chitiet.php";
								break;							      
							case "ch_xoa": 
								include "ch_xoa.php";
								break;

							case "tl_chitiet": 
								include "tl_chitiet.php";
								break;							      
							case "tl_xoa": 
								include "tl_xoa.php";
								break;	

							case "option_xem":
								include "option_xem.php";
								break;

							default :
								include "content.php";
								break;
						}
			?> 
 
<div style="clear:both"></div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<hr style="border:1px solid #008ECE" />
<div style="padding:23px;  
  color: #008ECE;
  text-transform: uppercase;
  font-weight: bold;  background-color: #dfdfdf;
  background: -moz-linear-gradient(top, #fff, #dfdfdf 50%, #cecece );
  background: -webkit-gradient(linear, left top, left bottom, from(#fff), color-stop(0.5, #dfdfdf), to(#cecece) );"><center>
<p style="text-shadow:0px 3px 2px #ccc;font-size:23px" >Ứng dụng web quản lý khách hàng</p><br />
<p style="color:brown">Liên hệ : Mr Hưng - 0933 969 108</p>
</center></div>
</div>
<!--
<div style="background:brown;width:99%;color:white;padding:10px;position:fixed;bottom:0;right:0;z-index:10000;opacity:0.9;">
Nhập <span style="text-transform:uppercase;text-decoration:underline">NGAY SAU KHI ĐẶT HẸN</span> sẽ giúp Sếp Siêu và phòng mạng biết được tình hình và có những điều chỉnh thích hợp để giúp tư vấn hiệu quả hơn.<br />
Hiểu được thời gian của tư vấn là eo hẹp, nên khi vừa đặt hẹn được 1 khách, tư vấn <span style="text-transform:uppercase;text-decoration:underline">chỉ cần lưu mã và tên khách</span> sau đó nhấn Enter, chỉ mất 5 giây,
cuối ngày mới cập nhật những thông tin còn lại

</div>
-->
</body>

<!-- Mirrored from jannek.fi/themeforest/proadmin/ by HTTrack Website Copier/3.x [XR&CO'2008], Wed, 26 Nov 2008 20:37:11 GMT -->
</html>


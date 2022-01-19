<?php
	error_reporting(0);
	ob_start();
	require_once("checklogin.php");
	$p = $_GET['p'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from jannek.fi/themeforest/proadmin/ by HTTrack Website Copier/3.x [XR&CO'2008], Wed, 26 Nov 2008 20:36:56 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ProAdmin</title>

<!--// SCRIPTS FOR DROPDOWN AND TABBED INTERFACE -->



<!--// FOLLOWING SCRIPT IS FOR PNG FIX IE5.5/IE6-->
    

<!--[if lt IE 7]>
<script defer type="text/javascript" src="js/pngfix.js"></script> 
<![endif]--> 

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="../js/jquery.ui.core.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
<script type='text/javascript' src='js/jquery.cookie.js'></script>
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

<div class="bodytext" id="submenu"> 
  <marquee style="color:#FFF">Chào mừng bạn đến với trang quản trị. Chúc bạn có ngày làm việc vui vẻ</marquee>
</div>

<!--// Horisontal submenu edit ends -->
<!--// Logo edit starts -->

<div id="logo">
  <div align="center"><br />
    <img src="images/logo.png" alt="logo" width="116" height="34" /><br />
  </div>
</div>

<!--// logo edit ends -->
<!--// Arrows edit starts -->

<div id="arrows"></div>

<div class="bodytext" id="hello">Chào bạn: <a href="#"><?=$_SESSION['kt_login_user']?></a>, 
    <img src="images/icons/user.png" alt="user_icon" width="22" height="25" border="0" /><br />
    <a style="margin: 0 0 0 60px;" href="thoat.php">Thoát</a>

</div>
<!--// arrows edit ends -->



<div style="display: none;" class="bodytext" id="dropdown">

		
	 
<div class="clear"> </div>
</div>

<!--// dropdown edit ends -->
<!--// leftcolumn edit starts -->
	<!--// Mainnavigation edit starts -->


<div id="leftcolumn">
  <div id="navigation"><img src="images/title_bg.png" alt="titlebg" width="180" height="49" />
    <div class="toplinks style1" id="navigationtitle"><strong>Mục Lục</strong><br /> <!--// Title -->
      <br />
      <?php  include "menu.php"; ?>
      <br />
    </div>
  </div>
  </div>

  
	<!--// leftcolumn edit ends -->
  



<!--// Tabbed interface ends -->

<!--// Content starts -->

<div id="content"> 
<?php 
					switch ($p)
						{	
							case "dk_xem":
								include "dk_xem.php";
								break;
							case "dk_chinh":
								include "dk_chinh.php";
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

							case "dm_xem":
								include "dm_xem.php";
								break;
							case "dm_chinh":
								include "dm_chinh.php";
								break;
							case "dm_them":
								include "dm_them.php";
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
								
							case "gy_xem":
								include "gy_xem.php";
								break;	

							default :
								include "content.php";
								break;
						}
			?> 
 
</div>
  
  
 



</body>

<!-- Mirrored from jannek.fi/themeforest/proadmin/ by HTTrack Website Copier/3.x [XR&CO'2008], Wed, 26 Nov 2008 20:37:11 GMT -->
</html>


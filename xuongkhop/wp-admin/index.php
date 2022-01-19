<?php
	ob_start();
    require_once "checklogin.php";
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$view = "";
	if (isset( $_GET['view'])) $view = $_GET['view'];
	if (isset( $_POST['view'])) $view = $_POST['view'];
	if(isset($_COOKIE['idLoai'])==false)	setcookie("idLoai","1");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Qua Ly Apollo</title>
<link rel="stylesheet" href="css/style.css" />

<link href="css/templatemo_style.css" rel="stylesheet" type="text/css" /> 
<link rel="stylesheet" href="css/accordionmenu.css" type="text/css" media="screen" />

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="js/jquery.ui.core.js"></script>
<script type="text/javascript" src="js/tinybox.js"></script>

<script>
	$(window).load(function () {
	  setTimeout(hieuchinh,500);
	});
		
	function hieuchinh()
	{
		var h1 = $("#templatemo_left").height();

		var h2 = $("#templatemo_right").height();
		
		
		var m = h1;

		if (h2 > h1)		
			m = h2;
			

		$("#templatemo_left").height(m);
		$("#templatemo_right").height(m);
		
	};
	
</script>
</head>
<body>
	<div id="templatemo_container"> 
    	<div id="templatemo_header">
        	<div id="templatemo_logo_area">
            	<div id="templatemo_logo">
                	
                </div>
                
                <div id="templatemo_slogan"></div>
          </div>
            
            <?php include "login.php"; ?>
            <div class="cleaner"></div>
            <?php include "menu.php";?>
            <div class="cleaner"></div>
            
        </div>
        <div class="cleaner"></div>
        <div id="regist">
        	<div id="left"><img src="images/nguoitimviec.jpg" width="480px" border="0" usemap="#Map"/>
              <map name="Map" id="Map">
                <area shape="rect" coords="209,226,270,249" href="index.php?view=dangky_timviec" />
              </map>
        	</div>
            <div id="right"><img src="images/nhatuyendung.jpg" width="480px" border="0" usemap="#Map2" />
              <map name="Map2" id="Map2">
                <area shape="rect" coords="210,227,272,248" href="index.php?view=dangky_congty" />
              </map>
            </div>
        </div>
        <div id="templatemo_content_area">
        
        	<div id="templatemo_left">
            	<?php include "formtim.php"; ?>
                <?php include "quangcao.php"; ?>
            </div><!-- End of left -->
            
            <div id="templatemo_right">
            <?php
            	switch ($view)
                {
                    case "dangky_timviec":
                        include "dangkythanhvien_tv.php";
                        break; 
					case "dangky_congty":
                        include "dangkythanhvien_ct.php";
                        break; 
					case "nha-tuyen-dung":
                        include "content2.php";
                        break;
					case "hs_timviec":
                        include "timviec_taohs.php";
                        break;
					case "hs_timnguoi":
                        include "nganhnghe_taohs.php";
                        break;
					case "hs_tv":
                        include "timviec_thongtin.php";
                        break;
					case "hs_tn":
                        include "nganhnghe_thongtin.php";
                        break;
					case "timvec_nn":
                        include "timviec_theonn.php";
                        break;					
					case "timnguoi_nn":
                        include "nganhnghe_theonn.php";
                        break;
					case "timkiem":
                        include "ketquatim.php";
                        break;
					case "qly_timnguoi":
                        include "nganhnghe_qlyhs.php";
						break;
					case "sua_hs_tn":
                        include "nganhnghe_suahs.php";
                        break;
					default:
						include "content.php";
                        break;
                }
            ?>   	
            	
            </div><!-- End of right -->
        	<div style="clear:both"></div>
        </div> <!-- End of content_area -->
        
    </div><!-- End Of Container -->
    <div class="cleaner"></div>
    <div class="top_footer"></div>
     <div id="templatemo_footer">
        	<div style="width:100%;"> <div style="width:50%; float:left; text-align:left; "><img src="images/footer_logo.jpg" width="250px" height="100px"  />
			</div> 
            <div style="width:50%; float:right;" >   
				<font size="3" color="#039"><b>Liên hệ trực tuyến để đăng quảng cáo:</b></font><br />
					<font color="#FF0000">Email_1: 24hdiendanmuaban@gmail.com<br />
                    Email_2: muaban24hdiendan@yahoo.com <br /></font>
                <font color="#0000FF"><b>Hotline:</b><br /></font>
				 	0938812435 (Mr Cường) |  0938812445 (Mr Hóa)<br />
                <b>Địa chỉ giao dịch online: </b><br />
					365/26/50 Hậu Giang, F11, Q6, Tphcm 
             </div>
             <div class="cleaner"></div>
        </div>
<!--  Free CSS Templates by TemplateMo.com  -->
</body>
</html>
<?php error_reporting(E_ALL ^ E_DEPRECATED); ?>
<?php 
	session_start();
	require_once "lib/class_quanly.php";
	if(isset($qly_ql)==false) $qly_ql = new quanly;
	if(isset($_GET['p'])) $p = $_GET['p']; else $p = '';
	$actual_link	= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$link_chat		= "http://drt.zoosnet.net/LR/Chatpre.aspx?siteid=DRT75684490&float=1&lng=en&p=".$actual_link;
	$link_fb		= '#';
	$link_tw		= '#';
	$link_gg		= '#';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<base href="http://xuongkhop.dongy495.com/" />
	<link href="images/favicon.png" rel="shortcut icon" type="image/x-icon" />
	<title><?php include "blocks/title.php"; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="content-language" content="vi" />
	<?php include "blocks/robot.php"; ?>
	<meta name="description" content="<?php include "blocks/des.php"; ?>" />
	<meta name="keywords" content="<?php include "blocks/keyword.php"; ?>">
	<?php include "blocks/facebook_meta.php"; ?>
	<link rel="canonical" href="<?php echo $actual_link; ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
	<link rel="stylesheet" href="css/common_top.css" type="text/css">
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/rollover.min.js"></script>
	<script type="text/javascript" src="js/jquery.cycle.all.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="js/wow.min.js"></script>
	<script>new WOW().init();</script>	
</head>

	<?php include 'modules/header/index.php'; ?>

	<div class="l-wrapper">
	<?php 
		if($p =='trangchitiet') {
			$TieuDeKD = $_GET['TieuDeKD'];
			include "pages/trangchitiet.php";
			
		}
		else if($p=='error') header('Location:http://dongy495.com/');
		else if($p=='trangloai'){
			include "pages/trangloaicon.php";
			
			
		}
		else if($p=='trangtimkiem') include "pages/timkiem.php";
		else include "pages/trangchu.php";
	?>

	<?php include 'modules/footer/index.php'; ?>
	<?php include "chat.php"; ?>
</body>
</html>



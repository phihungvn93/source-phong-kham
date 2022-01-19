<?php
require_once "checklogin.php";
  require_once "class_quantri.php";
  $qt = new quantri;
  
  if (isset($_POST['btnOK'])==true)
	{
		/*if($_POST['SoDT']=="")
		{
			echo "<script>alert('Bạn phải nhập số điện thoại!')</script>";
		}
		else
		{*/
			$qt ->ThemDH();
		/*}*/		
	}
	header( 'Location: main.php?p=dh_xem' );
?>
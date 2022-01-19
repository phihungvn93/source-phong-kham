<?php
	ob_start();
	session_start();
	if (isset($_POST['btnLog'])==true)
	{	
		require_once("dbcon.php");  
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		
		if (get_magic_quotes_gpc()== false) 
		{
			$username=trim(mysql_real_escape_string($username));
			$password=trim(mysql_real_escape_string($password));
		}
		$sql = "SELECT * FROM users WHERE User='$username' AND Pass ='$password'";
		var_dump($sql);
		$user = mysql_query($sql);
		if (mysql_num_rows($user)==1) //Thành công	
		{
			if (isset($_POST['nho'])== true)
			{
				 setcookie("un", $_POST['username'], time() + 60*60*24*7 );
				 setcookie("pw", $_POST['password'], time() + 60*60*24*7 );
			} 
			else 
			{
				 setcookie("un", $_POST['username'], time() -1);
				 setcookie("pw", $_POST['password'], time() -1);
			}
		$row_user = mysql_fetch_assoc($user);
		$_SESSION['tg_login_id'] = $row_user['idUser'];
		$_SESSION['tg_login_user'] = $row_user['User'];
		$_SESSION['tg_login_level'] = $row_user['idGroup'];		
		
			if (strlen($_SESSION['back'])>0){
				$back = $_SESSION['back']; //unset($_SESSION['back']);
				header("location:$back");
			} else header("location: main.php");
		} else { //Thất bại
			
			header("location: login.php");
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- Mirrored from jannek.fi/themeforest/proadmin/login.html by HTTrack Website Copier/3.x [XR&CO'2008], Wed, 26 Nov 2008 20:37:25 GMT -->
<head>
<title>ProAdmin - Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--// FOLLOWING SCRIPT IS FOR PNG FIX IE5.5/IE6-->
    

<!--[if lt IE 7]>
<script defer type="text/javascript" src="js/pngfix.js"></script> 
<![endif]--> 


<!--//  Styles starts -->


<link href="css/login.css" rel="stylesheet" type="text/css" />


</head>
<body>


<div id="logo">
	<img src="images/logo.png" alt="logopng" width="116" height="34" /> <!--//  Logo on upper corner -->
</div>


<div class="box">
	<div class="welcome" id="welcometitle">Chào bạn, mời bạn đăng nhập : <!--//  Welcome message -->
</div>
  

  <div id="fields">
  <form id="form1" name="form1" method="post" action="">
	  <div align="center" id="error" style="width:400px; color:#F00; ">
    <?php 
    echo $_SESSION['error']; unset( $_SESSION['error'] );
    
    ?>
    </div>   
    <div style="clear:both"></div>
    <table width="333">
      <tr>
        <td width="100" height="35"><span class="login">Tên đăng nhập: </span></td>
        <td width="244" height="35"><label>
          <input name="username" type="text" class="fields" id="username" size="30" />  <!--//  Username field  -->
        </label></td>
      </tr>
      
      
      <tr>
        <td height="35"><span class="login">Mật khẩu: </span></td>
        <td height="35"><input name="password" type="password" class="fields" id="password" size="30" />
        </td> <!--//  Password field -->
      </tr>
      
      
      <tr>
        <td height="65">&nbsp;</td>
        <td height="65" valign="middle"><label>
          <input name="btnLog" type="submit" class="button" id="btnLog" value="Đăng nhập" />
          
          <!--//  login button -->
        </label></td>
      </tr>
    </table>
    </form>
  </div>
  
  
  <div class="login" id="lostpassword"><a href="#">Lost Password?</a></div> <!--//  lost password part -->
  
  



</body>

<!-- Mirrored from jannek.fi/themeforest/proadmin/login.html by HTTrack Website Copier/3.x [XR&CO'2008], Wed, 26 Nov 2008 20:37:26 GMT -->
</html>

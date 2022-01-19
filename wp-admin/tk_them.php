<?php
  require_once "checklogin.php";
	require_once "class_quantri.php";
	$qt =  new quantri;
	if (isset($_POST['btnOK'])==true)
	{
		$qt ->ThemTK();
		header("location:main.php?p=tk_xem");
	}
?>
<script>
    $(document).ready(function() {
      $("#form1").submit(function(event) {
      	var user = $("#User").val();
      	if(user.indexOf(' ') > 0){
			alert ('Tài khoản không được có khoản trống');
      		return false;
		}
      	else
      		return true;
      });
    });
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
<table border="1" align="center" cellpadding="4" cellspacing="0">
<tr> <td colspan="2" align="center">THÊM TÀI KHOẢN</td> </tr>

<tr><td width="100">Nhóm</td>
     <td>
        <select  id="idGroup" name="idGroup">
          <option value="1">Nhân Viên</option>
          <option value="2">Quản Trị</option>
          <option value="3">Admin</option>
        </select>
     </td>
</tr>
<tr><td width="100">Tài Khoản</td>
     <td><input type="text" name="User" id="User" /></td>
</tr>
<tr><td width="100">Mật Khẩu</td>
     <td><input type="password" name="Pass" id="Pass" /></td>
</tr>
<tr><td colspan="2" align="center"><input type="submit" name="btnOK" id="btnOK" value="Thêm" />
  <input type="reset" name="btnxoa" id="btnxoa" value="Làm lại" /></td>
</tr>
</table>
</form>

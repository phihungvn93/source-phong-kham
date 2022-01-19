<?php
  require_once "checklogin.php";
  require_once "class_quantri.php";
  $qt =  new quantri;
  $id=$_GET['id']; settype($id,"int");
  $sanpham = $qt->ChiTietTK($id);	
  $row_sanpham = mysql_fetch_assoc($sanpham);
  if (isset($_POST['btnOK'])==true){
    $qt ->SuaTKCV($id);
    header("location:main.php?p=tk_xem");
  }
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
<table border="1" align="center" cellpadding="4" cellspacing="0">
<tr> <td colspan="2" align="center">SỬA CHỨC VỤ</td> </tr>


<tr><td width="100">Nhóm</td>
     <td>
        <select  id="idGroup" name="idGroup">
          <option <?php echo (1 == $row_sanpham['idGroup']) ? 'selected' : '';?> value="1">Nhân Viên</option>
          <option <?php echo (2 == $row_sanpham['idGroup']) ? 'selected' : '';?> value="2">Quản Trị</option>
          <option <?php echo (3 == $row_sanpham['idGroup']) ? 'selected' : '';?> value="3">Admin</option>
        </select>
     </td>
</tr>

<tr><td colspan="2" align="center"><input type="submit" name="btnOK" id="btnOK" value="Sửa" />

</tr>
</table>
</form>

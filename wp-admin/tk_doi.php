<?php
  require_once "checklogin.php";
  require_once "class_quantri.php";
  $qt =  new quantri;
  $id=$_SESSION['kt_login_id']; settype($id,"int");
  $sanpham = $qt->ChiTietTK($id); 
  $row_sanpham = mysql_fetch_assoc($sanpham);
  if (isset($_POST['btnOK'])==true){
    $qt ->SuaTKMK($id);
    header("location:main.php?p=cd_xem");
  }
?>
<script>
    $(document).ready(function() {
      $("#PassOld").focus();
      $("#PassOld").blur(function() {
        var bien = "Pass="+$("#PassOld").val();
        $.get('tk_ktra.php', bien , function(data) {
          $("#loi").html(data);
        });
      });
      $("#PassOld").live("keypress", function(e)
        {
            ktrapass($(e.target));
        });
      $("#form1").submit(function(){
        if($("#Pass").val()==""){
          alert("Nhập mật khẩu mới !!!");
          $("#Pass").focus();
          return false;
        }
        if($("#loi").html()!=""){
          alert("Sửa lỗi bên dưới !!!");
          return false;
        }
      });
    });
    var typingTimeout;
    function ktrapass()
    {
        if (typingTimeout != undefined)
            clearTimeout(typingTimeout);
        typingTimeout = setTimeout( function()
        {
            var bien = "Pass="+$("#PassOld").val();
            $.get('tk_ktra.php', bien , function(data) {
              $("#loi").html(data);
            });
        }
        , 100);
    }
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
<table border="1" align="center" cellpadding="4" cellspacing="0">
<tr> <td colspan="2" align="center">ĐỔI MẬT KHẨU</td> </tr>


<tr><td width="100">Mật Khẩu Cũ</td>
     <td><input type="password" name="PassOld" id="PassOld"/></td>
</tr>
<tr><td width="100">Mật Khẩu</td>
     <td><input type="password" name="Pass" id="Pass"/></td>
</tr>
<tr><td colspan="2" align="center"><div style="color: #F00;" id="loi"></div></td>
<tr><td colspan="2" align="center"><input type="submit" name="btnOK" id="btnOK" value="Sửa" /></td>

</tr>
</table>
</form>

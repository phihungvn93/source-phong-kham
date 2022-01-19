<?php
	require_once "checklogin.php";
	require_once "class_quantri.php";
	$qt = new quantri;
	$pageSize = 20; 
	$pageNum = 1;
	if (isset($_GET['pageNum'])==true) $pageNum = $_GET['pageNum'];
	if ($pageNum<=0) $pageNum=1; settype($pageNum,"int");
	$TieuDe = $_GET['TieuDe'];
	$TieuDe = $qt->XoaDinhDang($TieuDe);
?>
<?php
	$loaisp = $qt->ListTK($totalRows, $pageNum,$pageSize, $TieuDe);
?>
<style>
#thanhphantrang a {text-decoration:none; padding-left:5px; padding-right:5px; margin-left:5px; margin-right:5px;}
#thanhphantrang span {
	padding-left:5px;
	padding-right:5px;
	margin-left:5px;
	margin-right:5px;
	color:#F00;
	font-size: 24px;
	font-weight: bolder;
}
.smallButton{
	border: 1px solid #cdcdcd;
	padding: 5px 5px;
	display: inline-block;
	background: #f6f6f6;
	margin:0 10px 0 0;
}
</style>


<script type="text/javascript">
	function nhapchuot(){
		var dulieu = $("#TieuDe").val();
		if (dulieu == "Nhập tiêu đề cần tìm")
			$("#TieuDe").val("");
	}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<form action="" method="get" name="form2" id="form2">
	<input type="hidden" name="p" id="p" value="tk_xem" />
    <input type="text" id="TieuDe" name="TieuDe" value="Nhập tiêu đề cần tìm" onclick="nhapchuot()" />
	<input type="submit" value="Tìm" id="btnLocMa" name="btnLocMa" />
</form>
<div style="clear: both; height: 10px"></div>
<table id="dsloaitin" border="1" cellpadding="4" cellspacing="0" width="450" align="center" />

<tr>
		<th width="20">STT</th>
		<th width="200">User</th>
        <th width="80">Chức Vụ</th>
	    <th width="150">Thao Tác</th>
</tr>
<?php while ($row_loaisp = mysql_fetch_assoc($loaisp) ) { ?>
<?php ob_start(); ?>
<tr>  	<td>{STT}</td>
        <td>{User}</td>
		<td>{CV}</td>
      	<td width="100" align="center">
            <a class="smallButton" href="main.php?p=tk_mk&id={STT}"><img  src="images/pencil.png" title="Đổi Mật Khẩu"></a>
            <a class="smallButton" href="main.php?p=tk_cv&id={STT}"><img  src="images/pencil.png" title="Thay Đổi Quyền"></a>
            <a class="smallButton" href="tk_xoa.php?id={STT}" onclick="return confirm('Bạn có muốn xóa !!! ');"><img src="images/close.png" title="Xóa Tài Khoản"></a>
  		</td>
</tr>



<?php 	
$str = ob_get_clean(); 
$str = str_replace("{STT}",$row_loaisp['idUser'],$str);
$str = str_replace("{User}",$row_loaisp['User'],$str);
$idGroup = $row_loaisp['idGroup'];
if ($idGroup == 3)
	$CV = "Admin";
elseif ($idGroup == 2)
	$CV = "Quản Trị";
else
	$CV = "Nhân Viên";
$str = str_replace("{CV}", $CV ,$str);
echo $str;
?>
<?php } //while ?>
<?php if ($totalRows > $pageSize) { ?>
<tr>
  <td colspan="8" align="left"> 
   <p id=thanhphantrang>
	<?=$qt->pagesList($totalRows, $pageNum, $pageSize);?>
	</p>
    </td>
</tr>
<?php } ?>
</table>

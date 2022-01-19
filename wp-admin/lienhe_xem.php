<? 
	require_once "checklogin.php";
	require_once "class_quantri.php";
	$qt = new quantri;
    
    $pageSize = 20; 
	$pageNum = 1;
	if (isset($_GET['pageNum'])==true) $pageNum = $_GET['pageNum'];
	if ($pageNum<=0) $pageNum=1; settype($pageNum,"int");
    
    $danhmuc = $qt->ListDangKy($totalRows, $pageNum,$pageSize);
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
</style>
<table id=dsloaitin border=1 cellpadding=4 cellspacing=0 width=800 align=left>
<tr><th>Họ và Tên</th> <th>Điện Thoại</th> <th>Ngày Đăng Ký</th><th>Action</th>
</tr>
<?php while ($row_danhmuc = mysql_fetch_assoc($danhmuc) ) { ?>
<?php ob_start(); ?>
<tr>  <td>{HoTen}</td>
      <td class="tenloai">{DienThoai}</td>      
      <td class="AnHien" width="100">{Email}</td>
      <td width="100" align="center">
	| <a href="main.php?p=lienhe_chitiet&idLH={idLH}">Xem</a> | <a href="lienhe_xoa.php?idLH={idLH}" onclick="return confirm('Xóa đăng ký này ??');"> Xóa </a>  |
  </td>
</tr>

<?php 	
$str = ob_get_clean(); 
$str = str_replace("{idLH}",$row_danhmuc['idLH'],$str);
$str = str_replace("{HoTen}",$row_danhmuc['HoTen'],$str);
$str = str_replace("{DienThoai}",$row_danhmuc['DienThoai'],$str);
$str = str_replace("{Email}",$row_danhmuc['Email'],$str);
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
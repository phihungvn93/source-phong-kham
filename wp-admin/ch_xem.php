<? 
	require_once "checklogin.php";
	require_once "class_quantri.php";
	$qt = new quantri;
    
    $pageSize = 20; 
	$pageNum = 1;
	if (isset($_GET['pageNum'])==true) $pageNum = $_GET['pageNum'];
	if ($pageNum<=0) $pageNum=1; settype($pageNum,"int");
    
    $danhmuc = $qt->ListCauHoi($totalRows, $pageNum,$pageSize);
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

<table id="dsloaitin" border="1" cellpadding="4" cellspacing="0" width="1000" align="left">
<tr>
    <th width="180">Họ và Tên</th> 
    <th width="180">Email</th>
    <th width="100">Điện Thoại</th> 
    <th width="180">Tiêu Đề</th>
    <th width="80">Trạng Thái</th>
    <th width="100">Action</th>
</tr>
<?php while ($row_danhmuc = mysql_fetch_assoc($danhmuc) ) { ?>
<?php ob_start(); ?>
<tr>  <td>{HoTen}</td>
      <td class="tenloai">{Email}</td>      
      <td class="AnHien" width="100">{DienThoai}</td>
      <td class="ThuTu">{TieuDeCH}</td>
      <td class="ThuTu">{AnHien}</td>
      <td width="100" align="center">
	| <a href="main.php?p=ch_chitiet&idCH={idCH}">Xem</a> | <a href="ch_xoa.php?idCH={idCH}" onclick="return confirm('Xóa câu hỏi này ??');"> Xóa </a>  |
  </td>
</tr>

<?php 	
$str = ob_get_clean(); 
$str = str_replace("{idCH}",$row_danhmuc['idCH'],$str);
$str = str_replace("{HoTen}",$row_danhmuc['HoTen'],$str);
$str = str_replace("{Email}",$row_danhmuc['Email'],$str);
$str = str_replace("{DienThoai}",$row_danhmuc['DienThoai'],$str);
$str = str_replace("{TieuDeCH}",$row_danhmuc['TieuDeCH'],$str);
if ($row_danhmuc['AnHien'] == 0)
    $anhien = "Ẩn";
else
    $anhien = "Hiện";

$str = str_replace("{AnHien}",$anhien,$str);
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
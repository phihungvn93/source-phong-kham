<?
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
	$loaisp = $qt->ListPA($totalRows, $pageNum,$pageSize, $TieuDe);
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
	$(document).ready(function() {
		$(".anhien").click(function() {
			var bien = $(this).attr('AnHien');
			var ma = $(this).attr('id');
			$.get('anhien.php', bien, function(data) {
				var chuoi = "<img  src=images/ah_"+data+".png>";
				$("#"+ma).html(chuoi);
			});
			return false;
		});
	});
	function nhapchuot(){
		var dulieu = $("#TieuDe").val();
		if (dulieu == "Nhập tiêu đề cần tìm")
			$("#TieuDe").val("");
	}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<form action="" method="get" name="form2" id="form2">
	<input type="hidden" name="p" id="p" value="pa_xem" />
    <input type="text" id="TieuDe" name="TieuDe" value="Nhập tiêu đề cần tìm" onclick="nhapchuot()" />
	<input type="submit" value="Tìm" id="btnLocMa" name="btnLocMa" />
</form>
<div style="clear: both; height: 10px"></div>
<table id="dsloaitin" border="1" cellpadding="4" cellspacing="0" width="950" align="center" />

<tr>
		<th width="20">Mã</th>
		<th width="200">Tiêu đề</th>
        <th width="530">Tóm Tắt</th>
        <th width="50">Ẩn/Hiện</th>
	    <th width="150">Thao Tác</th>
</tr>
<?php while ($row_loaisp = mysql_fetch_assoc($loaisp) ) { ?>
<?php ob_start(); ?>
<tr>  	<td class="anhien">{id}</td>
        <td>{TieuDe}</td>
		<td>{TomTat}</td>
		<td class="anhien"><a class="smallButton anhien" id="ma_{id}"  AnHien="bang=pages&ma=idPa&id={id}"  href="#"><img  src="images/ah_{AnHien}.png"></a></td>
      	<td width="100" align="center">
            <a class="smallButton" href="main.php?p=pa_chinh&id={id}"><img  src="images/pencil.png" title="Sửa Tin"></a>
            <a class="smallButton" href="pa_xoa.php?id={id}" onclick="return confirm('Bạn có muốn xóa !!! ');"><img src="images/close.png" title="Xóa Tin"></a>
            <a class="smallButton" href="" onclick="return prompt('Link cần lấy', '{TieuDeKD}.html', '');"><img src="images/eye_inv.png" title="Lấy Link"></a>

  		</td>
</tr>



<?php
$str = ob_get_clean();
$str = str_replace("{id}",$row_loaisp['idPa'],$str);
$str = str_replace("{TieuDe}",$row_loaisp['TieuDe'],$str);
$str = str_replace("{TieuDeKD}",$row_loaisp['TieuDeKD'],$str);
$TomTat = $qt->XoaDinhDang($row_loaisp['TomTat']);
$TomTat = $qt->RutGon($TomTat, 40, 200);
$str = str_replace("{TomTat}", $TomTat ,$str);
$str = str_replace("{AnHien}",$row_loaisp['AnHien'],$str);
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

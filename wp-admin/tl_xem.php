<?php
	$sql="select * from traloi where idCH = $idDH";
	$danhmuc1 = mysql_query($sql);
?>

<table id=dsloaitin border=1 cellpadding=4 cellspacing=0 width=800 align=left>
<tr>
    <th>Nội dung</th>
    <th>Ẩn Hiện</th>
    <th>Action</th>
</tr>
<?php while ($row_danhmuc1 = mysql_fetch_assoc($danhmuc1) ) { ?>
<?php ob_start(); ?>
<tr>
        <td>{NoiDungTL}</td>
        <td>{AnHien}</td>
        <td width="100" align="center">
	| <a target="_blank" href="main.php?p=tl_chitiet&idTL={idTL}">Xem</a> | <a href="tl_xoa.php?idTL={idTL}" onclick="return confirm('Bạn muốn xóa dòng này ??');"> Xóa </a>  |
  </td>
</tr>

<?php
$str = ob_get_clean();
$str = str_replace("{idTL}",$row_danhmuc1['idTL'],$str);
$bien = $row_danhmuc1['NoiDungTL'];
$str = str_replace("{NoiDungTL}",$bien,$str);
if ($row_danhmuc1['AnHien'] == 0)
    $anhien = "Ẩn";
else
    $anhien = "Hiện";

$str = str_replace("{AnHien}",$anhien,$str);
echo $str;
?>
<?php } //while ?>

</table>
<?php
require_once "checklogin.php";
require_once "class_quantri.php";
$qt = new quantri;
$idTL = $_GET['idTL'];
$loaitin = $qt->DanhMuc(-1,$idTL);
?>
<option value="0"> Chọn Loại Tin </option>
<?php while($row_loaitin=mysql_fetch_assoc($loaitin)){?>
    <option value="<?=$row_loaitin['idLoai'];?>"><?=$row_loaitin['TieuDe'];?> </option>
<?php }?>
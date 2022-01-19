<?php 
session_start();
require_once "../lib/class_quanly.php";
if(isset($qly_ql)==false) $qly_ql = new quanly;
if ($_POST["sdt"] != "") {
	$sdt = $_POST["sdt"];
    $result = $qly_ql-> LienHe5($sdt,$ghichu);
    echo $result;
}
else
{
	echo 'Vui lòng nhập chính xác số điện thoại';
}
?>
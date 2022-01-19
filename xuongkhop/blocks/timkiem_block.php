<?php 
	$tukhoa = $qly_tin->XoaDinhDang($_GET['TieuDeKD']);

	$pageSize=10;
	$pageNum = $_GET['pageNum']; settype($pageNum,"int");
	if($pageNum<=0) $pageNum = 1;
	$tt = $qly_tin->TimKiem($tukhoa, $totalRows, $pageNum, $pageSize);
?>


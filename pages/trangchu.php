<?php include 'modules/sl/index.php'; ?>
<?php include 'modules/doingu/index.php'; ?>
<?php include 'modules/form_top/index.php'; ?>
<?php
	if(is_mobile()){
		include 'modules/chuyenmuc_sp/index.php';
	}else{
		include 'modules/chuyenmuc_pc/index.php';
	}
?>
<?php include 'modules/camnhan/index.php'; ?>
<?php include 'modules/uudiem/index.php'; ?>
<?php include 'modules/form_top2/index.php'; ?>
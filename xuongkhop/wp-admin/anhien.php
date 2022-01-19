<?php
	require_once "class_quantri.php";
	$qt = new quantri;
	$bang=$_GET['bang'];
	$ma=$_GET['ma'];
	$id=$_GET['id'];

	settype($id,"int");
	$anhien = $qt->LayAnHien($bang, $ma, $id);
	if ($anhien == 0)
		$anhien = 1;
	else
		$anhien = 0;
	$qt->DoiAnHien($bang, $ma, $id,$anhien);
	echo $anhien;
?>
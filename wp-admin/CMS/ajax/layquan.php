<?php 
	require_once "../class_quantri.php";
	$qt = new quantri;
	$idTP = $_GET['idTP'];
	settype($idTP,"int");
	$quan = $qt->Quan_list($idTP);
?>
	<option value="-1">-Chọn Quận-</option>
<?php	
	while($rowq = mysql_fetch_assoc($quan)){
?>
<option value="<?php echo $rowq['id']?>"><?php echo $rowq['title']?></option>
<?php }?>
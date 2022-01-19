<?php
	ob_start(); session_start();
	require_once "../class_quantri.php";
	$qt = new quantri;
	if(isset($_GET['pageNum'])) $pageNum = $_GET['pageNum']; else $pageNum = 1;
	$pageSize = 10;
?>
<style>
	body{background-color:#dce9e9}
	h1{color:#fff;background-color:#008ECE;text-align:center;text-transform:uppercase;height:50px;line-height:50px}
	table{border:1px solid #008ECE}
	table td, table th{background-color:#fff;border:1px solid #008ECE}
</style>
<html>
<head>
<style>
	#thanhphantrang{text-align:center;}
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
</head>
<body>
	<center><h1>Xem LOG Phòng khám đa khoa Thế Giới</h1></center>
	<table width="90%" align="center" cellpadding="10" cellspacing="0">
		<tr>
			<th align="center">STT</th>
			<th width="100">Ngày</th>
			<th>Tư vấn</th>
			<th>Action</th>
		</tr>
		<?php
			$log = $qt->log_list($pageNum,$pageSize,$totalRows); $i = ($pageNum-1)*$pageSize;
			while($row_log = mysql_fetch_assoc($log)){  $i++;
				$bstv = mysql_query("select TenBS from bstv where ID_BacSi = {$row_log['idUser']}");
				$row_bstv = mysql_fetch_row($bstv);
		?>
		<tr>
			<td align="center"><?php echo $i?></td>
			<td><?php echo date('d-m-Y',strtotime($row_log['Ngay']))?></td>
			<td><?php echo $row_bstv[0]?></td>
			<td>
				<?php
					$mang = explode("###",$row_log['Action']);
					foreach($mang as $action)
					{
				?>	
					+ <?php echo $action?><br/>	
				<?php	
					}
				?>
			</td>
		</tr>
		<?php  }?>
	</table>
	<?php if ($totalRows > $pageSize) { ?>
	<p id="thanhphantrang" style="padding:30px;">
		<?=$qt->pagesList($totalRows, $pageNum, $pageSize);?>
	</p>
	<?php } ?>
</body>
</html>
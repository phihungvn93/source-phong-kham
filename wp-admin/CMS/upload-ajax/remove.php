<?php
	require_once "../checklogin.php";
	require_once "../class_db.php";
	$db = new db;
	$id = $_POST['id'];
	$sql = "select ID_DatHen, url from file where id = {$id}";
	$kq = mysql_query($sql);
	$row = mysql_fetch_assoc($kq);
	$ID_DatHen = $row['ID_DatHen'];
	
	$sql = "delete from file where id = {$id}";
	if(mysql_query($sql)) //unlink($row['url']);
		unlink($_SERVER['DOCUMENT_ROOT']."/wp-admin/CMS/".$row['url']); 
	//print_r($_SERVER);
	$sql = "select * from file where ID_DatHen = {$ID_DatHen}";
	$kq = mysql_query($sql);	
	$total = mysql_num_rows($kq);
	if($total<=0){
		echo "";
		die();
	}	
?>
<style>
	.list_ngang li{display:inline-block;width:18%;margin:3%;list-style:none;text-transform:none;float:left;height:40%;text:center;position:relative}
	.list_ngang li img{width:100%}
	.list_ngang li .delete{position:absolute;top:-20px;right:-20px;margin:auto;width:30px}
</style>
<script>
	$(function(){
		$(".loading, .close").click(function(){
		$(".loading").animate({"background-color":"rgba(0,0,0,0)"},500,function(){
			$(this).css("display","none");
		});
		$("#upload-wrapper").animate({"opacity":0},300,function(){
			$(this).css("display","none");
		});
		$(".upload_view").animate({"opacity":0},300,function(){
			$(this).css("display","none");
		});
		return false;
	});
		$(".upload_view .delete").on("click",function(){
			if(confirm("Are you sure")){
				var id = $(this).attr("id");
				$.post("upload-ajax/remove.php?x="+(new Date()).getTime(),{id:id},function(data){
					$(".upload_view").html(data);
					if(data=='') {
						alert("Không có file");				
						$(".loading").animate({"background-color":"rgba(0,0,0,0)"},500,function(){
							$(this).css("display","none");
						});
						$("#upload-wrapper").animate({"opacity":0},300,function(){
							$(this).css("display","none");
						});
						$(".upload_view").animate({"opacity":0},300,function(){
							$(this).css("display","none");
						});
						location.reload();
					}				
				});
			}
			return false;
		});
	})
</script>
	<a class="close" href="#"><img src="upload-ajax/images/close.png" /></a>
	<ul class="list_ngang">
		<?php
			while($row = mysql_fetch_assoc($kq)){
			$File_Ext = substr($row['url'], strrpos($row['url'], '.'));
			if($File_Ext == '.docx' || $File_Ext == '.doc'){
		?>
				<li>
					<a id="<?php echo $row['id']?>" class="delete" href="#"><img src="upload-ajax/images/close.png" /></a>
					<a target="_blank" href="<?php echo $row['url']?>"><img src="upload-ajax/images/word.png" /></a>
				</li>
			<?php } else {?>
				<li>
					<a id="<?php echo $row['id']?>" class="delete" href="#"><img src="upload-ajax/images/close.png" /></a>
					<a target="_blank" href="<?php echo $row['url']?>"><img src="<?php echo $row['url']?>" /></a>
				</li>
			<?php }?>
		<?php }?>
	</ul>
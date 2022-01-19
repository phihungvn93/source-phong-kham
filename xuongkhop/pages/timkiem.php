<!-- Banner -->
<?php include_once 'modules/slide/index.php'; ?>
<div class="clear20"></div>
<!-- END Banner -->
<div class="site-container max1000">
<style type="text/css">
	article {
		padding: 15px;
		box-sizing: border-box;
	}
	.bottom-post-new {
		width: 100%;
		display: inline-block;
	}
	
	.left-item {
		width: 35%;
    	float: left;
	}
	.left-item img,.left-item a {
		width: 100%;
		display: inline-block;
		height: 150px;
	}
	.item-article .info-articles {
	    width: 65%;
	    float: left;
	    position: relative;
	    padding-right: 0px;
	    box-sizing: border-box;
	    height: 108px;
	}
	.header-post {
	    width: 100%;
	    float: left;
	    padding: 0 2%;
	    box-sizing: border-box;
	    margin-bottom: 2px;
	}
	.item-article .info-articles h3 {
	    font-weight: bold;
	    color: #2EAAE1;
	    margin-bottom: 5px;
	    height: 32px;
	    overflow: hidden;
	    padding: 0 2%;
	    font-size: 16px;
	}
	.bottom-post-new {
	    width: 100%;
	    display: inline-block;
	}
	.first-character {
	    font-size: 360%;
	    float: left;
	    width: 15% !important;
	    padding: 0 2% 2% 2%;
	    line-height: 83%;
	    text-align: center;
	    box-sizing: border-box;
	    color: #5f5f5f;
	}
	.item-article .info-articles .info-left {
	    width: 85%;
	    float: left;
	    height: 110px;
	}
	.bottom-post-new .info-left {
	    padding: 0 3% 0% 3%;
	    box-sizing: border-box;
	    border-left: 1px solid #3057a6;
	    position: relative;
	}
	.btn-xemthem {
		position: absolute;
		left: 3%;
		bottom: 0;
		color: white;
		padding: 5px;
		box-sizing: border-box;
		background: #2EAAE1;
	}
	.btn-tuvanloai {
		position: absolute;
		left: 28%;
		bottom: 0;
		color: white;
		padding: 5px;
		box-sizing: border-box;
		background: #204789;
	}
</style>	
	
	<div class="main-content max700 body-chitiet">
		<?php @include "blocks/br_3cap_trangloai.php"; ?>
		<div class="clear20"></div>
	    <?php while($row_tt = mysql_fetch_assoc($tt)){ ?>
	        <article class="item-article">
				<div class="left-item"><a href="<?php echo $row_tt['TieuDeKD']; ?>.html"><img class="lazy" data-original="<?php echo $row_tt['UrlHinh']; ?>"></a>
				</div>
				<div class="info-articles">
					<div class="header-post">
						<a href="<?php echo $row_tt['TieuDeKD']; ?>.html"><h3><?php echo $row_tt['TieuDe']; ?></h3></a>
					</div>
					<div class="bottom-post-new">
						<span class="first-character"><?=mb_substr($qly_tin->cutString(strip_tags($row_tt['TomTat']), 80, ''), 0,1);?></span>
						<div class="info-left">
						<p><?=mb_substr($qly_tin->cutString(strip_tags($row_tt['TomTat']), 220, '...'), 1,-1);?></p>
							<a href="<?php echo $row_tt['TieuDeKD']; ?>.html" class="btn-xemthem">Xem thêm</a>
							<a href="<?=$link_chat;?>" class="btn-tuvanloai">Tư vấn</a>
						</div>
					</div>	
				</div>
				
			</article>
	        <?php } ?>
	        <?php if(mysql_num_rows ($tt) < 1)
			{
				echo '<h2>Danh mục này chưa có bài viết</h2>';
			}
			?>
			<div class="clear20"></div>
			<?php if($totalRows > $pageSize) { ?>
					<div class="phantrang max600">
						<?php $urlchinh = 'tim-kiem/'.$TieuDeKD; 

						?>
						<?php echo $qly_tin->pagesList1($urlchinh, $totalRows, $pageNum, $pageSize, 2); ?>
						<div class="clear20"></div>
					</div>
			<?php } ?>
			<div class="clear20"></div>
			<a target="_blank" href="http://phongkhamdakhoahongphong.vn/chuyende/bao-quy-dau/" class="chuyen-de-banner">
				<img src="img/chuyen-de-gif.gif">
			</a>
			
	</div>
	<div class="right-sidebar max270">
		<?php include_once 'modules/danhmuc-sidebar/index.php'; ?>
		<div class="clear20"></div>
		<div class="clear20"></div>
        <?php include_once 'modules/camnhan-sidebar/index.php'; ?>
        <div class="clear20"></div>
        <?php include_once 'modules/tuvan-sidebar/index.php'; ?>
	</div>
</div>
<div class="clear20"></div>
<?php include_once 'modules/moi-truong-dm/index.php'; ?>
<div class="clear20"></div>

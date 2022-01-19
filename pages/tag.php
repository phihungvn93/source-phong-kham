<script type="text/javascript">
	$(document).ready(function(){
		$('#type-list').click(function(){
			hasGrid = $('.list-post-trangloai').hasClass('type-grid');
			if(hasGrid)
			{
				$('.list-post-trangloai').removeClass('type-grid');
				$('.list-post-trangloai').addClass('type-list');
				$(this).css("background-color", "rgba(174,221,228,0.3)");
				$('#type-grid').css("background-color", "white");
			}
		});
		$('#type-grid').click(function(){
			hasList = $('.list-post-trangloai').hasClass('type-list');
			if(hasList)
			{
				$('.list-post-trangloai').removeClass('type-list');
				$('.list-post-trangloai').addClass('type-grid');
				$(this).css("background-color", "rgba(174,221,228,0.3)");
				$('#type-list').css("background-color", "white");
			}
		});

	});
</script>
<div class="clear20"></div>
<div class="site-container max1000">
			<?php @include "blocks/tag_block.php"; ?>
			<div class="clear10"></div>
			<div class="main-content max750 body-trangloai">
				<div class="btn-type-view">
					<span class="btn-type" id="type-list" ><img src="./img/icon-list.png"></span>
					<span class="btn-type" id="type-grid"><img src="./img/icon-grid.png"></span>
					<span class="btn-type" id="type-noibat" ><img src="./img/icon-noibat.png"></span>
					<span class="btn-type" id="type-view"><img src="./img/icon-view.png"></span>
				</div>
				<div class="list-post-trangloai type-list">
				<?php while($row_tt = mysql_fetch_assoc($tt)){ ?>
					<article class="baiviet-trangloai">
						<div class="left-trangloai">
							<a href="<?=$row_tt['TieuDeKD'];?>.html">
								<img width="100%" alt="<?=$row_tt['TieuDe'];?>" title="<?=$row_tt['TieuDe'];?>" src="<?=$row_tt['UrlHinh'];?>" /></a>
						</div>
						<div class="right-trangloai">
							<h3><a href="<?php echo $row_tt['TieuDeKD']; ?>.html"><?php echo $row_tt['TieuDe']; ?></a></h3>
							<p><?php echo $qly_tin->cutString(strip_tags($row_tt['TomTat']), 160, '...'); ?></p>
						</div>
					</article> 
				<?php } ?>
				</div>
				
			</div>
			<div class="clear20"></div>
			<?php if($totalRows > $pageSize) { ?>
					<div class="phantrang max750">
						<?php $urlchinh = 'tag/'.$tukhoa.''; 

						?>
						<?php echo $qly_tin->pagesList1($urlchinh, $totalRows, $pageNum, $pageSize, 2); ?>
						<div class="clear20"></div>
					</div>
			<?php } ?>
			<div class="clear20"></div>
		</li>
		<li class="right"></li>
	</ul>
</div>
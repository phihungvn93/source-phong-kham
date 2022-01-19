<section class="leadBox box_1">
	<div class="main_box">
		<h3 class="mainColumnTitleH3">Đau nhức khớp</h3>
		<div class="namkhoa_r">
			<?php 
			$tinlq_2 = $qly_tin->ListTin_Where(73,-1, 0, 3, '', ' ORDER BY idTT Desc');
			if(mysql_num_rows($tinlq_2)>0) {
			?>
			<ul>
				<?php $count_news_index = 1;?>
		    	<?php  while($rowlq = mysql_fetch_assoc($tinlq_2)){ ?>
				<li>
					<div class="sub_nk_img">
						<a href="<?=$rowlq['TieuDeKD'];?>.html">
							<img alt="<?=$rowlq['TieuDeKD'];?>" src="<?=$rowlq['UrlHinh'];?>" />
						</a>
					</div>
					<div class="sub_nk_tit">
						<p><?php echo strip_tags($qly_tin->RutGon($rowlq['TieuDe'], 50, 50));?></p>
						<a href="<?=$rowlq['TieuDeKD'];?>.html" class="see_more">Chi tiết</a>
					</div>
				</li>
				<?php $count_news_index++; ?>
		    	<?php } ?>				
			</ul>
			<?php } ?>
		</div>
	</div>
</section>

<section class="leadBox box_1">
	<div class="main_box">
		<h3 class="mainColumnTitleH3">Đau mỏi vai gáy</h3>
		<div class="namkhoa_r">
			<?php 
			$tinlq_2 = $qly_tin->ListTin_Where(74,-1, 0, 3, '', ' ORDER BY idTT Desc');
			if(mysql_num_rows($tinlq_2)>0) {
			?>
			<ul>
				<?php $count_news_index = 1;?>
		    	<?php  while($rowlq = mysql_fetch_assoc($tinlq_2)){ ?>
				<li>
					<div class="sub_nk_img">
						<a href="<?=$rowlq['TieuDeKD'];?>.html">
							<img alt="<?=$rowlq['TieuDeKD'];?>" src="<?=$rowlq['UrlHinh'];?>" />
						</a>
					</div>
					<div class="sub_nk_tit">
						<p><?php echo strip_tags($qly_tin->RutGon($rowlq['TieuDe'], 50, 50));?></p>
						<a href="<?=$rowlq['TieuDeKD'];?>.html" class="see_more">Chi tiết</a>
					</div>
				</li>
				<?php $count_news_index++; ?>
		    	<?php } ?>				
			</ul>
			<?php } ?>
		</div>
	</div>
</section>

<section class="leadBox box_1">
	<div class="main_box">
		<h3 class="mainColumnTitleH3">Đau khớp tay</h3>
		<div class="namkhoa_r">
			<?php 
			$tinlq_2 = $qly_tin->ListTin_Where(75,-1, 0, 3, '', ' ORDER BY idTT Desc');
			if(mysql_num_rows($tinlq_2)>0) {
			?>
			<ul>
				<?php $count_news_index = 1;?>
		    	<?php  while($rowlq = mysql_fetch_assoc($tinlq_2)){ ?>
				<li>
					<div class="sub_nk_img">
						<a href="<?=$rowlq['TieuDeKD'];?>.html">
							<img alt="<?=$rowlq['TieuDeKD'];?>" src="<?=$rowlq['UrlHinh'];?>" />
						</a>
					</div>
					<div class="sub_nk_tit">
						<p><?php echo strip_tags($qly_tin->RutGon($rowlq['TieuDe'], 50, 50));?></p>
						<a href="<?=$rowlq['TieuDeKD'];?>.html" class="see_more">Chi tiết</a>
					</div>
				</li>
				<?php $count_news_index++; ?>
		    	<?php } ?>				
			</ul>
			<?php } ?>
		</div>
	</div>
</section>

<section class="leadBox box_1">
	<div class="main_box">
		<h3 class="mainColumnTitleH3">Đau khớp chân</h3>
		<div class="namkhoa_r">
			<?php 
			$tinlq_2 = $qly_tin->ListTin_Where(76,-1, 0, 3, '', ' ORDER BY idTT Desc');
			if(mysql_num_rows($tinlq_2)>0) {
			?>
			<ul>
				<?php $count_news_index = 1;?>
		    	<?php  while($rowlq = mysql_fetch_assoc($tinlq_2)){ ?>
				<li>
					<div class="sub_nk_img">
						<a href="<?=$rowlq['TieuDeKD'];?>.html">
							<img alt="<?=$rowlq['TieuDeKD'];?>" src="<?=$rowlq['UrlHinh'];?>" />
						</a>
					</div>
					<div class="sub_nk_tit">
						<p><?php echo strip_tags($qly_tin->RutGon($rowlq['TieuDe'], 50, 50));?></p>
						<a href="<?=$rowlq['TieuDeKD'];?>.html" class="see_more">Chi tiết</a>
					</div>
				</li>
				<?php $count_news_index++; ?>
		    	<?php } ?>				
			</ul>
			<?php } ?>
		</div>
	</div>
</section>

<section class="leadBox box_1">
	<div class="main_box">
		<h3 class="mainColumnTitleH3">Đau khớp cổ</h3>
		<div class="namkhoa_r">
			<?php 
			$tinlq_2 = $qly_tin->ListTin_Where(77,-1, 0, 3, '', ' ORDER BY idTT Desc');
			if(mysql_num_rows($tinlq_2)>0) {
			?>
			<ul>
				<?php $count_news_index = 1;?>
		    	<?php  while($rowlq = mysql_fetch_assoc($tinlq_2)){ ?>
				<li>
					<div class="sub_nk_img">
						<a href="<?=$rowlq['TieuDeKD'];?>.html">
							<img alt="<?=$rowlq['TieuDeKD'];?>" src="<?=$rowlq['UrlHinh'];?>" />
						</a>
					</div>
					<div class="sub_nk_tit">
						<p><?php echo strip_tags($qly_tin->RutGon($rowlq['TieuDe'], 50, 50));?></p>
						<a href="<?=$rowlq['TieuDeKD'];?>.html" class="see_more">Chi tiết</a>
					</div>
				</li>
				<?php $count_news_index++; ?>
		    	<?php } ?>				
			</ul>
			<?php } ?>
		</div>
	</div>
</section>

<section class="leadBox box_1">
	<div class="main_box">
		<h3 class="mainColumnTitleH3">Thoát vị đĩa đệm</h3>
		<div class="namkhoa_r">
			<?php 
			$tinlq_2 = $qly_tin->ListTin_Where(78,-1, 0, 3, '', ' ORDER BY idTT Desc');
			if(mysql_num_rows($tinlq_2)>0) {
			?>
			<ul>
				<?php $count_news_index = 1;?>
		    	<?php  while($rowlq = mysql_fetch_assoc($tinlq_2)){ ?>
				<li>
					<div class="sub_nk_img">
						<a href="<?=$rowlq['TieuDeKD'];?>.html">
							<img alt="<?=$rowlq['TieuDeKD'];?>" src="<?=$rowlq['UrlHinh'];?>" />
						</a>
					</div>
					<div class="sub_nk_tit">
						<p><?php echo strip_tags($qly_tin->RutGon($rowlq['TieuDe'], 50, 50));?></p>
						<a href="<?=$rowlq['TieuDeKD'];?>.html" class="see_more">Chi tiết</a>
					</div>
				</li>
				<?php $count_news_index++; ?>
		    	<?php } ?>				
			</ul>
			<?php } ?>
		</div>
	</div>
</section>

<section class="leadBox box_1">
	<div class="main_box">
		<h3 class="mainColumnTitleH3">Thoái hóa cột sống cổ</h3>
		<div class="namkhoa_r">
			<?php 
			$tinlq_2 = $qly_tin->ListTin_Where(79,-1, 0, 3, '', ' ORDER BY idTT Desc');
			if(mysql_num_rows($tinlq_2)>0) {
			?>
			<ul>
				<?php $count_news_index = 1;?>
		    	<?php  while($rowlq = mysql_fetch_assoc($tinlq_2)){ ?>
				<li>
					<div class="sub_nk_img">
						<a href="<?=$rowlq['TieuDeKD'];?>.html">
							<img alt="<?=$rowlq['TieuDeKD'];?>" src="<?=$rowlq['UrlHinh'];?>" />
						</a>
					</div>
					<div class="sub_nk_tit">
						<p><?php echo strip_tags($qly_tin->RutGon($rowlq['TieuDe'], 50, 50));?></p>
						<a href="<?=$rowlq['TieuDeKD'];?>.html" class="see_more">Chi tiết</a>
					</div>
				</li>
				<?php $count_news_index++; ?>
		    	<?php } ?>				
			</ul>
			<?php } ?>
		</div>
	</div>
</section>

<section class="leadBox box_1">
	<div class="main_box">
		<h3 class="mainColumnTitleH3">Thoái hóa cột sống lưng</h3>
		<div class="namkhoa_r">
			<?php 
			$tinlq_2 = $qly_tin->ListTin_Where(80,-1, 0, 3, '', ' ORDER BY idTT Desc');
			if(mysql_num_rows($tinlq_2)>0) {
			?>
			<ul>
				<?php $count_news_index = 1;?>
		    	<?php  while($rowlq = mysql_fetch_assoc($tinlq_2)){ ?>
				<li>
					<div class="sub_nk_img">
						<a href="<?=$rowlq['TieuDeKD'];?>.html">
							<img alt="<?=$rowlq['TieuDeKD'];?>" src="<?=$rowlq['UrlHinh'];?>" />
						</a>
					</div>
					<div class="sub_nk_tit">
						<p><?php echo strip_tags($qly_tin->RutGon($rowlq['TieuDe'], 50, 50));?></p>
						<a href="<?=$rowlq['TieuDeKD'];?>.html" class="see_more">Chi tiết</a>
					</div>
				</li>
				<?php $count_news_index++; ?>
		    	<?php } ?>				
			</ul>
			<?php } ?>
		</div>
	</div>
</section>
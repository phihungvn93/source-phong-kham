<div class="cnt03">
        <div class="main_cnt03 clearfix">
          <div class="cnt03_l">
            <h3>
              <span>Cảm nhận bệnh nhân</span>
              <a href="" class="ov_hover"><span class="btn_news"><img width="66" height="11" alt="" src="images/cnt03_news.png"></span></a>
            </h3>
            <div class="list_news">
	            <ul>
	            	<?php 
					    $tinmoi = $qly_tin->ListTin_Where(-1,72, 0, 4, '', ' ORDER BY idTT Desc');
					    while($row_tinmoi = mysql_fetch_assoc($tinmoi))
						{ 
					?>
	            	<li>
	            		<a href="<?php echo $row_tinmoi['TieuDeKD'].'.html';?>">
	            			<div class="img_list">
	            				<p><img src="<?php echo str_replace('hinhanh', '_thumbs/Images', $row_tinmoi['UrlHinh']); ?>" alt=""></p>
	            			</div>
	            			<div class="text_list"><?php echo strip_tags($qly_tin->RutGon($row_tinmoi['TieuDe'], 50, 50));?></div>
	            		</a>
	            	</li>
	            	<?php } ?>
	            </ul>
            </div>
            <p class="pt10"><a href="" target="_blank"><img src="images/cnt03_img03_off.gif" width="310" height="100" alt=""></a></p>
          </div>
          <!-- end cnt03_r -->
		  <div class="cnt03_r">
			<div id="news">
				<div class="inner">
					<div class="coltable">
						<div class="ccell">
							<div id="b01" class="news_btn"><span class="open">Bài viết nổi bật</span></div>
							<div id="b02" class="news_btn"><span>Bài viết mới</span></div>
							<div id="b03" class="news_btn"><span>Hỏi đáp</span></div></div>
						</div>

						<div id="news01" class="newsbox">
							<div class="columns coltable no_padding">
							<?php 
					            $tinmoi = $qly_tin->ListTin_Where(-1,72, 0, 4, '', ' ORDER BY idTT Desc');
					            while($row_tinmoi = mysql_fetch_assoc($tinmoi))
					        { 
					        ?>
								<div class="ccell wpct24">
									<div class="lef">
										<div class="thb">
											<div class="abs">
												<p><img src="<?php echo str_replace('hinhanh', '_thumbs/Images', $row_tinmoi['UrlHinh']); ?>" alt="" /></p>
											</div>
										</div>
										<span class="date"><?php echo date("d/m/Y",strtotime($row_tinmoi['NgayDang'])); ?></span>
									</div>
									<div class="rig">
										<div class="tit"><a href="<?php echo $row_tinmoi['TieuDeKD'].'.html';?>">★ <?php echo strip_tags($qly_tin->RutGon($row_tinmoi['TieuDe'], 50, 50));?></a></div>
										<p>
											<?php echo strip_tags($qly_tin->RutGon($row_tinmoi['TomTat'], 100, 100));?>
										</p>
									</div><!-- rig -->
								</div><!-- ccell -->
								<div class="ccell wpct01">&nbsp;</div>
							<?php } ?>
							</div><!-- coltable -->
						</div><!-- newsbox -->

						<div id="news02" class="newsbox">
							<div class="columns coltable no_padding">
							<?php 
					            $tinmoi = $qly_tin->ListTin_Where(-1,72, 0, 4, '', ' ORDER BY idTT Desc');
					            while($row_tinmoi = mysql_fetch_assoc($tinmoi))
					        { 
					        ?>
								<div class="ccell wpct24">
									<div class="lef">
										<div class="thb">
											<div class="abs">
												<p><img src="<?php echo str_replace('hinhanh', '_thumbs/Images', $row_tinmoi['UrlHinh']); ?>" alt="" /></p>
											</div>
										</div>
										<span class="date"><?php echo date("d/m/Y",strtotime($row_tinmoi['NgayDang'])); ?></span>
									</div>
									<div class="rig">
										<div class="tit"><a href="<?php echo $row_tinmoi['TieuDeKD'].'.html';?>">★ <?php echo strip_tags($qly_tin->RutGon($row_tinmoi['TieuDe'], 50, 50));?></a></div>
										<p>
											<?php echo strip_tags($qly_tin->RutGon($row_tinmoi['TomTat'], 100, 100));?>
										</p>
									</div><!-- rig -->
								</div><!-- ccell -->
								<div class="ccell wpct01">&nbsp;</div>
							<?php } ?>
							</div><!-- coltable -->
						</div><!-- newsbox -->

						<div id="news03" class="newsbox">
							<div class="columns coltable no_padding">
							<?php 
					            $tinmoi = $qly_tin->ListTin_Where(-1,72, 0, 4, '', ' ORDER BY idTT Desc');
					            while($row_tinmoi = mysql_fetch_assoc($tinmoi))
					        { 
					        ?>
								<div class="ccell wpct24">
									<div class="lef">
										<div class="thb">
											<div class="abs">
												<p><img src="<?php echo str_replace('hinhanh', '_thumbs/Images', $row_tinmoi['UrlHinh']); ?>" alt="" /></p>
											</div>
										</div>
										<span class="date"><?php echo date("d/m/Y",strtotime($row_tinmoi['NgayDang'])); ?></span>
									</div>
									<div class="rig">
										<div class="tit"><a href="<?php echo $row_tinmoi['TieuDeKD'].'.html';?>">★ <?php echo strip_tags($qly_tin->RutGon($row_tinmoi['TieuDe'], 50, 50));?></a></div>
										<p>
											<?php echo strip_tags($qly_tin->RutGon($row_tinmoi['TomTat'], 100, 100));?>
										</p>
									</div><!-- rig -->
								</div><!-- ccell -->
								<div class="ccell wpct01">&nbsp;</div>
							<?php } ?>
							</div><!-- coltable -->
						</div><!-- newsbox -->
					</div>
					<a href=""><img src="images/cnt03_img02_off.jpg" width="610" height="100" alt=""></a>
				</div><!-- inner -->
			</div><!-- news -->
          </div>
          <!-- end cnt03_l -->
        </div>
</div><!-- /.cnt03 -->
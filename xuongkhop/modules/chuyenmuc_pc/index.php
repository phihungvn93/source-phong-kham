<section class="chuyenmuc">
	<div class="chuyenmuc-container w1000">
			<div class="chuyenmuc-danhmuccon">
				<ul class="list_ngang cha_xuongkhop">
					<li class="danhmuccondau-nhuc-khop" danhmuccon='danhmuccondau-nhuc-khop'>Đau nhức khớp</li>
					<li class="danhmuccondau-moi-vai-gay" danhmuccon='danhmuccondau-moi-vai-gay'>Đau mỏi vai gay</li>
					<li class="danhmuccondau-khop-tay" danhmuccon='danhmuccondau-khop-tay'>Đau khớp tay</li>
					<li class="danhmuccondau-khop-chan" danhmuccon='danhmuccondau-khop-chan'>Đau khớp chân</li>
					<li class="danhmuccondau-khop-co" danhmuccon='danhmuccondau-khop-co'>Đau khớp cổ</li>
					<li class="danhmucconthoat-vi-dia-dem" danhmuccon='danhmucconthoat-vi-dia-dem'>Thoát vị đĩa đệm</li>
					<li class="danhmucconthoai-hoa-cot-song-co" danhmuccon='danhmucconthoai-hoa-cot-song-co'>Thoái hóa cột sống cổ</li>
					<div class="clear"></div>
				</ul>
			</div>
			<div class="chuyemuc-baiviet">
					<div class="chuyenmuc-baiviet-item danhmuccondau-nhuc-khop">
						<div class="chuyenmuc-baiviet-item-hinh left">
							<div class="chuyenmuc-baiviet-item-hinh-img">
								<a href="" title=""><img src="images/tab/thoai-hoa-cot-song-lung.jpg" alt=""></a>
							</div>
							<div class="chuyenmuc-baiviet-item-hinh-icon">
								<ul class="dkhkih">
			                        <li><div class="absinf"></div><a href="" class="ttfkhi">Tư vấn ngay</a></li>
			                        <li><div class="acsinf"></div><a href="" class="ttfkhi">Đặt hẹn khám</a></li>
			                        <li><div class="adsinf"></div><a href="" class="ttfkhi">Tư vấn chi phí</a></li>
			                    </ul>
							</div>
						</div>
						<div class="chuyenmuc-baiviet-item-content left">
	                		<div class="namkhoa_r">
	                			<?php 
					            $tinlq_2 = $qly_tin->ListTin_Where(73,-1, 0, 6, '', ' ORDER BY idTT Desc');
					            if(mysql_num_rows($tinlq_2)>0) {
					            ?>
								<ul>
									<?php $count_news_index = 1;?>
		                			<?php  while($rowlq = mysql_fetch_assoc($tinlq_2)){ ?>
									<li>
										<div class="sub_nk_img">
											<a href="<?=$rowlq['TieuDeKD'];?>.html">
												<img alt="<?=$rowlq['TieuDeKD'];?>" src="<?=$rowlq['UrlHinh'];?>">
											</a>
										</div>
										<div class="sub_nk_tit">
											<p class="tit_tab">
												<a href="<?=$rowlq['TieuDeKD'];?>.html"><?php echo strip_tags($qly_tin->RutGon($rowlq['TieuDe'], 35, 35));?></a>
											</p>
											<p class="des_tab">
												<?php echo strip_tags($qly_tin->RutGon($rowlq['TomTat'], 25, 25));?>
											</p>
											<a href="<?=$rowlq['TieuDeKD'];?>.html" class="see_more">Chi tiết</a>
										</div>
									</li>
									<?php $count_news_index++; ?>
		                			<?php } ?>
								</ul>
								<?php } ?>
							</div>
						</div>
						<div class="clear"></div>
					</div>

					<div class="chuyenmuc-baiviet-item danhmuccondau-moi-vai-gay">
						<div class="chuyenmuc-baiviet-item-hinh left">
							<div class="chuyenmuc-baiviet-item-hinh-img">
								<a href="" title=""><img src="images/tab/thoai-hoa-cot-song-co.jpg" alt=""></a>
							</div>
							<div class="chuyenmuc-baiviet-item-hinh-icon">
								<ul class="dkhkih">
		                            <li><div class="absinf"></div><a href="" class="ttfkhi">Tư vấn ngay</a></li>
		                            <li><div class="acsinf"></div><a href="" class="ttfkhi">Đặt hẹn khám</a></li>
		                            <li><div class="adsinf"></div><a href="" class="ttfkhi">Tư vấn chi phí</a></li>
		                        </ul>
							</div>
						</div>
						<div class="chuyenmuc-baiviet-item-content left">
	                		<div class="namkhoa_r">
	                			<?php 
					            $tinlq_2 = $qly_tin->ListTin_Where(74,-1, 0, 6, '', ' ORDER BY idTT Desc');
					            if(mysql_num_rows($tinlq_2)>0) {
					            ?>
								<ul>
									<?php $count_news_index = 1;?>
		                			<?php  while($rowlq = mysql_fetch_assoc($tinlq_2)){ ?>
									<li>
										<div class="sub_nk_img">
											<a href="<?=$rowlq['TieuDeKD'];?>.html">
												<img alt="<?=$rowlq['TieuDeKD'];?>" src="<?=$rowlq['UrlHinh'];?>">
											</a>
										</div>
										<div class="sub_nk_tit">
											<p class="tit_tab">
												<a href="<?=$rowlq['TieuDeKD'];?>.html"><?php echo strip_tags($qly_tin->RutGon($rowlq['TieuDe'], 35, 35));?></a>
											</p>
											<p class="des_tab">
												<?php echo strip_tags($qly_tin->RutGon($rowlq['TomTat'], 25, 25));?>
											</p>
											<a href="<?=$rowlq['TieuDeKD'];?>.html" class="see_more">Chi tiết</a>
										</div>
									</li>
									<?php $count_news_index++; ?>
		                			<?php } ?>
								</ul>
								<?php } ?>
							</div>
						</div>
						<div class="clear"></div>
					</div>

					<div class="chuyenmuc-baiviet-item danhmuccondau-khop-tay">
						<div class="chuyenmuc-baiviet-item-hinh left">
							<div class="chuyenmuc-baiviet-item-hinh-img">
								<a href="" title=""><img src="images/tab/thoat-vi-dia-dem.jpg" alt=""></a>
							</div>
							<div class="chuyenmuc-baiviet-item-hinh-icon">
								<ul class="dkhkih">
		                            <li><div class="absinf"></div><a href="" class="ttfkhi">Tư vấn ngay</a></li>
		                            <li><div class="acsinf"></div><a href="" class="ttfkhi">Đặt hẹn khám</a></li>
		                            <li><div class="adsinf"></div><a href="" class="ttfkhi">Tư vấn chi phí</a></li>
		                        </ul>
							</div>
						</div>
						<div class="chuyenmuc-baiviet-item-content left">
	                		<div class="namkhoa_r">
	                			<?php 
					            $tinlq_2 = $qly_tin->ListTin_Where(75,-1, 0, 6, '', ' ORDER BY idTT Desc');
					            if(mysql_num_rows($tinlq_2)>0) {
					            ?>
								<ul>
									<?php $count_news_index = 1;?>
		                			<?php  while($rowlq = mysql_fetch_assoc($tinlq_2)){ ?>
									<li>
										<div class="sub_nk_img">
											<a href="<?=$rowlq['TieuDeKD'];?>.html">
												<img alt="<?=$rowlq['TieuDeKD'];?>" src="<?=$rowlq['UrlHinh'];?>">
											</a>
										</div>
										<div class="sub_nk_tit">
											<p class="tit_tab">
												<a href="<?=$rowlq['TieuDeKD'];?>.html"><?php echo strip_tags($qly_tin->RutGon($rowlq['TieuDe'], 35, 35));?></a>
											</p>
											<p class="des_tab">
												<?php echo strip_tags($qly_tin->RutGon($rowlq['TomTat'], 25, 25));?>
											</p>
											<a href="<?=$rowlq['TieuDeKD'];?>.html" class="see_more">Chi tiết</a>
										</div>
									</li>
									<?php $count_news_index++; ?>
		                			<?php } ?>
								</ul>
								<?php } ?>
							</div>
						</div>
						<div class="clear"></div>
					</div>

					<div class="chuyenmuc-baiviet-item danhmuccondau-khop-chan">
						<div class="chuyenmuc-baiviet-item-hinh left">
							<div class="chuyenmuc-baiviet-item-hinh-img">
								<a href="" title=""><img src="images/tab/thoat-vi-dia-dem.jpg" alt=""></a>
							</div>
							<div class="chuyenmuc-baiviet-item-hinh-icon">
								<ul class="dkhkih">
		                            <li><div class="absinf"></div><a href="" class="ttfkhi">Tư vấn ngay</a></li>
		                            <li><div class="acsinf"></div><a href="" class="ttfkhi">Đặt hẹn khám</a></li>
		                            <li><div class="adsinf"></div><a href="" class="ttfkhi">Tư vấn chi phí</a></li>
		                        </ul>
							</div>
						</div>
						<div class="chuyenmuc-baiviet-item-content left">
	                		<div class="namkhoa_r">
	                			<?php 
					            $tinlq_2 = $qly_tin->ListTin_Where(76,-1, 0, 6, '', ' ORDER BY idTT Desc');
					            if(mysql_num_rows($tinlq_2)>0) {
					            ?>
								<ul>
									<?php $count_news_index = 1;?>
		                			<?php  while($rowlq = mysql_fetch_assoc($tinlq_2)){ ?>
									<li>
										<div class="sub_nk_img">
											<a href="<?=$rowlq['TieuDeKD'];?>.html">
												<img alt="<?=$rowlq['TieuDeKD'];?>" src="<?=$rowlq['UrlHinh'];?>">
											</a>
										</div>
										<div class="sub_nk_tit">
											<p class="tit_tab">
												<a href="<?=$rowlq['TieuDeKD'];?>.html"><?php echo strip_tags($qly_tin->RutGon($rowlq['TieuDe'], 35, 35));?></a>
											</p>
											<p class="des_tab">
												<?php echo strip_tags($qly_tin->RutGon($rowlq['TomTat'], 25, 25));?>
											</p>
											<a href="<?=$rowlq['TieuDeKD'];?>.html" class="see_more">Chi tiết</a>
										</div>
									</li>
									<?php $count_news_index++; ?>
		                			<?php } ?>
								</ul>
								<?php } ?>
							</div>
						</div>
						<div class="clear"></div>
					</div>

					<div class="chuyenmuc-baiviet-item danhmuccondau-khop-co">
						<div class="chuyenmuc-baiviet-item-hinh left">
							<div class="chuyenmuc-baiviet-item-hinh-img">
								<a href="" title=""><img src="images/tab/thoat-vi-dia-dem.jpg" alt=""></a>
							</div>
							<div class="chuyenmuc-baiviet-item-hinh-icon">
								<ul class="dkhkih">
		                            <li><div class="absinf"></div><a href="" class="ttfkhi">Tư vấn ngay</a></li>
		                            <li><div class="acsinf"></div><a href="" class="ttfkhi">Đặt hẹn khám</a></li>
		                            <li><div class="adsinf"></div><a href="" class="ttfkhi">Tư vấn chi phí</a></li>
		                        </ul>
							</div>
						</div>
						<div class="chuyenmuc-baiviet-item-content left">
	                		<div class="namkhoa_r">
	                			<?php 
					            $tinlq_2 = $qly_tin->ListTin_Where(77,-1, 0, 6, '', ' ORDER BY idTT Desc');
					            if(mysql_num_rows($tinlq_2)>0) {
					            ?>
								<ul>
									<?php $count_news_index = 1;?>
		                			<?php  while($rowlq = mysql_fetch_assoc($tinlq_2)){ ?>
									<li>
										<div class="sub_nk_img">
											<a href="<?=$rowlq['TieuDeKD'];?>.html">
												<img alt="<?=$rowlq['TieuDeKD'];?>" src="<?=$rowlq['UrlHinh'];?>">
											</a>
										</div>
										<div class="sub_nk_tit">
											<p class="tit_tab">
												<a href="<?=$rowlq['TieuDeKD'];?>.html"><?php echo strip_tags($qly_tin->RutGon($rowlq['TieuDe'], 35, 35));?></a>
											</p>
											<p class="des_tab">
												<?php echo strip_tags($qly_tin->RutGon($rowlq['TomTat'], 25, 25));?>
											</p>
											<a href="<?=$rowlq['TieuDeKD'];?>.html" class="see_more">Chi tiết</a>
										</div>
									</li>
									<?php $count_news_index++; ?>
		                			<?php } ?>
								</ul>
								<?php } ?>
							</div>
						</div>
						<div class="clear"></div>
					</div>

					<div class="chuyenmuc-baiviet-item danhmucconthoat-vi-dia-dem">
						<div class="chuyenmuc-baiviet-item-hinh left">
							<div class="chuyenmuc-baiviet-item-hinh-img">
								<a href="" title=""><img src="images/tab/thoat-vi-dia-dem.jpg" alt=""></a>
							</div>
							<div class="chuyenmuc-baiviet-item-hinh-icon">
								<ul class="dkhkih">
		                            <li><div class="absinf"></div><a href="" class="ttfkhi">Tư vấn ngay</a></li>
		                            <li><div class="acsinf"></div><a href="" class="ttfkhi">Đặt hẹn khám</a></li>
		                            <li><div class="adsinf"></div><a href="" class="ttfkhi">Tư vấn chi phí</a></li>
		                        </ul>
							</div>
						</div>
						<div class="chuyenmuc-baiviet-item-content left">
	                		<div class="namkhoa_r">
	                			<?php 
					            $tinlq_2 = $qly_tin->ListTin_Where(78,-1, 0, 6, '', ' ORDER BY idTT Desc');
					            if(mysql_num_rows($tinlq_2)>0) {
					            ?>
								<ul>
									<?php $count_news_index = 1;?>
		                			<?php  while($rowlq = mysql_fetch_assoc($tinlq_2)){ ?>
									<li>
										<div class="sub_nk_img">
											<a href="<?=$rowlq['TieuDeKD'];?>.html">
												<img alt="<?=$rowlq['TieuDeKD'];?>" src="<?=$rowlq['UrlHinh'];?>">
											</a>
										</div>
										<div class="sub_nk_tit">
											<p class="tit_tab">
												<a href="<?=$rowlq['TieuDeKD'];?>.html"><?php echo strip_tags($qly_tin->RutGon($rowlq['TieuDe'], 35, 35));?></a>
											</p>
											<p class="des_tab">
												<?php echo strip_tags($qly_tin->RutGon($rowlq['TomTat'], 25, 25));?>
											</p>
											<a href="<?=$rowlq['TieuDeKD'];?>.html" class="see_more">Chi tiết</a>
										</div>
									</li>
									<?php $count_news_index++; ?>
		                			<?php } ?>
								</ul>
								<?php } ?>
							</div>
						</div>
						<div class="clear"></div>
					</div>

					<div class="chuyenmuc-baiviet-item danhmucconthoai-hoa-cot-song-co">
						<div class="chuyenmuc-baiviet-item-hinh left">
							<div class="chuyenmuc-baiviet-item-hinh-img">
								<a href="" title=""><img src="images/tab/thoat-vi-dia-dem.jpg" alt=""></a>
							</div>
							<div class="chuyenmuc-baiviet-item-hinh-icon">
								<ul class="dkhkih">
		                            <li><div class="absinf"></div><a href="" class="ttfkhi">Tư vấn ngay</a></li>
		                            <li><div class="acsinf"></div><a href="" class="ttfkhi">Đặt hẹn khám</a></li>
		                            <li><div class="adsinf"></div><a href="" class="ttfkhi">Tư vấn chi phí</a></li>
		                        </ul>
							</div>
						</div>
						<div class="chuyenmuc-baiviet-item-content left">
	                		<div class="namkhoa_r">
	                			<?php 
					            $tinlq_2 = $qly_tin->ListTin_Where(79,-1, 0, 6, '', ' ORDER BY idTT Desc');
					            if(mysql_num_rows($tinlq_2)>0) {
					            ?>
								<ul>
									<?php $count_news_index = 1;?>
		                			<?php  while($rowlq = mysql_fetch_assoc($tinlq_2)){ ?>
									<li>
										<div class="sub_nk_img">
											<a href="<?=$rowlq['TieuDeKD'];?>.html">
												<img alt="<?=$rowlq['TieuDeKD'];?>" src="<?=$rowlq['UrlHinh'];?>">
											</a>
										</div>
										<div class="sub_nk_tit">
											<p class="tit_tab">
												<a href="<?=$rowlq['TieuDeKD'];?>.html"><?php echo strip_tags($qly_tin->RutGon($rowlq['TieuDe'], 35, 35));?></a>
											</p>
											<p class="des_tab">
												<?php echo strip_tags($qly_tin->RutGon($rowlq['TomTat'], 25, 25));?>
											</p>
											<a href="<?=$rowlq['TieuDeKD'];?>.html" class="see_more">Chi tiết</a>
										</div>
									</li>
									<?php $count_news_index++; ?>
		                			<?php } ?>
								</ul>
								<?php } ?>
							</div>
						</div>
						<div class="clear"></div>
					</div>

					<div class="clear"></div>
			</div>
		</div>
	</section><!-- /.chuyenmuc -->
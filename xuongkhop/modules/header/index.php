<header class="globalHeader">
	<div class="globalHeader_pc">
		<div class="globalHeader_inner">
			<p class="globalHeader_logo"><a href=""><img src="images/header_logo_01.png" alt=""></a></p>
			<nav class="globalNav">
				<p class="globalNav_logo"><a href=""><img src="images/header_logo_02.png" alt=""></a></p>
				<?php include 'modules/menu/index.php'; ?>
			</nav><!-- /.globalNav -->
			<div class="globalHeader_utilityNav">
				<ul id="hnav">
					<li><a href="">Giới thiệu</a></li>
					<li><a href="">Bài thuốc hay</a></li>
					<li><a href="">Vật lý trị liệu</a></li>
					<li><a href="">Cảm nhận bệnh nhân</a></li>
					<li><a href="">Liên hệ</a></li>
				</ul>
				<p class="globalHeader_utilityNav_item linkTxt00"><a href="" class="linkTxt00">Tư vấn bác sĩ</a></p>
				<div class="globalHeader_search">
					<form name="SS_searchForm2" id="SS_searchForm2" action="" method="get">
						<input type="text" name="query" value="" id="SS_searchQuery2" class="globalHeader_searchInput" maxlength="100" autocomplete="off" placeholder="Từ khóa cần tìm...">
						<input type="submit" name="submit" value="Search" id="SS_searchSubmit2">
					</form>
				</div><!-- /.globalHeader_search -->
				<p class="globalHeader_utilityNav_item linkBtn"><a href="">Đặt hẹn khám online</a></p>
			</div>
		</div>
	</div><!-- /.globalHeader_pc -->

	<div class="globalHeader_sp">
		<div class="globalHeader_inner">
			<div class="globalHeader_fixedArea">
				<div class="globalHeader_logo"><a href=""><img src="images/header_logo_01_sp.png" alt=""></a></div>
				<div class="globalHeader_phone">
					<form method="post" action="http://du-lieu-khach-hang.com/conghoa/phone/api.php">
			          	<input type="hidden" name="Web" value="<?php echo $actual_link;?>">
			            <input type="text" id="SoDT" name="SoDT" class="input_no" placeholder="Nhập số điện thoại...">
			            <input class="btn_send" type="submit" value="Gửi đi" name="btn_send">
			        </form>
				</div>
				<div class="globalHeader_menuOpen"></div>
			</div>
			<div class="globalHeader_bg"></div>
			<div class="globalHeader_slideArea">
				<div class="globalHeader_menuClose"></div>
				<div class="globalHeader_slideArea_scrollArea">
					<nav class="globalNav">
						<ul class="globalNav_items">
							<li class="globalNav_item"><a href="">Trang chủ</a></li>
							<li class="globalNav_item"><a href="">Giới thiệu</a></li>
							<li class="globalNav_item">
								<a href="benh-xa-hoi/" title="Bệnh xã hội">Danh mục bệnh xương khớp</a>
								<ul class="globalSubNav_items">
									<?php
						                $cap2_bt = $qly_loai->ListLoai(1, 1, 72,-1);
						                while($row_bt = mysql_fetch_assoc($cap2_bt)){
						            ?>
									<li class="globalSubNav_item">
										<a href="<?php echo $row_bt['TieuDeKD'].'/'; ?>" title="<?php echo $row_bt['TieuDe']; ?>">
											<?php echo $row_bt['TieuDe']; ?>
										</a>
									</li>
									<?php } ?>
								</ul>
							</li>	
							<li class="globalNav_item"><a href="">Cảm nhận bệnh nhân</a></li>
							<li class="globalNav_item"><a href="">Liên hệ</a></li>		
							<li class="globalNav_item recruit"><a href="" target="_blank">Đăng ký khám</a></li>
						</ul>
					<!-- /.globalNav --></nav>
					<div class="globalHeader_utilityNav">
						<div class="globalHeader_search">
							<form name="SS_searchForm2" id="SS_searchForm2" action="" method="get">
								<input type="text" name="query" value="" id="SS_searchQuery2" class="globalHeader_searchInput" maxlength="100" autocomplete="off" placeholder="Tìm kiếm...">
								<input type="submit" name="submit" value="Search" id="SS_searchSubmit2">
							</form>
						</div><!-- /.globalHeader_search -->
						<p class="globalHeader_utilityNav_item linkBtn brown"><a href="">Đặt hẹn khám</a></p>
						<p class="globalHeader_utilityNav_item linkTxt00 wht alignCenter">
							Giờ làm: 8h00 ÷ 21h00 tất cả các ngày trong tuần cả chủ nhật và ngày lễ
						</p>
					</div>
				</div>
			</div>

		</div>
	</div><!-- /.globalHeader_sp -->

	<ul class="social">
	    <li class="zalo"><a href="https://zalo.me/2209792910396742190" target="_balnk"><img src="images/zalo_social.gif" alt=""><span>Chat zalo</span></a></li>
	    <li class="fb"><a href="https://www.messenger.com/t/1712536808958002" target="_balnk"><img src="images/fb_social.gif" alt=""><span>Chat Facebook</span></a></li>
	</ul>

</header><!-- /.globalHeader -->
<section id="form_dh">
		<div class="main_formDH">
			<div class="col_dh_l">
				<p class="txt_camket">Để lại thông tin chúng tôi sẽ <strong>Gọi lại cho bạn miễn phí</strong>. Cam kết thông tin của bạn được bảo mật tuyệt đối !!!</p>
				<form action="http://du-lieu-khach-hang.com/conghoa/phone/api.php" method="post">
					<input type="hidden" name="Web" value="<?php echo $actual_link;?>">
					<div class="form_dh_l">
						<span>Họ tên</span>
						<input type="text" name="TenBenhNhan" id="TenBenhNhan" placeholder="Nhập họ tên...">
						<span>Điện thoại</span>
						<input type="text" name="SoDT" id="SoDT" placeholder="Nhập số điện thoại...">
					</div>
					<div class="form_dh_r">
						<span>Yêu cầu</span>
						<textarea name="LoaiBenh" id="LoaiBenh" placeholder="Nhập nội dung..."></textarea>
					</div>
					<p><button type="submit" class="btn_dathen">Gửi thông tin</button></p>
				</form>
			</div>
			<div class="col_dh_r">
				<img src="images/col_dh_r_img.png" alt="">
			</div>
		</div>
</section><!-- /#form_dh -->
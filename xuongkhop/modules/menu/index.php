<ul class="globalNav_items">
	<li class="globalNav_item"><a href="">Trang chủ</a></li>
	<li class="globalNav_item"><a href="gioi-thieu.html">Giới thiệu</a></li>
	<li class="globalNav_item">
		<a href="">Bệnh xương khớp</a>
		<ul class="globalSubNav_items">
			<?php
                $cap2_bt = $qly_loai->ListLoai(1, 1, 72,-1);
                while($row_bt = mysql_fetch_assoc($cap2_bt)){
            ?>
			<li class="globalSubNav_item">
				<a href="<?php echo $row_bt['TieuDeKD'].'/'; ?>" title="<?php echo $row_bt['TieuDe']; ?>">
					<p><span><?php echo $row_bt['TieuDe']; ?></span></p>
				</a>
			</li>
			<?php } ?>
		</ul>
	</li>
	<li class="globalNav_item"><a href="">Cảm nhận bệnh nhân</a></li>
	<li class="globalNav_item"><a href="">Liên hệ</a></li>
</ul>
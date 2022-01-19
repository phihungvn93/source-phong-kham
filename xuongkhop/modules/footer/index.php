<footer class="globalFooter">
	<div class="globalFooter_inner">
		<ul class="globalFooter_links">
			<?php
                $cap2_bt = $qly_loai->ListLoai(1, 1, 72,-1);
                while($row_bt = mysql_fetch_assoc($cap2_bt)){
          	?>
          		<li class="globalFooter_links_item"><a href="<?php echo $row_bt['TieuDeKD'].'/'; ?>" title="<?php echo $row_bt['TieuDe']; ?>"><?php echo $row_bt['TieuDe']; ?></a></li>
          	<?php } ?>
		</ul>
		<div class="globalFooter_logoBox">
			<div class="globalFooter_logo"><a href=""><img src="images/header_logo_01.png" alt=""></a></div>
			<div class="float_r">
				<div class="notes_fo">Kết quả điều trị tùy thuộc vào cơ địa mỗi người, do đó bệnh nhân nên đến thăm khám trực tiếp để đạt được hiệu quả điều trị cao nhất.</div>
				<p><span>Giờ khám bệnh:</span> 08h00 ~ 21h00 tất cả các ngày trong tuần</p>
				<p><span>Cả chủ nhật và ngày lễ</span></p>
				<ul class="sns_link">
					<li><a href="https://www.messenger.com/t/1712536808958002" target="_blank"><img class="mr10 btn" src="images/fb_page_btn_off.png" alt=""></a></li>
					<li><a href="https://zalo.me/2209792910396742190" target="_blank"><img class="mr10 btn" src="images/foot_blog_btn_off.png" alt=""></a></li>
					<li><a href=""><img class="btn" src="images/foot_tv_btn_off.png" alt=""></a></li>
				</ul>
			</div>
		</div>
    </div>
    <!--<div class="f-map">
      	<div id="map"></div>
	</div>-->
	<p class="globalFooter_copyright">Copyright &copy; Chuyên khoa bệnh xương khớp. All rights reserved.</p>
	<!--<p id="globalFooter_toTopBtn"><a href="#top"></a></p>-->
</footer><!-- /.globalFooter -->
<p class="sbanner"><a href=""><img src="images/sbanner_off.jpg" width="155" height="130" alt=""></a></p>

<?php
	if(is_mobile()){?>
<div id="fixfooter">
    <ul>
        <li id="acr_btn"><img src="images/sp_acrbtn_dathen.jpg" width="auto" height="45px" alt=""></li>
        <li><a href="tel:0362689810"><img src="images/sp_fix01.jpg" width="auto" height="45px" alt="tel:02838-495-888"></a></li>
        <li><a href=""><img src="images/sp_fix02.jpg" width="auto" height="45px" alt=""></a></li>
    </ul>
</div><!-- /#fixfooter -->
<?php }?>
<a href="tel:02838495888" class="tbd-phong-a"><div class="alo-phone"><div class="alo-ph-circle"></div><div class="alo-ph-circle-fill"></div><div class="alo-ph-img-circle delaiso"></div></div></a>
<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>

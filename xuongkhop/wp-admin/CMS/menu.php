<?php 
	require_once "checklogin.php";
	require_once "class_quantri.php";
	$qt =  new quantri;
?>
<script type="text/javascript">

		$(document).ready(function() {

			// Store variables

			var accordion_head = $('.accordion > li > a'),
				accordion_body = $('.accordion li > .sub-menu');

			// Open the first tab on load

            if ($.cookie('kaka')>0){
                var menu = $.cookie('kaka');
                var menu_hien = '#'+menu+' a';
                $(menu_hien).addClass('active').next().slideDown('normal');
            }
            else
		      	$('#1 a').addClass('active').next().slideDown('normal');

			// Click function

			accordion_head.on('click', function(event) {

				// Disable header links

				event.preventDefault();

				// Show and hide the tabs on click

				if ($(this).attr('class') != 'active'){
					accordion_body.slideUp('normal');
					$(this).next().stop(true,true).slideToggle('normal');
					accordion_head.removeClass('active');
					$(this).addClass('active');
				}

			});

		});

        function luu(menu){
            $.cookie('kaka',menu,{expires:7,path:'/'});
        }
	</script>
<div id="wrapper-250">

		<ul class="accordion">
			<li id="1" class="files">
				<a href="#one">Danh Mục</a>
				<ul class="sub-menu">
					<li><a onclick="luu(1)" href="main.php"><em>01</em>Trang Thống Kê</a></li>
                    <li><a  onclick="luu(1)" href="main.php?p=dh_xem"><em>01</em>Danh Sách Đặt Hẹn<span></span></a></li>
				</ul>
			</li>           	
		</ul>

	</div>


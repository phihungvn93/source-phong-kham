
;(function($) {
	({
		init: function(){
			var self = this;
			$(function(){
				self.setTabHover();
				self.setShockClick();
				self.setTabClick();
			});
			self.setNewsScrollbar();
		},

		setTabHover : function(){
			$($(".chuyenmuc-danhmuccha ul li h3")[0]).addClass('activemenucha');
		    $($(".chuyenmuc-danhmuccon ul li")[0]).addClass('activemenucon');
		    $($(".chuyenmuc-danhmuccon ul")[0]).css('display', 'block');
		    $($('.chuyemuc-baiviet').children()[0]).css('display', 'block');


		    $(".chuyenmuc-danhmuccha ul li h3").hover(function() {
		        var danhmuccha = $(this).attr('danhmuccha');
		        var danhmuccon = $($(this).parent().parent().parent().parent().find('.chuyenmuc-danhmuccon').children('.'+danhmuccha).children()[0]).attr('danhmuccon');
		        $(".chuyenmuc-danhmuccha ul li h3").removeClass('activemenucha');
		        $(this).parent().parent().parent().parent().find('.chuyemuc-baiviet').children().css('display', 'none');
		        $(".chuyenmuc-danhmuccon ul").css('display', 'none');
		        $(this).parent().parent().parent().parent().find('.chuyenmuc-danhmuccon').children('.'+danhmuccha).children().removeClass('activemenucon');
		        $($(this).parent().parent().parent().parent().find('.chuyenmuc-danhmuccon').children('.'+danhmuccha).children()[0]).addClass('activemenucon');
		        $(this).parent().children('.'+danhmuccha).addClass('activemenucha');
		        $(this).parent().parent().parent().parent().find('.chuyenmuc-danhmuccon').children('.'+danhmuccha).css('display', 'block');
		        $(this).parent().parent().parent().parent().find('.chuyemuc-baiviet').children('.'+danhmuccon).css('display', 'block');
		        console.log($(this).parent().parent().parent().parent().find('.chuyemuc-baiviet').children('.'+danhmuccon));
		    });

		    $(".chuyenmuc-danhmuccon ul li").hover(function() {
		        var danhmuccon = $(this).attr('danhmuccon');
		        $(this).parent().children().removeClass('activemenucon');
		        $(this).parent().children('.'+danhmuccon).addClass('activemenucon');
		        $('.chuyemuc-baiviet').children().css('display', 'none');
		        $(this).parent().parent().parent().find('.chuyemuc-baiviet').children('.'+danhmuccon).css('display', 'block');
		    });
		},

		setShockClick : function(){
			$(".shock").each(function(){
				$(this).wrap("<div class='shock_wrap'></div>");
			})
			$(".shock_wrap").append('<div class="shock_block"><span>Hình ảnh có nội dung gây shock !! Cân nhắc trước khi xem <div style="clear:both;height:7%"></div><div style="text-align:center;display:block"><a class="shock_click" href="#">Click vào xem</a></div></div></div>');
			$(".shock_click").click(function(){
				$(this).parent().parent().parent().animate({"opacity":0},500);
				return false;
			});
		},

		setTabClick : function(){
			jQuery("#news #b01").on('click',function(){
				jQuery(".newsbox").fadeOut(0);
			    jQuery("#news01").fadeIn(800);
				jQuery("#news span").removeClass("open");
				jQuery("#news #b01 span").addClass("open");
		    });
			jQuery("#news #b02").on('click',function(){
				jQuery(".newsbox").fadeOut(0);
			    jQuery("#news02").fadeIn(800);
				jQuery("#news span").removeClass("open");
				jQuery("#news #b02 span").addClass("open");
		    });
			jQuery("#news #b03").on('click',function(){
				jQuery(".newsbox").fadeOut(0);
		     	jQuery("#news03").fadeIn(800);
			 	jQuery("#news span").removeClass("open");
			 	jQuery("#news #b03 span").addClass("open");
		    });
		},

	}).init();
})(jQuery);









/* ==================================================================
   Script.js
   ================================================================== */

/* 関数 ------------------------------------------------------------- */

$(function() {
	// ウインドウ幅取得
	var windowWidth;
	function getWindowWidth() {
		return window.innerWidth ? window.innerWidth: $(window).width();
	}
	// 表示モード取得（ウインドウ幅768px以下→sp、769px以上→pc）
	var viewMode;
	function getViewMode() {
		return (getWindowWidth() > 768) ? 'pc' : 'sp';
	}
	// PC向けヘッダ表示位置調整
	var headerHeight = 126;
	var headerNavHeight = 57;
	function headerSet() {
		if(getViewMode() === 'pc' && $(window).scrollTop() > headerHeight) {
			$('header').addClass('fixed').stop().animate({'top' : -(headerHeight - headerNavHeight) + 'px'}, 'slow');
			$('header').css({'left' : -$(window).scrollLeft()});
		} else if(getWindowWidth() > 768 && $(window).scrollTop() < headerNavHeight) {
			$('header').stop().removeClass('fixed').removeAttr('style');
		}
	}
	// PC向け「トップへ戻る」ボタン表示位置調整
	function setToTopBtn() {
		var btn = $('#globalFooter_toTopBtn');
		var footerPositionY = $('.globalFooter').offset().top;
		var offsetY = $(window).scrollTop() + $(window).height();
		if(viewMode === 'pc' && offsetY > footerPositionY) {
				$(btn).css({'bottom' : (offsetY - footerPositionY + 10) + 'px'});
		} else {
			$(btn).removeAttr('style');
		}
	}
	// Andoroid 4.4以前の標準ブラウザかどうかを判定
	function isOldAndroidBrowser() {
		var ua = (navigator.userAgent).toLowerCase();
		if(ua.indexOf('android') > 0 && ua.indexOf('linux; u') > 0 && ua.indexOf('chrome') === -1) {
			var version = parseFloat(ua.slice(ua.indexOf('android') + 8));
			if(version < 4.4) { return true; }
		}
		return false;
	}
	// スライドの高さを設定
	function setSlideHeight() {
		if(getViewMode() === 'sp') {
			var image = new Image();
			image.src = $('.slide:visible img.onlySP').attr('src');
			var slideWrapperHeight = Math.round(getWindowWidth() / image.width * image.height);
			$('.slideWrapper').css({'width' : '100%', 'height' : slideWrapperHeight + 'px'});
		} else {
			$('.slideWrapper').css({'width' : '1300px', 'height' : '450px'});
		}
	}
	// サブメニュー（メガドロップダウンメニュー）の左右の余白を設定
	function setSubMenuMargin() {
		if(getViewMode() === 'pc') {
			var subMenuMargin = ($('html').prop('clientWidth') - 950) / 2;
			if($('html').prop('clientWidth') < 1000) { subMenuMargin = 25; }
			$('.globalSubNav_items').css({
				'margin-left' : -subMenuMargin,
				'margin-right' : -subMenuMargin,
				'padding-left' : subMenuMargin,
				'padding-right' : subMenuMargin
			});
		} else {
			$('.globalSubNav_items').removeAttr('style');
		}
	}
	// recommendセクションの順序を変更
	function setRecommendOrder() {
		if(getViewMode() === 'pc') {
			$('#recommend').insertAfter('.columnWrapper');
		} else {
			$('#recommend').insertBefore('.subColumn');
		}
	}
	// カレント表示設定
	function setCurrentMenu() {
		var globalNav = $('.globalNav_item');
		globalNav.removeClass('current');
		if(getViewMode() === 'pc') {
			for(var i = 0; i < globalNav.length; i++) {
				if(location.pathname.indexOf($(globalNav[i]).children('a').attr('href')) > -1) {
					$(globalNav[i]).addClass('current');
				}
			}
		}
	}
	// サブコラムに合わせてメインコラムの高さを調整
	function setWrapperHeight() {
		if($('.subColumn').length > 0 && $('.subColumn').outerHeight() > $('.columnWrapper').height()) {
			$('.columnWrapper').height($('.subColumn').outerHeight());
		}
	}
	// 同一オフセットのボックスの高さを調整
	function adjustHeight() {
		var adjustElemList = $('.js-adjustHeight, ul.anchor li, ul.navi a, dl.aboutOffice');
		adjustElemList.height('auto');

		for(var i = 0; i < adjustElemList.length; i++) {
			var currentOffset = $(adjustElemList[i]).offset().top;
			var sameTopValueElemList = [];
			sameTopValueElemList.push(adjustElemList[i]);
			var highest = $(adjustElemList[i]).height();
			for(var j = i + 1; j < adjustElemList.length; j++) {
				if($(adjustElemList[j]).offset().top === currentOffset) {
					sameTopValueElemList.push(adjustElemList[j]);
					highest = Math.max(highest, $(adjustElemList[j]).height());
				}
			}
			if(highest === 0) {
				for(j = 0; j < sameTopValueElemList.length; j++) {
					var taregetChildList = $(sameTopValueElemList[j]).children();
					for(var k = 0; k < taregetChildList.length; k++) {
						highest = Math.max(highest, $(taregetChildList[j]).height());
					}
				}
			}
			for(j = 0; j < sameTopValueElemList.length; j++) {
				$(sameTopValueElemList[j]).height(highest);
			}
			i += sameTopValueElemList.length - 1;
		}
	}
	// Andoroid 4.4以前の標準ブラウザにおけるflexbox対応
	function wrapBox() {
		var wrapBox = $('.js-wrapBox');
		for(var i = 0; i < wrapBox.length; i++) {
			var childBox = $(wrapBox[i]).children();
			var addWrapBoxLength = (childBox.length / 2) - 1;
			for(var j = 0; j < addWrapBoxLength; j++) {
				$(wrapBox[i]).addClass('js-wrapBox-copy').clone().insertAfter(wrapBox[i]);
			}
			for(j = 0; j < addWrapBoxLength + 1; j++) {
				for(var k = 0; k < childBox.length; k++) {
					if(k < j * 2 || k > j * 2 + 1) {
						$('.js-wrapBox-copy').eq(j).children().eq(k).addClass('delete');
					}
				}
			}
			$('.js-wrapBox-copy > .delete').remove();
			$('.js-wrapBox-copy').removeClass('js-wrapBox-copy');
		}
	}
	function anchorScroll(hash, offset) {
		var targetOffsetTop = $(hash).offset().top;
		$('body,html').animate({scrollTop:targetOffsetTop - offset}, 500, 'swing');
	}

/* メニュー表示制御（PC） ------------------------------------------- */

	var timerId = 0;
	var globalNavItem = $('.globalHeader_pc .globalNav_item');
	globalNavItem.on({
		'mouseenter' : function(e) {
			clearTimeout(timerId);
			var currentGlobalNavItem = $(this);
			var openedGlobalSubNavItems = $('.globalHeader_pc .globalSubNav_items:visible');
			var delayTime = (openedGlobalSubNavItems.length !== 0) ? 200 : 0;

			globalNavItem.not(this).removeClass('subMenuOpen active');
			if(currentGlobalNavItem.children('ul').length > 0) {
				currentGlobalNavItem.addClass('subMenuOpen');
			} else {
				currentGlobalNavItem.addClass('active');
			}

			timerId = setTimeout(function() {
				if(currentGlobalNavItem.children('ul').length === 0) {
						currentGlobalNavItem.siblings().children('ul').fadeOut('fast');
				} else if(!openedGlobalSubNavItems.parent().is(currentGlobalNavItem)) {
					currentGlobalNavItem.children('ul').fadeIn('fast', function() {
						openedGlobalSubNavItems.fadeOut('fast');
					});
				}
			}, delayTime);
		},
		'mouseleave' : function(e) {
			var currentElement = $(e.relatedTarget).closest('.globalNav_item');
			if(currentElement.length === 0) {
				globalNavItem.removeClass('subMenuOpen active');
				globalNavItem.children('ul').fadeOut('fast');
			}
		}
	});

/* メニュー表示制御（SP） ------------------------------------------- */

	$('.globalHeader_sp .globalNav_item > a').on('click', function() {
		var currentGlobalNavItem = $(this).parent();
		currentGlobalNavItem.toggleClass('active');
		if(currentGlobalNavItem.children('ul').length > 0) {
			currentGlobalNavItem.children('ul').slideToggle();
			return false;
		}
	});

/* アンカースムーズスクロール --------------------------------------- */

	$('a[href*=#]').on('click', function() {
		var targetURL= $(this).attr("href");
		if(targetURL.indexOf('#') === 0) {
			anchorScroll(targetURL, (getViewMode() === 'pc') ? 170 : 60);
		} else {
			anchorScroll('#' + (targetURL.split('#'))[1], (getViewMode() === 'pc') ? 63 : 60);
		}
		return false;
	});

/* SPメニュー開閉制御 ----------------------------------------------- */

	var bodyOffsetTop;
	$('.globalHeader_menuOpen').on('click', function() {
		bodyOffsetTop = ($('body').scrollTop() > $('html').scrollTop()) ? $('body').scrollTop() : $('html').scrollTop();
		$('body').css({'position' : 'fixed', 'width' : '100%', 'top' : -bodyOffsetTop});
		$('.globalHeader_bg').show();
		$('.globalHeader_slideArea, .globalHeader_menuClose').animate({'right' : '0%'}, 350);
	});
	$('.globalHeader_menuClose').on('click', function() {
		bodyOffsetTop = $('body').offset().top;
		if(isOldAndroidBrowser()) {
			$('body').removeAttr('style').scrollTop(-bodyOffsetTop);
		} else {
			$('html, body').removeAttr('style').scrollTop(-bodyOffsetTop);
		}
		$('.globalHeader_slideArea, .globalHeader_menuClose').animate({'right' : '-80%'}, 350);
		$('.globalHeader_bg').hide();
	});

/* 「もっと見る」ボタン --------------------------------------------- */

	var moreBtn = $('.moreBtn');
	moreBtn.on('click', function() {
		var showList = moreBtn.prev().children('.hide');
		var max =Math.min(15, showList.length);
		for(var i =0; i < max; i++) {
			showList.eq(i).fadeIn().removeClass('hide');
		}
		if(moreBtn.prev().children('.hide').length === 0) {
			moreBtn.css({'display' : 'none'});
		}
	});

/* 「地図を表示」ボタン --------------------------------------------- */

	$(function(){
		$('.acTrigger').click(function(){
			if($(this).is('.open')){
				$(this).removeClass('open');
				$(this).next().slideUp('slow');
			} else {
				$(this).addClass('open');
				$(this).next().slideDown('slow');
			}
		});
	});

	$(function(){
	//下部固定 ここから
	$(window).scroll(function(){
		var st = $(window).scrollTop();
	if(st > 30){
	$('#fixfooter').fadeIn();
	}else{
	$('#fixfooter').fadeOut();
	}
	});
	//下部固定 ここまで
	});

/* ロード時処理 ----------------------------------------------------- */

	$(window).on('load', function () {
		if(location.hash.length > 0) {
			var targetOffsetTop = $(location.hash).offset().top;
			history.replaceState(null, null, location.pathname);
			var offset = (getViewMode() === 'pc') ? 63 : 60;
			$('body,html').animate({scrollTop:targetOffsetTop - offset}, 500, 'swing');
		}

		if(isOldAndroidBrowser()) {
			$('body').addClass('oldAndroidBrowser');
			wrapBox();
		}
		$('.blank > a, a.blank, .pdfLink a:not(.noIcon), .businessReport a, .pageLinkTxtList a').attr('target', '_blank');

		var fitImg = $('.mediaBox .imgBox img');
		for(var i = 0; i < fitImg.length; i++) {
			var image = new Image();
			image.src = $(fitImg).eq(i).attr('src');
			if(image.width < 340) {
				$(fitImg).eq(i).width(image.width);
			}
		}
		if(getViewMode() === 'pc') {
			setWrapperHeight();
		}

		if($('.slideWrapper').length > 0) {
			$('.slideWrapper').cycle({
				fx:      'fade',
				speed:   800,
				timeout: 5000,
			});
		}
		if($('#recommend').length > 0) {
			setRecommendOrder();
		}
		adjustHeight();
		headerSet();
		setCurrentMenu();
		setSlideHeight();
		setSubMenuMargin();
		setToTopBtn();
		viewMode = getViewMode();
		windowWidth = getWindowWidth();
	});

/* スクロール時処理 ------------------------------------------------- */
	$(window).on('scroll', function() {
		headerSet();
		setToTopBtn();
	});

/* リサイズ時処理 --------------------------------------------------- */

	var timer = false;
	$(window).on('resize', function() {
		if (timer !== false) {
			clearTimeout(timer);
		}
		timer = setTimeout(function() {
			if(isOldAndroidBrowser()) {
				wrapBox();
			}
			if(getWindowWidth() !== windowWidth) {
				adjustHeight();
				setSlideHeight();
				if(getViewMode() !== viewMode) {
					if(getViewMode() === 'sp') {
						$('header').removeClass('fixed').removeAttr('style');
						$('.columnWrapper').height('auto');
						$('.globalSubNav_items').removeAttr('style');
					} else {
						$('html').removeAttr('style');
						headerSet();
						setCurrentMenu();
					}
				}
				if($('#recommend').length > 0) {
					setRecommendOrder();
				}
			setToTopBtn();
			}
			if(getViewMode() === 'pc') {
				setSubMenuMargin();
				setWrapperHeight();
			}
			viewMode = getViewMode();
			windowWidth = getWindowWidth();
		}, 200);
	});
});
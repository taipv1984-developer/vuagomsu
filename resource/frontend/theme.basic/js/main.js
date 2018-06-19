$(document).ready(function ($) {
	// awe_backtotop();
	// awe_owl();
	// awe_category();
	awe_menumobile();
	awe_tab();
});

// $(document).on('click','.overlay, .close-popup, .btn-continue, .fancybox-close', function() {
// 	hidePopup('.awe-popup');
// 	setTimeout(function(){
// 		$('.loading').removeClass('loaded-content');
// 	},500);
// 	return false;
// })
//
// /********************************************************
// # SHOW NOITICE
// ********************************************************/
// function awe_showNoitice(selector) {
// 	$(selector).animate({right: '0'}, 500);
// 	setTimeout(function() {
// 		$(selector).animate({right: '-300px'}, 500);
// 	}, 3500);
// }  window.awe_showNoitice=awe_showNoitice;
//
// /********************************************************
// # SHOW LOADING
// ********************************************************/
// function awe_showLoading(selector) {
// 	var loading = $('.loader').html();
// 	$(selector).addClass("loading").append(loading);
// }  window.awe_showLoading=awe_showLoading;
//
// /********************************************************
// # HIDE LOADING
// ********************************************************/
// function awe_hideLoading(selector) {
// 	$(selector).removeClass("loading");
// 	$(selector + ' .loading-icon').remove();
// }  window.awe_hideLoading=awe_hideLoading;
//
// /********************************************************
// # SHOW POPUP
// ********************************************************/
// function awe_showPopup(selector) {
// 	$(selector).addClass('active');
// }  window.awe_showPopup=awe_showPopup;
//
// /********************************************************
// # HIDE POPUP
// ********************************************************/
// function awe_hidePopup(selector) {
// 	$(selector).removeClass('active');
// }  window.awe_hidePopup=awe_hidePopup;
//
// /********************************************************
// # CONVERT VIETNAMESE
// ********************************************************/
// function awe_convertVietnamese(str) {
// 	str= str.toLowerCase();
// 	str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
// 	str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
// 	str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
// 	str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
// 	str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
// 	str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
// 	str= str.replace(/đ/g,"d");
// 	str= str.replace(/!|@|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\;|\'| |\"|\&|\#|\[|\]|~|$|_/g,"-");
// 	str= str.replace(/-+-/g,"-");
// 	str= str.replace(/^\-+|\-+$/g,"");
// 	return str;
// } window.awe_convertVietnamese=awe_convertVietnamese;
//
// /********************************************************
// # RESIDE IMAGE PRODUCT BOX
// ********************************************************/
//
// /********************************************************
// # SIDEBAR CATEOGRY
// ********************************************************/
// function awe_category(){
// 	$('.nav-category .fa-angle-down').click(function(e){
// 		$(this).parent().toggleClass('active');
// 	});
// } window.awe_category=awe_category;
//
/********************************************************
# MENU MOBILE
********************************************************/
function awe_menumobile(){
	if($( window ).width() <= 1024){
		$("#nav .nav-item .dropdown-menu-1").css({"display":"none", "transition":"none", "transform":"none"});
		$("#nav .nav-item-lv2 .dropdown-menu-2").css({"display":"none", "transition":"none", "transform":"none"});
		$("#nav .nav-item-lv2 .dropdown-menu-1 >.nav-link").css({"display":"none", "transition":"none", "transform":"none"});

		$("#nav .nav-item-lv2 a .fa").removeClass("fa-angle-double-right");
		$("#nav .nav-item-lv2 a .fa").addClass("fa-angle-double-down");
		$("#nav .search").removeClass("f-right");
		$("#nav .search").addClass("f-left");
		$('#mobileClickCate').click(function(e){
			e.preventDefault();
			$(this).parent().parent().find("#mobile-aside-content").slideToggle('slow');

		});
		$('.aside-filter .aside-title').click(function(e){
			e.preventDefault();
			$(this).parent().find(".aside-content").slideToggle('slow');

		});

	}

	$('.menu-bar').click(function(e){
		e.preventDefault();
		$('#nav').slideToggle("slow");
	});
	$('#nav .nav-item >a >.fa').click(function(e){
		e.preventDefault();
		$(this).parent().parent().find(".dropdown-menu-1").slideToggle('slow');

	});
	$('#nav .nav-item .nav-item-lv2 >a >.fa').click(function(e){
		e.preventDefault();
		$(this).parent().parent().find(".dropdown-menu-2").slideToggle('slow');

	});
} window.awe_menumobile=awe_menumobile;

// /********************************************************
// # ACCORDION
// ********************************************************/
// function awe_accordion(){
// 	$('.accordion .nav-link').click(function(e){
// 		e.preventDefault;
// 		$(this).parent().toggleClass('active');
// 	})
// } window.awe_accordion=awe_accordion;
//
// /********************************************************
// # OWL CAROUSEL
// ********************************************************/
// function awe_owl() {
// 	$('.owl-carousel-slider:not(.not-dqowl)').each( function(){
// 		var xs_item = $(this).attr('data-xs-items');
// 		var md_item = $(this).attr('data-md-items');
// 		var sm_item = $(this).attr('data-sm-items');
// 		var margin=$(this).attr('data-margin');
// 		var dot=$(this).attr('data-dot');
// 		if (typeof margin !== typeof undefined && margin !== false) {
// 		} else{
// 			margin = 30;
// 		}
// 		if (typeof xs_item !== typeof undefined && xs_item !== false) {
// 		} else{
// 			xs_item = 1;
// 		}
// 		if (typeof sm_item !== typeof undefined && sm_item !== false) {
//
// 		} else{
// 			sm_item = 4;
// 		}
// 		if (typeof md_item !== typeof undefined && md_item !== false) {
// 		} else{
// 			md_item = 5;
// 		}
// 		if (typeof dot !== typeof undefined && dot !== true) {
// 			dot= true;
// 		} else{
// 			dot = false;
// 		}
// 		$(this).owlCarousel({
// 			loop:true,
// 			margin:Number(margin),
// 			responsiveClass:true,
// 			dots:dot,
// 			autoplay: true,
//         	autoPlaySpeed: 3000,
//        		autoPlayTimeout: 3000,
// 			nav:true,
// 			responsive:{
// 				0:{
// 					items:Number(xs_item)
// 				},
// 				600:{
// 					items:Number(sm_item)
// 				},
// 				1000:{
// 					items:Number(md_item)
// 				}
// 			}
// 		})
// 	});
// 	$('.owl-carousel-relative:not(.not-dqowl)').each( function(){
// 		var xs_item = $(this).attr('data-xs-items');
// 		var md_item = $(this).attr('data-md-items');
// 		var sm_item = $(this).attr('data-sm-items');
// 		var margin=$(this).attr('data-margin');
// 		var dot=$(this).attr('data-dot');
// 		if (typeof margin !== typeof undefined && margin !== false) {
// 		} else{
// 			margin = 20;
// 		}
// 		if (typeof xs_item !== typeof undefined && xs_item !== false) {
// 		} else{
// 			xs_item = 1;
// 		}
// 		if (typeof sm_item !== typeof undefined && sm_item !== false) {
//
// 		} else{
// 			sm_item = 4;
// 		}
// 		if (typeof md_item !== typeof undefined && md_item !== false) {
// 		} else{
// 			md_item = 5;
// 		}
// 		if (typeof dot !== typeof undefined && dot !== true) {
// 			dot= true;
// 		} else{
// 			dot = false;
// 		}
// 		$(this).owlCarousel({
// 			loop:true,
// 			margin:Number(margin),
// 			responsiveClass:true,
// 			dots:dot,
// 			autoplay: true,
//         	autoPlaySpeed: 3000,
//        		autoPlayTimeout: 3000,
// 			nav:true,
// 			responsive:{
// 				0:{
// 					items:Number(xs_item)
// 				},
// 				600:{
// 					items:Number(sm_item)
// 				},
// 				1000:{
// 					items:Number(md_item)
// 				}
// 			}
// 		})
// 	});
// 	$('.owl-carousel-product:not(.not-dqowl)').each( function(){
// 		var xs_item = $(this).attr('data-xs-items');
// 		var md_item = $(this).attr('data-md-items');
// 		var sm_item = $(this).attr('data-sm-items');
// 		var margin=$(this).attr('data-margin');
// 		var dot=$(this).attr('data-dot');
// 		if (typeof margin !== typeof undefined && margin !== false) {
// 		} else{
// 			margin = 20;
// 		}
// 		if (typeof xs_item !== typeof undefined && xs_item !== false) {
// 		} else{
// 			xs_item = 1;
// 		}
// 		if (typeof sm_item !== typeof undefined && sm_item !== false) {
//
// 		} else{
// 			sm_item = 4;
// 		}
// 		if (typeof md_item !== typeof undefined && md_item !== false) {
// 		} else{
// 			md_item = 5;
// 		}
// 		if (typeof dot !== typeof undefined && dot !== true) {
// 			dot= true;
// 		} else{
// 			dot = false;
// 		}
// 		$(this).owlCarousel({
// 			loop:true,
// 			margin:Number(margin),
// 			responsiveClass:true,
// 			dots:dot,
// 			autoplay: true,
//         	autoPlaySpeed: 3000,
//        		autoPlayTimeout: 3000,
// 			nav:true,
// 			responsive:{
// 				0:{
// 					items:Number(xs_item)
// 				},
// 				600:{
// 					items:Number(sm_item)
// 				},
// 				1000:{
// 					items:Number(md_item)
// 				}
// 			}
// 		})
// 	});
// 	$('.owl-carousel-blog:not(.not-dqowl)').each( function(){
// 		var xs_item = $(this).attr('data-xs-items');
// 		var md_item = $(this).attr('data-md-items');
// 		var sm_item = $(this).attr('data-sm-items');
// 		var margin=$(this).attr('data-margin');
// 		var dot=$(this).attr('data-dot');
// 		if (typeof margin !== typeof undefined && margin !== false) {
// 		} else{
// 			margin = 15;
// 		}
// 		if (typeof xs_item !== typeof undefined && xs_item !== false) {
// 		} else{
// 			xs_item = 1;
// 		}
// 		if (typeof sm_item !== typeof undefined && sm_item !== false) {
//
// 		} else{
// 			sm_item = 2;
// 		}
// 		if (typeof md_item !== typeof undefined && md_item !== false) {
// 		} else{
// 			md_item = 3;
// 		}
// 		if (typeof dot !== typeof undefined && dot !== true) {
// 			dot= true;
// 		} else{
// 			dot = false;
// 		}
// 		$(this).owlCarousel({
// 			loop:true,
// 			margin:Number(margin),
// 			responsiveClass:true,
// 			dots:dot,
// 			autoplay: true,
//         	autoPlaySpeed: 3000,
//        		autoPlayTimeout: 3000,
// 			nav:true,
// 			responsive:{
// 				0:{
// 					items:Number(xs_item)
// 				},
// 				600:{
// 					items:Number(sm_item)
// 				},
// 				1000:{
// 					items:Number(md_item)
// 				}
// 			}
// 		})
// 	});
// 	$('.owl-carousel-imageProduct:not(.not-dqowl)').each( function(){
// 		var xs_item = $(this).attr('data-xs-items');
// 		var md_item = $(this).attr('data-md-items');
// 		var sm_item = $(this).attr('data-sm-items');
// 		var margin=$(this).attr('data-margin');
// 		var dot=$(this).attr('data-dot');
// 		if (typeof margin !== typeof undefined && margin !== false) {
// 		} else{
// 			margin = 15;
// 		}
// 		if (typeof xs_item !== typeof undefined && xs_item !== false) {
// 		} else{
// 			xs_item = 1;
// 		}
// 		if (typeof sm_item !== typeof undefined && sm_item !== false) {
//
// 		} else{
// 			sm_item = 1;
// 		}
// 		if (typeof md_item !== typeof undefined && md_item !== false) {
// 		} else{
// 			md_item = 3;
// 		}
// 		if (typeof dot !== typeof undefined && dot !== true) {
// 			dot= true;
// 		} else{
// 			dot = false;
// 		}
// 		$(this).owlCarousel({
// 			loop:false,
// 			margin:Number(margin),
// 			responsiveClass:true,
// 			dots:dot,
// 			autoplay: true,
//         	autoPlaySpeed: 3000,
//        		autoPlayTimeout: 3000,
// 			nav:true,
// 			responsive:{
// 				0:{
// 					items:Number(xs_item)
// 				},
// 				600:{
// 					items:Number(sm_item)
// 				},
// 				1000:{
// 					items:Number(md_item)
// 				}
// 			}
// 		})
// 	});
// 	$('.owl-carousel-brand:not(.not-dqowl)').each( function(){
// 		var xs_item = $(this).attr('data-xs-items');
// 		var md_item = $(this).attr('data-md-items');
// 		var sm_item = $(this).attr('data-sm-items');
// 		var margin=$(this).attr('data-margin');
// 		var dot=$(this).attr('data-dot');
// 		if (typeof xs_item !== typeof undefined && xs_item !== false) {
// 		} else{
// 			xs_item = 2;
// 		}
// 		if (typeof sm_item !== typeof undefined && sm_item !== false) {
//
// 		} else{
// 			sm_item = 4;
// 		}
// 		if (typeof md_item !== typeof undefined && md_item !== false) {
// 		} else{
// 			md_item = 5;
// 		}
// 		if (typeof dot !== typeof undefined && dot !== true) {
// 			dot= true;
// 		} else{
// 			dot = false;
// 		}
// 		$(this).owlCarousel({
// 			loop:true,
// 			margin:15,
// 			responsiveClass:true,
// 			dots:dot,
// 			autoplay: true,
//         	autoPlaySpeed: 3000,
//        		autoPlayTimeout: 3000,
// 			nav:true,
// 			responsive:{
// 				0:{
// 					items:Number(xs_item)
// 				},
// 				600:{
// 					items:Number(sm_item)
// 				},
// 				1000:{
// 					items:Number(md_item)
// 				}
// 			}
// 		})
// 	});
//
// } window.awe_owl=awe_owl;
//
// /********************************************************
// # BACKTOTOP
// ********************************************************/
// function awe_backtotop() {
// 	if ($('.back-to-top').length) {
// 		var scrollTrigger = 100, // px
// 			backToTop = function () {
// 				var scrollTop = $(window).scrollTop();
// 				if (scrollTop > scrollTrigger) {
// 					$('.back-to-top').addClass('show');
// 				} else {
// 					$('.back-to-top').removeClass('show');
// 				}
// 			};
// 		backToTop();
// 		$(window).on('scroll', function () {
// 			backToTop();
// 		});
// 		$('.back-to-top').on('click', function (e) {
// 			e.preventDefault();
// 			$('html,body').animate({
// 				scrollTop: 0
// 			}, 700);
// 		});
// 	}
// } window.awe_backtotop=awe_backtotop;
//
/********************************************************
# TAB
********************************************************/
function awe_tab() {
	$(".e-tabs").each( function(){
		$(this).find('.tabs-title li:first-child').addClass('current');
		$(this).find('.tab-content').first().addClass('current');

		$(this).find('.tabs-title li').click(function(){
			var tab_id = $(this).attr('data-tab');
			var url = $(this).attr('data-url');
			$(this).closest('.e-tabs').find('.tab-viewall').attr('href',url);
			$(this).closest('.e-tabs').find('.tabs-title li').removeClass('current');
			$(this).closest('.e-tabs').find('.tab-content').removeClass('current');
			$(this).addClass('current');
			$(this).closest('.e-tabs').find("#"+tab_id).addClass('current');
		});
	});
} window.awe_tab=awe_tab;

// /********************************************************
// # DROPDOWN
// ********************************************************/
// $('.dropdown-toggle').click(function() {
// 	$(this).parent().toggleClass('open');
// });
// $('.btn-close').click(function() {
// 	$(this).parents('.dropdown').toggleClass('open');
// });
// $('body').click(function(event) {
// 	if (!$(event.target).closest('.dropdown').length) {
// 		$('.dropdown').removeClass('open');
// 	};
// });
//
// function kiti_sitenav() {
// 	if($('body').width() > 768){
// 		var kt = $('.home-slider').outerHeight( true );
// 		$('.aside-item.collection-category').css('height',kt+'px')
// 	}else{
// 		$('.aside-item.collection-category').css('height','auto')
// 	}
// }
//
// $(document).on('click', '.js-edit-toggle', function(e) {
// 	$(this).parents('tr.cart_item').toggleClass( "cart__update--show" );
// 	if($(this).hasClass('cart__edit--active')){
// 		$(this).removeClass( "cart__edit--active" );
// 	}else{
// 		$(this).addClass( "cart__edit--active" );
// 	}
// });
// $( window ).load(function() {
// 	kiti_sitenav();
// });
// $( window ).resize(function() {
// 	kiti_sitenav();
// });
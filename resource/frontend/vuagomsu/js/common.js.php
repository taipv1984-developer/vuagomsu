<?php
/**
 *Function list
 * 	show_notice
 * 	show_notice_error
 * 	checkbox click
 * 	priceFormat
 * 	datepicker
 * 	search
 * 	fancybox (popup)
 *
 * SHOP PLUGIN
 */
?>

<!-- show_notice -->
<script type="text/javascript">
function show_notice(message){
		toastr.options ={
			closeButton: true,
			debug: false,
			positionClass: 'toast-top-right',
			onclick: null
		};
		toastr.options.showDuration = '1000';
		toastr.options.hideDuration = '1000';
		toastr.options.timeOut = '5000';
		toastr.options.extendedTimeOut = '1000';
		toastr.options.showEasing = 'swing';
		toastr.options.hideEasing = 'linear';
		toastr.options.showMethod = 'fadeIn';
		toastr.options.hideMethod = 'fadeOut';
		toastr['success'](message, 'Thành công');
}

function show_notice_error(message){
		toastr.options ={
			closeButton: true,
			debug: false,
			positionClass: 'toast-top-right',
			onclick: null
		};
		toastr.options.showDuration = '1000';
		toastr.options.hideDuration = '1000';
		toastr.options.timeOut = '5000';
		toastr.options.extendedTimeOut = '1000';
		toastr.options.showEasing = 'swing';
		toastr.options.hideEasing = 'linear';
		toastr.options.showMethod = 'fadeIn';
		toastr.options.hideMethod = 'fadeOut';
		toastr['error'](message, 'Lỗi');
}
</script>

<script type="text/javascript">
/**
 * checkbox click
 */
$(document).ready(function(){
	//$(document).on('click','input[type="checkbox"]', function(){
	$('input[type="checkbox"]').click(function() {
		if($(this).is(':checked')){
			$(this).attr('value', 1);
		}
		else{
			$(this).attr('value', 0);
		}
	});
});

/**
 * priceFormat
 */
$().ready(function (){
	$('input.price').autoNumeric('init', {mDec: '0'});
})

/**
 * datepicker
 */
//$(document).ready(function(){
//	$('.datepicker').datepicker({
//		format: '<?php //echo Registry::getSetting('date_picker_format')?>//',
//		autoclose: true,
//		calendarWeeks: true
//	})
//});

/********
 * search
 ********/
function getCurrentURL() {
	var http = 'http://';
    var hostname = window.location.hostname;
    var pathname = window.location.pathname;
    var search = window.location.search;
    var searchData = search.split("&");
    var currentURL = http + hostname + pathname + searchData[0];
    return currentURL;
}
function getUrlArray() {
	var url = window.location.href;
    var request = {};
    var pairs = url.substring(url.indexOf('?') + 1).split('&');
    for (var i = 0; i < pairs.length; i++) {
        if(!pairs[i])
            continue;
        var pair = pairs[i].split('=');
        request[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
     }
    console.log(request);
     return request;
}
function search(frmId, pageid, pageVal) {
	//current url
	var url = getCurrentURL();

	var filterArray = $("#" + frmId).serializeArray();

	for(var i in filterArray){
		var filter = filterArray[i];
		url += '&' + filter.name + '=' + filter.value;
	}

	window.location = url;
	return false;
}
$().ready(function (){
	$('#userSearch').click(function() {
		search("userSearchForm", "page", 0);
		return false;
	});
});
/*********
 * search end
 *********/

/**
*	fancybox (popup)
*/
$(document).ready(function() {
	$(".fancybox").fancybox({
        helpers: {
            overlay: {
                locked: false
            },
            title : { type : 'inside' },
        },
        beforeShow : function() {
            this.title = (this.title ? '' + this.title + '' : '') + "<br>Hình ảnh " + (this.index + 1) + ' / ' + this.group.length;
        }
    });
});

//login after will goto page licked
function login(){
    var url = "index.php?r=home/set/session";
    var sessionName = 'redirectUrl';
    var sessionValue = window.location.href;

    $.ajax({
        type : 'post',
        url : url,
        data:{'sessionName': sessionName, 'sessionValue': sessionValue},
        async : false,
        complete : function(){
        },
        success : function(data){
        window.location = '<?php echo URLHelper::getUrl('home/account')?>';
        }
    });
};

/*******************************
 * SHOP PLUGIN
 ******************************/
$(document).on('click', '.quantity_button_up', function(){
	var productId = $(this).parents('.product_cart_item').attr('data-productId');
	var attributeValueId = $(this).parents('.product_cart_item').attr('data-attributeValueId');
	var quantity = $(this).parents('.product_cart_item').find('.quantity').val();
	quantity++;

	$.ajax({
		type: "post",
		url : "<?php echo URLHelper::getUrl('home/cart/change_quantity')?>",
		data:{'productId': productId, 'attributeValueId': attributeValueId, 'quantity': quantity},
		async : false,
		complete : function(){
	   },
		success : function(data){
			//reload
			location.reload();
	   }
   });
});
$(document).on('click', '.quantity_button_down', function(){
    var productId = $(this).parents('.product_cart_item').attr('data-productId');
    var attributeValueId = $(this).parents('.product_cart_item').attr('data-attributeValueId');
    var quantity = $(this).parents('.product_cart_item').find('.quantity').val();
    quantity--;
    if (quantity < 1) quantity = 1;

    $.ajax({
        type: "post",
        url: "<?php echo URLHelper::getUrl('home/cart/change_quantity')?>",
        data: {'productId': productId, 'attributeValueId': attributeValueId, 'quantity': quantity},
        async: false,
        complete: function () {
        },
        success: function (data) {
            //reload
            location.reload();
        }
    });
});
$(document).on('blur', '.quantity', function(){
	var productId = $(this).parents('.product_cart_item').attr('data-productId');
	var attributeValueId = $(this).parents('.product_cart_item').attr('data-attributeValueId');
	var quantity = $(this).parents('.product_cart_item').find('.quantity').val();
	if(quantity < 1) quantity = 1;

	$.ajax({
		type: "post",
		url : "<?php echo URLHelper::getUrl('home/cart/change_quantity')?>",
		data:{'productId': productId, 'attributeValueId': attributeValueId, 'quantity': quantity},
		async : false,
		complete : function(){
	    },
		success : function(data){
			//reload
			location.reload();
	   }
   });
});

$(document).on('click', '.remove_product', function(){
	var productId = $(this).parents('.product_cart_item').attr('data-productId');
	var attributeValueId = $(this).parents('.product_cart_item').attr('data-attributeValueId');

	$.ajax({
		type: "post",
		url : "<?php echo URLHelper::getUrl('home/cart/remove_product')?>",
		data:{'productId': productId, 'attributeValueId': attributeValueId},
		async : false,
		complete : function(){
	    },
		success : function(data){
			//reload
			location.reload();
	   }
    });
    return false;
});

//skip
$(document).on('click', '.recalculate', function(event){
	//check_quantity
	var check_quantity = true;
	var data = [];
	$(this).parents('.product_cart').find('.product_cart_list .change_quantity').each(function(){
		var quantity = $(this).val();
		if(quantity < 1) check_quantity = false;

		//get more data
		var row = $(this).parents('tr').attr('id');
		var productId = $('#'+row).find('.remove_product').attr('data-productId');
		var attributeValueId = $('#'+row).find('.remove_product').attr('data-attributeValueId');

		//insert data
		data.push({'productId': productId, 'quantity': quantity, 'attributeValueId': attributeValueId});
	});

	if(!check_quantity){
		show_notice_error('Check product quantity must > 0');
		event.preventDefault();	//required
		return;
	}

	$.ajax({
		type : "post",
		url : "<?php echo URLHelper::getUrl('home/cart/recalculate')?>",
		data :{'data': data},
		async : false,
		complete : function(){
		},
		success : function(data){

			//meassage
			show_notice('<?php echo e('Recalculate is success')?>');

			//reload
			location.reload();
	   }
   })
});

//skip
$(document).on('click', '.clear_cart', function(){
	if(confirm('Are you sure to clear cart')){
		$.ajax({
			type : "post",
			url : "<?php echo URLHelper::getUrl('home/cart/clear_cart')?>",
			async : false,
			complete : function(){
		   },
			success : function(data){
				location.reload();
		   }
	   })
   }
});

/**
 * buy_now click
 */
$(document).on('click','.buy_now', function(){
	var productId =  $(this).attr('data-productId');
	var attributeValueId =  0;
	var quantity = 1;

	$.ajax({
		type : 'POST',
		url : '<?php echo URLHelper::getUrl('home/cart/add_product')?>',
		data:{'productId': productId, 'attributeValueId': attributeValueId, 'quantity': quantity},
		async : false,
		complete : function(){
		},
		success : function(data){
			//change popup content
			//$('.shopping_cart span').html(data);

			//message
			//show_notice('Bạn đã đặt hàng thành công');

            //goto cart page
            location.href = '<?=URLHelper::getUrl('home/cart')?>';
	   }
	});
});

/**
 * loading
 */
function loadingOpen(formId){
	$("#" + formId).append('<div id="loading" class="js loader"><div class="loader_indicator"></div><div class="loader_bg"></div></div>');
}
function loadingClose(){
	$("#loading").remove("#loading");
}
</script>

<script type="text/javascript">
// 	$(window).scroll(function(){
// 		var scroll = $(window).scrollTop();
//
// 		if (scroll >= 185) {
// 			$('.header_row').addClass('fixed-top');
// 			$('.header_menu_row').addClass('fixed-bottom');
// 		}
// 		else {
// 			$('.header_menu_row').removeClass('fixed-bottom');
//            $('.header_row').removeClass('fixed-top');
// 		}
// 	});
</script>

<!-- image-tooltip -->
<script type="text/javascript">
$(document).ready(function () {
  	$('.image-tooltip').imageTooltip();
});
</script>

<?php
    $isMobile = Session::getSession('isMobile');
    if($isMobile){
        include 'mobile.php';
    }
    else {
        include 'desktop.php';
    }
?>

<?php if(Session::isCustomerLogin()){?>
<!-- product_wishlist -->
<script type="text/javascript">
    $(document).on('click','.add_product_wishlist', function(){
    	var productId = $(this).attr('data-productId');
		$.ajax({
			type : "POST",
			url : '<?=URLHelper::getUrl('home/product/wishlist/add')?>',
			data:{'productId': productId},
			async : false,
			complete : function(){
		    },
			success : function(data){
				data = JSON.parse(data);
				//change dom
				$('.add_product_wishlist').parent('button')
					.removeClass('btn-default')
					.addClass('btn_add_product_wishlist_selected');
                $('.add_product_wishlist').parent('button').find('.add_product_wishlist_icon')
                    .removeClass('add_product_wishlist_icon')
                    .addClass('add_product_wishlist_icon_selected');
				$('.add_product_wishlist')
					.removeClass('add_product_wishlist')
					.addClass('remove_product_wishlist')
					.html('Sản phẩm đang quan tâm');
		    }
	   	});

		//add to cart auto
        var attributeValueId =  0;
        var quantity = 1;
        $.ajax({
            type : 'POST',
            url : '<?=URLHelper::getUrl('home/cart/add_product')?>',
            data:{'productId': productId, 'attributeValueId': attributeValueId, 'quantity': quantity},
            async : false,
            complete : function(){
            },
            success : function(data){
                //change popup content
                $('.shopping_cart span').html(data);
            }
        });
	});

    $(document).on('click','.remove_product_wishlist', function(){
    	var productId = $(this).attr('data-productId');
		$.ajax({
			type : "POST",
			url : '<?=URLHelper::getUrl('home/product/wishlist/delete')?>',
			data:{'productId': productId},
			async : false,
			complete : function(){
		    },
			success : function(data){
				data = JSON.parse(data);
				//change dom
				$('.remove_product_wishlist').parent('button')
					.removeClass('btn_add_product_wishlist_selected')
					.addClass('btn-default');
                $('.remove_product_wishlist').parent('button').find('.add_product_wishlist_icon_selected')
                    .removeClass('add_product_wishlist_icon_selected')
                    .addClass('add_product_wishlist_icon');
				$('.remove_product_wishlist')
					.removeClass('remove_product_wishlist')
					.addClass('add_product_wishlist')
					.html('Thêm vào sản phẩm quan tâm');
		    }
	   	});
	});
</script>
<?php } else { ?>
    <!-- product_wishlist -->
    <script type="text/javascript">
        $(document).on('click','.add_product_wishlist', function() {
            show_notice_error('Vui lòng đăng nhập để lưu sản phẩm bạn quan tâm');
        });
    </script>
<?php } ?>
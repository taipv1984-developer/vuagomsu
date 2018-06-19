<?php 
	$productWishlist = $_REQUEST['productWishlist'];
    $isMobile = Session::getSession('isMobile');
?>

<div class="page-title">
    <h1 class="title-head">Sản phẩm quan tâm</h1>
</div>
<p><i>Xin chào, <?=Session::getCustomerName()?></i></p>

<div class="row">
	<div class="col-md-9 content-left">
		<article>
			<?php if(empty($productWishlist)) {?>
				<div class="no_data">
					<?php echo e('No data')?>
				</div>
				<a class="btn btn-success right" href="<?php echo URLHelper::getBaseUrl()?>" 
					title="<?php echo e('Continue shopping')?>">
					<?php echo e('Continue shopping')?> 
					<i class="fa fa-opencart"></i>
				</a>
			<?php } else { ?>
			<div class="product-wishlist-list row">
				<?php
                foreach ($productWishlist as $v){
                    $btnDelete = <<<btnDelete
<a href="#" class="delete_product_wishlist right" data-productId="{$v->productId}"
   title="Remove product wishlist">
    <i class="fa fa-remove"></i>
    Xóa
</a>
btnDelete;
                    ?>
                    <div class='product_group_item col-md-3 col-xs-6 left' id='product_wishlist_item_<?=$v->productId?>'>
                        <?php TemplateHelper::renderProductItem('product_box_item', $v, array('addInfo' => $btnDelete)) ?>
                    </div>
                <?php } ?>
				<div class="clear"></div>
			</div>

            <!-- paging -->
            <div class="row">
                <div class="col-xs-6 col-sm-4 text-xs-left">
                    <a class="btn btn-dark margin-top-10" href="<?php echo URLHelper::getBaseUrl()?>" title="<?php echo e('Continue shopping')?>">
                        <?php echo e('Continue shopping')?>
                        <i class="fa fa-opencart"></i>
                    </a>
                </div>
                    <div class="col-xs-6 col-md-8 text-sm-right right">
                    <?php TemplateHelper::getTemplate('common/paging.php')?>
                </div>
            </div>
            <div class="clear"></div>
			<?php }?>
		</article>
	</div>
	
	<div class="col-md-3 content-right">
        <?php TemplateHelper::getTemplate('account/common/account_navigation.php'); ?>
	</div>
</div>
<div class="clear"></div>

<?php if(!empty($productWishlist)) {?>
<script type="text/javascript">
	$(document).on('click','.delete_product_wishlist', function(){
		var productId = $(this).attr('data-productId');
		$.ajax({
			type : "POST",
			url : '<?php echo URLHelper::getUrl('home/product/wishlist/delete')?>',
			data:{'productId': productId},
			async : false,
			complete : function(){
		    },
			success : function(data){
				data = JSON.parse(data);
				if(data.status){
					show_notice(data.message);
					$('#product_wishlist_item_'+productId).fadeOut(500, function(){
						$(this).remove();
					});
				}
				else{
					show_notice_error(data.message);
				}
		    }
	   	});
	   	return false;
	});

	$(document).on('click','.delete_all_product_wishlist', function(){
		if(confirm('Are you sure to delete all product wishlist?')){
			$.ajax({
				type : "POST",
				url : '<?php echo URLHelper::getUrl('home/product/wishlist/delete_all')?>',
				data:{},
				async : false,
				complete : function(){
			    },
				success : function(data){
					data = JSON.parse(data);
					if(data.status){
						show_notice(data.message);
						 $('.product_wishlist').html('No data');
					}
					else{
						show_notice_error(data.message);
					}
			    }
		   	});
		}
	});
</script>
<?php }?>
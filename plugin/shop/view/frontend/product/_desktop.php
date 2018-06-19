<?php 
	//get data
	$productInfo = $_REQUEST['productInfo'];
	$productId = $productInfo->productId;
	$productExtension = $_REQUEST['productExtension'];
	$productImage = $_REQUEST['productImage'];
	
	$isWishlisted = ProductExt::isWishlisted($productId);
?>

<article class="article-content">
	<div class="header-wrap">
		<div class="product_image col-md-6 padding-left-0 ">
            <!-- primary_image -->
            <div class="primary_image_zoom image_center image_center_large">
                <a href="<?=URLHelper::getImagePath($productInfo->image)?>" class="fancybox" rel="gallery1" id="primary_image_link"
                   title="<?=$productInfo->name?>">
                    <img class="primary_image" src="<?=URLHelper::getImagePath($productInfo->image, 'large')?>"/>
                </a>
                <?php if($productInfo->code != ''){?>
                <span class="product_code_absolute"><?=$productInfo->code?></span>
                <?php }?>
            </div>

			<!-- product_thumbnails -->
			<div class="thumbs product_thumbnails">
				<ul>
					<li class="flex-1 image_center image_center_small ">
						<a href="<?=URLHelper::getImagePath($productInfo->image)?>" rel="gallery1" class="thumbnail_link fancybox active"
                           title="<?=$productInfo->name?>">
							<img class="_hvr-wobble-vertical" src="<?=URLHelper::getImagePath($productInfo->image, 'small')?>" />
						</a>
					</li>
			 		<?php foreach ($productImage as $v){?>
				 	<li class="flex-1 image_center image_center_small ">
					 	<a href="<?=URLHelper::getImagePath($v)?>" rel="gallery1" class="thumbnail_link fancybox"
                            title="<?=$productInfo->name?>">
					 		<img class="_hvr-wobble-vertical" src="<?=URLHelper::getImagePath($v, 'small')?>" />
						</a>
					</li>
					<?php }?>
				</ul>
			</div>
		</div>
		<header class='product_info col-md-6 padding-right-0'>
            <h3 class="bold">
                <?=$productInfo->name?>
            </h3>
            <div class="clear"></div>

            <?php if ($productInfo->code != ''){?>
			<p class="code-product">
				<span>Mã sản phẩm: </span> 
				<strong><?=$productInfo->code?></strong>
			</p>
            <div class="clear"></div>
            <?php }?>

			<div class="price-info btn-action center">
				<div class="price-group flex-3">
					<?php if($productInfo->price > 0){?>
						<?php if($productInfo->saleOf > 0){?>
						<del><?=CurrencyExt::format_price($productInfo->saleOf)?></del>
						<?php }?>
						<p class="text-red-d42323 fs-22px">
							<strong><?=CurrencyExt::format_price($productInfo->price)?></strong>
						</p>
					<?php } else{?>
						<p class="text-red-d42323 fs-22px">Liên hệ</p>
					<?php }?>
				</div>
				<!-- buy_now -->
				<button class="btn btn-danger right buy_now" data-productId="<?=$productInfo->productId?>">Mua hàng</button>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<small>Giá không bao gồm phí vận chuyển và VAT</small>
            <div class="clear margin-bottom-5"></div>
			
			<!-- product_attribute-->
			<?php if($productExtension['attribute'] != ''){?>
				<div class="product_attribute">
					<?=$productExtension['attribute']?>
				</div>
			<?php }?>
			
			<div class="product-extra">
				<?php if($isWishlisted){?>
				<button class="add-to-wish-list btn btn-warning" type="button">
					<i class="fa fa-heart-o add_product_wishlist_icon_selected"></i>
					<span class="remove_product_wishlist" data-productId="<?=$productInfo->productId?>">
						Sản phẩm đang quan tâm
					</span>
				</button>
                <div class="clear margin-bottom-5"></div>
				<?php } else {?>
				<button class="add-to-wish-list btn btn-default" type="button">
					<i class="fa fa-heart-o add_product_wishlist_icon"></i>
					<span class="add_product_wishlist" data-productId="<?=$productInfo->productId?>">
						Thêm vào sản phẩm quan tâm
					</span>
				</button>
                <div class="clear margin-bottom-5"></div>
				<?php }?>
				<div class="social_share">
					<div class="fb-share-button" data-href="<?=URLHelper::getProductDetailPage($productInfo->productId)?>" data-layout="button_count" data-size="large" data-mobile-iframe="true">
						<a class="fb-xfbml-parse-ignore" href="https://www.facebook.com/sharer/sharer.php?u=<?=URLHelper::getProductDetailPage($productInfo->productId)?>">
							Chia sẻ
						</a>
					</div>
				</div>
			</div>
		</header>
	</div>
	<div class="clear margin-bottom-5"></div>
	
	<div class="body">
		<div class="ship-info">
			<?=Registry::getSetting('ship_info')?>
		</div>
		<div class="prd-info-detail">
			<h3>Thông tin chi tiết</h3>
			<?=$productInfo->description?>
			
			<!-- youtube -->
			<?php 
				if($productExtension['youtube'] != ''){
					$videoPath = str_replace("watch?v=", 'embed/', $productExtension['youtube']);
			?>
			<div class="youtube-wrap ng-isolate-scope">
				<iframe src="<?=$videoPath?>" style="width:100%; height:450px; border: 0" allowfullscreen='allowfullscreen'></iframe>
			</div>
			<?php }?>
		</div>
		<!-- buy_now -->
		<button class="btn btn-danger buy_now buy_now_bottom" data-productId="<?=$productInfo->productId?>">Mua hàng</button>
	</div>
</article>
<div class="clear"></div>

<script type="text/javascript">
    $().ready(function(){
        $('.product_thumbnails ul li a').hover(function () {
            var img = $(this).attr('href');
            $('.primary_image').attr('src', img);
            $('#primary_image_link').attr('href', img);
        })
    })
</script>
<figure class="prd-group">
	<div class="thumbnail image_center image_center_default hvr-wobble-vertical">
        <a href="<?php echo URLHelper::getProductDetailPage($productInfo->productId)?>" title="<?php echo $productInfo->name?>">
		    <img src="<?php echo URLHelper::getImagePath($productInfo->image, 'large')?>" title="<?php echo $productInfo->name?>" alt="<?php echo $productInfo->name?>">
        </a>
	</div>
	<figcaption >
		<h4>
			<a href="<?php echo URLHelper::getProductDetailPage($productInfo->productId)?>" title="<?php echo $productInfo->name?>">
				<?php echo $productInfo->name?>
			</a>
		</h4>

        <!-- product_price -->
        <?php TemplateHelper::renderProductItem('product_price', $productInfo);?>
	</figcaption >
</figure>
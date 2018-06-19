<div class="product-box <?=$params['class']?>">
    <div class="product-thumbnail">
        <?php if($productInfo->discount >0 & $productInfo->price > 0){?>
            <div class="sale-flash">- <?=$productInfo->discount?>%</div>
        <?php }?>
        <a href="<?=URLHelper::getProductDetailPage($productInfo->productId)?>" title="<?=$productInfo->name?>">
            <img src="<?=URLHelper::getImagePath($productInfo->image, 'large')?>" alt="<?=$productInfo->name?>">
        </a>
    </div>
    <div class="product-info a-left">
        <h3 class="product-name">
            <a href="<?=URLHelper::getProductDetailPage($productInfo->productId)?>" title="<?=$productInfo->name?>">
                <?=(isset($productInfo->focusSearchKey)) ? $productInfo->focusSearchKey : $productInfo->name?>
            </a>
        </h3>
        <?php if(true){?>
        <div class="price-box-contact clearfix">
            Liên hệ
        </div>
        <?php } else {?>
        <div class="price-box clearfix hide">
            <div class="special-price">
                <span class="price product-price">2.400.000₫</span>
            </div>
            <div class="old-price">
                <span class="price product-price-old">
                2.800.000₫
                </span>
            </div>
        </div>
        <?php }?>
    </div>
    <?=$params['addInfo']?>
</div>
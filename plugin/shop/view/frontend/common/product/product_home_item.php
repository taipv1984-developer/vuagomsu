<?php
    $image_class = isset($params['image_class']) ? $params['image_class'] : 'image_center image_center_default';
?>
<div class="product_box <?=$params['class']?>">
    <div class="thumbnail <?=$image_class?>">
        <a href="<?=URLHelper::getProductDetailPage($productInfo->productId)?>" title="<?=$productInfo->name?>">
            <img src="<?=URLHelper::getImagePath($productInfo->image, 'large') ?>"
                data-image-tooltip="<?=URLHelper::getImagePath($productInfo->image, 'large') ?>" class="image-tooltip"
                title="<?=$productInfo->name?>" alt="<?=$productInfo->name?>"/>
        </a>

        <?php if($productInfo->code != ''){?>
            <span class="prd-code hide"><?=$productInfo->code?></span>
        <?php }?>

        <?php if($productInfo->discount >0){?>
            <span class="sale-off hide">
            - <span><?=$productInfo->discount?></span> %
        </span>
        <?php }?>
    </div>
    <div class="clear"></div>

    <h4 class="product_name">
        <a href="<?=URLHelper::getProductDetailPage($productInfo->productId)?>" title="<?=$productInfo->name?>">
            <?=$productInfo->name?>
        </a>
    </h4>

    <div class="product_contact">
        Liên hệ
    </div>
</div>
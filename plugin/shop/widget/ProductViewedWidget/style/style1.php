<?php
//get data
$productList = $setting['productList'];
?>

<div class="side_box <?=$setting['class']?>">
    <?php if($setting['show_title']){?>
        <h3 class="side_box_title">
            <span><?=$setting['title']?></span>
        </h3>
    <?php } ?>
    <div class="side_box_content" style="padding: 10px 0 0 0">
        <?php foreach ($productList as $v){?>
            <div class="col-md-3 col-xs-12">
                <?php TemplateHelper::renderProductItem('product_home_item', $v, array('image_class' => 'image_center image_center_180'))?>
            </div>
        <?php }?>
    </div>
</div>
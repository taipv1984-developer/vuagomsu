<?php
$layoutWidgetInfo = $setting['layoutWidgetInfo'];
$layoutWidgetId = $layoutWidgetInfo->layoutWidgetId;
$productList = $setting['productList'];
?>
<div class='widget_content <?=$setting['class'] ?>'>
    <?php if($setting['show_title']){?>
        <h3 class="widget_title widget_title1">
            <span><?=$setting['title']?></span>
        </h3>
    <?php } ?>

    <div class='widget_main product_relate_widget row'>
        <?php foreach ($productList as $v){?>
            <div class="col-md-3 col-xs-6">
                <?php TemplateHelper::renderProductItem('product_box_item', $v)?>
            </div>
        <?php }?>
    </div>
</div>
<?php
//get data
$layoutWidgetInfo = $setting['layoutWidgetInfo'];
$layoutWidgetId = $layoutWidgetInfo->layoutWidgetId;
$productTagList = $setting['productTagList'];
?>

<div class="aside-item aside-tags <?=$setting['class'] ?>" <?php echo LayoutExt::getStyleWidget($setting)?>>
    <?php if($setting['show_title']){?>
    <div class="aside-title margin-top-5">
        <h2 class="title-head">
            <span><?php echo $setting['title']?></span>
        </h2>
    </div>
    <?php } ?>
    <div class="aside-content list-tags">
        <?php foreach ($productTagList as $v){?>
        <span class="tag-item">
            <a href="<?=URLHelper::getProductTagPage($v->productTagId)?>">
               <?=$v->name?>
            </a>
        </span>
        <?php }?>
    </div>
</div>
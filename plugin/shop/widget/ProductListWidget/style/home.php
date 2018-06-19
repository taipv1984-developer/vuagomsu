<?php
	//get data
	$layoutWidgetInfo = $setting['layoutWidgetInfo'];
	$layoutWidgetId = $layoutWidgetInfo->layoutWidgetId;
    $productList = $setting['productList'];
    $categoryInfo = $setting['categoryInfo'];
?>

<div class='collectionModule collectionModule_home <?=$setting['class'] ?>' <?php echo LayoutExt::getStyleWidget($setting)?>>
    <h2>
        <a href="<?=URLHelper::getProductListPage($categoryInfo->categoryId)?>" title="<?=$categoryInfo->name?>">
            <?=$categoryInfo->name?>
        </a>
    </h2>
    <div class='row' id="product_best_seller_widget_<?php echo $layoutWidgetId?>">
        <?php foreach ($productList as $v){?>
            <div class="col-xs-6 col-sm-3 _col-lg-2">
                <?php TemplateHelper::renderProductItem('product_box_item', $v)?>
            </div>
        <?php }?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#product_best_seller_widget_<?php echo $layoutWidgetId?>').lightSlider({
            auto: false,
            item: 5,
            loop: true,
            slideMove: 1,
            pager: false,
            slideMargin: 0,
            responsive: [
                {
                    breakpoint: 770,
                    settings: {
                        item: 2,
                    }
                },
            ]
        });
    });
</script>
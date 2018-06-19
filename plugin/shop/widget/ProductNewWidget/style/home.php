<?php
//get data
$layoutWidgetInfo = $setting['layoutWidgetInfo'];
$layoutWidgetId = $layoutWidgetInfo->layoutWidgetId;
$productList = $setting['productList'];
?>

<div class='widget_content product_best_selling_widget_home <?=$setting['class'] ?>'>
    <?php if($setting['show_title']){?>
        <h3 class="title_home_red">
            <a href="<?php echo URLHelper::getBaseUrl()?>/san-pham&page=1&orderBy=best_selling"
               title="<?php echo $setting['title']; ?>">
                <?php echo $setting['title']; ?>
            </a>
        </h3><div class="clear"></div>
    <?php } ?>

    <div class="light_slider_content" <?php echo LayoutExt::getStyleWidget($setting)?>>
        <div id="light_slider_<?php echo $layoutWidgetId?>">
            <?php
            foreach ($productList as $v){
                echo '<div class="col-md-2 col-xs-6">';
                TemplateHelper::renderProductItem('product_home_item', $v, array('image_class' => 'image_center image_center_140'));
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <div class="clear"></div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#light_slider_<?php echo $layoutWidgetId?>').lightSlider({
            auto: false,
            item: 6,
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
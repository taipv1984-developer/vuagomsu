<?php 
	//get data
	$layoutWidgetInfo = $setting['layoutWidgetInfo'];
	$layoutWidgetId = $layoutWidgetInfo->layoutWidgetId;
?>

<div class='widget_content <?php echo $setting['class'] ?>'>
	<?php if($setting['show_title']){?>
		<h3 class="widget_title">
            <span><?=$setting['title']?></span>
		</h3>
	<?php } ?>
	
	<div class='widget_main product_viewed_widget' id="product_viewed_widget_<?php echo $layoutWidgetId?>">
		<?php 
			foreach ($setting['productViewedList'] as $v){
                echo "<div class='col-md-15'>";
				TemplateHelper::renderProductItem('product_viewed_item', $v);
                echo "</div>";
			}
		?>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#product_viewed_widget_<?php echo $layoutWidgetId?>').lightSlider({
            auto: <?php echo $setting['auto_play']?>,
            item: <?php echo $setting['items_desktop']?>,
            loop: true,
            slideMove: 1,
            pager: <?php echo $setting['pagination']?>,
            responsive: [
                {
                    breakpoint: 770,
                    settings: {
                        item: <?php echo $setting['items_mobile']?>,
                    }
                },
            ]
        });
    });
</script>
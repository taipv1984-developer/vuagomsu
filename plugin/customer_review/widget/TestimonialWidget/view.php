<?php 
	//get data
	$layoutWidgetInfo = $setting['layoutWidgetInfo'];
?>

<div class='widget_content <?php echo $setting['class'] ?>'>
	<?php if($setting['show_title']){?>
		<h3 class="widget_title">
            <span><?=$setting['title']?></span>
		</h3>
	<?php } ?>
	
	<div id="testimonial" class="home-block">
		<div class='widget_main' id="product_list_widget_<?php echo $layoutWidgetId?>">
			<?php foreach ($setting['customerReviewList'] as $v){?>
				<div class="col-sm-4">
	                <figure class="display-flex">
	                    <div class="thumbnail no-border-radius flex-1">
	                        <img src="<?php echo URLHelper::getImagePath($v->image, 'small')?>" height="60">
	                    </div>
	                    <div class="flex-5">
	                        <blockquote>
	                        	<a href="<?php echo URLHelper::getUrl('home/customer_review')?>" title="Xem thêm" style="color: #777;">
	                            	<?php echo StringHelper::subString($v->content, 20)?>
	                            </a>
	                            <footer>
	                            	<cite title="Source Title"><?php echo $v->name?></cite>, <?php echo $v->career?>
	                            </footer>
	                        </blockquote>
	                    </div>
	                </figure>
	            </div>
			<?php }?>
		</div>
	</div>
	<div class="clear"></div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#product_list_widget_<?php echo $layoutWidgetId?>').lightSlider({
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
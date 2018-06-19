<?php 
	//get data
    $baseUrl = URLHelper::getBaseUrl();
    $templateName = Registry::getTemplate('templateName');
	$layoutWidgetInfo = $setting['layoutWidgetInfo'];
	$layoutWidgetId = $layoutWidgetInfo->layoutWidgetId;
?>

<!-- lightslider  -->
<script src="<?="$baseUrl/resource/frontend/$templateName"?>/js/lightslider/js/lightslider.js" type="text/javascript"></script>
<link href="<?="$baseUrl/resource/frontend/$templateName"?>/js/lightslider/css/lightslider.css" rel="stylesheet" type="text/css"/>

<div class="widget_content <?=$setting['class'] ?>">
	<?php if($setting['show_title']){?>
		<h3 class="widget_title margin-bottom-20">
            <span><?=$setting['title']?></span>
		</h3>
	<?php } ?>

	<div class="widget_main">
		<ul id="light_slider_image_<?=$layoutWidgetId?>" class="light_slider_image"  <?=$style?>>
			<?php foreach ($setting['imageList'] as $v){?>
			<li class="center" style="text-align: center">
				<!-- image -->
				<?php if($v->link != '') { $v->title?>
					<a href="<?=$v->link?>" title="<?=$v->title?>">
						<img src="<?=URLHelper::getImagePath($v->image)?>" class="image_max image_slide"
							title="<?=$v->title?>" alt="<?=$v->title?>"/>
					</a>
				<?php } else {?>
					 <img src="<?=URLHelper::getImagePath($v->image)?>" class="image_max image_slide"
							title="<?=$v->title?>" alt="<?=$v->title?>" />
				<?php }?>
				
				<!-- title -->
				<?php if($v->title != ''){?>
				<h4>
					<?php if($v->link != '') { $v->title?>
					<a href="<?=$v->link?>" title="<?=$v->title?>">
						<span><?=$v->title?></span>
					</a>
					<?php } else {?>
						<span><?=$v->title?></span>
					<?php }?>
				</h4>
				<?php }?>
				
				<!-- description -->
				<?php if($v->description != ''){?>
					<h5><?=$v->description?></h5>
				<?php }?>
			</li>
			<?php }?>
		</ul>
	</div>
</div>
<div class="clear margin-bottom-10"></div>

<script type="text/javascript">
$(document).ready(function() {
    $('#light_slider_image_<?=$layoutWidgetId?>').lightSlider({
        pause: 5000,
        auto: <?=$setting['auto_play']?>,
        item: <?=$setting['items_desktop']?>,
        loop: true,
        slideMove: 1,
        pager: <?=$setting['pagination']?>,
        responsive: [
            {
                breakpoint: 770,
                settings: {
                    item: <?=$setting['items_mobile']?>,
                }
            },
        ]
    });
});
</script>
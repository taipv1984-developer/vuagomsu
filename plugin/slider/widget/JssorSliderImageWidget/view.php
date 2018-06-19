<?php 
	//get data
	$imageList = $setting['imageList'];
?>

<?php 
	//config width and height
	$width = $setting['width'];		//1920
	$height = $setting['height']; 	//650
	$style_main = "style='position: relative; margin: 0 auto; top: 0px; left: 0px; width: {$width}px; height: {$height}px; overflow: hidden; visibility: hidden;'";
	$style_slider = "style='cursor: default; position: relative; top: 0px; left: 0px; width: {$width}px; height: {$height}px; overflow: hidden;'";
?>

<script type="text/javascript">
$(document).ready(function() {
	//http://www.jssor.com/slideshow/x-stripe.html
	var jssor_slider_SlideshowTransitions = [
	  //{$Duration:800,$Delay:200,$Rows:12,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Opacity:2}
	  //{$Duration:1200,x:0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$JssorEasing$.$EaseInCubic,$Opacity:$JssorEasing$.$EaseLinear},$Opacity:2}
	  <?=$setting['params']?>
	];
	
	var jssor_slider_options = {
	  $AutoPlay: true,
	  $SlideshowOptions: {
		$Class: $JssorSlideshowRunner$,
		$Transitions: jssor_slider_SlideshowTransitions,
		$TransitionsOrder: 1
	  },
	  $ArrowNavigatorOptions: {
		$Class: $JssorArrowNavigator$
	  },
	  $BulletNavigatorOptions: {
		$Class: $JssorBulletNavigator$
	  }
	};
	
	var jssor_slider_slider = new $JssorSlider$("jssor_slider", jssor_slider_options);
	
	//responsive code begin
	//you can remove responsive code if you don't want the slider scales while window resizing
	function ScaleSlider() {
		var refSize = jssor_slider_slider.$Elmt.parentNode.clientWidth;
		if (refSize) {
			refSize = Math.min(refSize, <?=$width?>);
			jssor_slider_slider.$ScaleWidth(refSize);
		}
		else {
			window.setTimeout(ScaleSlider, 30);
		}
	}
	ScaleSlider();
	$(window).bind("load", ScaleSlider);
	$(window).bind("resize", ScaleSlider);
	$(window).bind("orientationchange", ScaleSlider);
	//responsive code end
});
</script>

<div class='widget_content slider_widget <?=$setting['class']; ?>'>
	<?php if($setting['show_title']){?>
		<h3>
            <span><?=$setting['title']?></span>
        </h3>
	<?php } ?>

	<div class='slider_widget_content'>
		<?=$setting['text']; ?>
		<div id="jssor_slider" <?=$style_main?>>
	        <div data-u="slides" <?=$style_slider?>>
	        	<?php foreach ($imageList as $v){?>
	            <div style="display: none;">
	            	<?php if($v->link == ''){?>
	                	<img data-u="image" src="<?=$v->image?>"
	                		title="<?=Registry::getSetting('site_name')?>" alt="<?=Registry::getSetting('site_name')?>"/>
	                <?php } else {?>
	                	<a href="<?=$v->link?>" title="<?=Registry::getSetting('site_name')?>">
	                		<img data-u="image" src="<?=$v->image?>"
	                	title="<?=Registry::getSetting('site_name')?>" alt="<?=Registry::getSetting('site_name')?>"/>
	                	</a>
	                <?php }?>
	            </div>
	            <?php }?>
	        </div>
	        
	        <?php if($setting['pagination']){?>
	        <!-- Bullet Navigator -->
	        <div data-u="navigator" class="navigator jssorb05" style="bottom:30px;" data-autocenter="1">
	            <div data-u="prototype" style="width:16px;height:16px;"></div>
	        </div>
	        <?php }?>
	        
	        <!-- Arrow Navigator -->
	        <span data-u="arrowleft" class="arrowleft jssora12l" style="top:0px;left:0px;width:30px;height:46px;" data-autocenter="2"></span>
	        <span data-u="arrowright" class="arrowright jssora12r" style="top:0px;right:0px;width:30px;height:46px;" data-autocenter="2"></span>
	    </div>
	</div>
</div>
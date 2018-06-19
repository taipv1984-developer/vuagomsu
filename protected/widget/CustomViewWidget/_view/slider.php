<script src="resource/frontend/<?=Registry::getTemplate('templateName'); ?>/js/jssor.slider/js/jssor.slider.mini.js" type="text/javascript"></script>
<link href="resource/frontend/<?=Registry::getTemplate('templateName'); ?>/js/jssor.slider/css/style.css" rel="stylesheet">

<?php
	$sliderId = 1;
	$imageList = SliderExt::getImageList($sliderId);
	
	//config width and height
	$width = 1920;
	$height = 1080; //1080
	$style_main = "style='position: relative; margin: 0 auto; top: 0px; left: 0px; width: {$width}px; height: {$height}px; overflow: hidden; visibility: hidden;'";
	$style_slider = "style='cursor: default; position: relative; top: 0px; left: 0px; width: {$width}px; height: {$height}px; overflow: hidden;'";
?>

<script type="text/javascript">
jQuery(document).ready(function ($) {
	//default params
	var jssor_slider_SlideshowTransitions = [
	  {$Duration:1200,$Opacity:2}
	];
	//Horizontal Bounce Stripe (transition)	
	//http://www.jssor.com/slideshow/x-stripe.html
	var jssor_slider_SlideshowTransitions = [
	  //{$Duration:800,$Delay:200,$Rows:12,$Formation:$JssorSlideshowFormations$.$FormationStraight,$Opacity:2}
	  {$Duration:1200,x:0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$JssorEasing$.$EaseInCubic,$Opacity:$JssorEasing$.$EaseLinear},$Opacity:2}
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
    

<div class="widget_content slider">
	<div id="jssor_slider" <?=$style_main?>>
        <div data-u="slides" <?=$style_slider?>>
        	<?php foreach ($imageList as $v){?>
            <div data-p="112.50" style="display: none;">
                <img data-u="image" src="<?=$v->image?>" title="" alt=""/>
                <div class="description">
                	<h3>ĐẾN VỚI KBE FITNESS</h3>
                	<h4>
						Sự pha trộn độc đáo của thể dục và kickboxing.<br>
						Đăng ký học thử Miễn phí ngay hôm nay.<br>
						Đăng ký trực tuyến hoặc gọi 0961 793 793
					</h4>
					<div class="clear"></div>
					<div class="slider_description">
						<div class="slider_button slider_button1">Các ưu đãi</div>
						<div class="slider_button slider_button2 register_button register_slider">Đăng ký ngay</div>
					</div>
                </div>
            </div>
            <?php }?>
        </div>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="navigator jssorb05" style="bottom:190px;right:16px;" data-autocenter="1">
            <!-- bullet navigator item prototype -->
            <div data-u="prototype" style="width:16px;height:16px;"></div>
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="arrowleft jssora12l" style="top:0px;left:0px;width:30px;height:46px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="arrowright jssora12r" style="top:0px;right:0px;width:30px;height:46px;" data-autocenter="2"></span>
    </div>

	<div class="feature_row">
		<div class="container">
			<div class="widget_content feature">
				<ul>
					<li>
						<img src="upload/images/feature_1.png" title="" alt="">
						<h3>KICKBOXING</h3>
					</li>
					<li>
						<img src="upload/images/feature_2.png" title="" alt="">
						<h3>MUAY THÁI</h3>
					</li>
					<li>
						<img src="upload/images/feature_3.png" title="" alt="">
						<h3>VÕ GẬY ARNIS</h3>
					</li>
                    <li>
                        <img src="upload/images/feature_4.png" title="" alt="">
                        <h3>KICKFIT</h3>
                    </li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="clear"></div>
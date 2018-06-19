<div class='widget_content youtube_widget <?=$setting['class']?>'>
	<?php if($setting['show_title']){?>
		<h3 class='widget_title youtube_widget_title'>
            <span><?=$setting['title']?></span>
		</h3>
	<?php } ?>
	<div class='youtube_widget_content'>
		<?=$setting['video']?>
	</div>
</div>
<div class='widget_content facebook_like_box_widget <?=$setting['class']?>'>
	<?php if($setting['show_title']){?>
		<h3 class='text_widget_title facebook_like_box_widget_title'>
            <span><?=$setting['title']?></span>
		</h3>
	<?php } ?>
	
	<div class='facebook_like_box_widget_content'>
		<?=$setting['iframe']?>
	</div>
</div>
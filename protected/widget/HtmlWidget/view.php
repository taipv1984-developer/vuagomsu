<div class='widget_content html_widget <?=$setting['class']; ?>'>
	<?php if($setting['show_title']){?>
		<h3 class='widget_title html_widget_title'>
            <span><?=$setting['title']?></span>
		</h3>
	<?php } ?>
	
	<div class='html_widget_content'>
		<?=$setting['html']; ?>
	</div>
</div>


<div class='widget_content menu_widget <?=$setting['class']?>'>
	<?php if($setting['show_title']){?>
		<h3 class='widget_title menu_widget_title'>
            <span><?=$setting['title']?></span>
		</h3>
	<?php } ?>

	<div class='menu_widget_content'>
        <?php include __DIR__."/style/{$setting['style']}.php"?>
	</div>
</div>
<div class="clear"></div>
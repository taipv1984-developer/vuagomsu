<div class='widget_content image_widget <?=$setting['class']?>'>
	<?php if($setting['show_title']){?>
		<h3 class='widget_title image_widget_title'>
            <span><?=$setting['title']?></span>
		</h3>
	<?php } ?>

	<div class='image_widget_content'>
		<?php if($setting['url'] != ''):?>
			<a href='<?=$setting['url']?>' target='<?=$setting['target']?>'>
				<img src='<?=$setting['src']?>' title='<?=$setting['title']?>' alt='<?=$setting['title']?>' <?=$style?>>
			</a>
		<?php else: ?>
			<img src='<?=$setting['src']?>' title='<?=$setting['title']?>' alt='<?=$setting['title']?>' <?=$imgStyle?>>
		<?php endif?>
	</div>
</div>
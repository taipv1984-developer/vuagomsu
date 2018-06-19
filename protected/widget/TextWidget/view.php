<div class='widget_content text_widget <?=$setting['class']; ?>'>
	<?php if($setting['show_title']){?>
		<h3 class='widget_title text_widget_title'>
            <span><?=$setting['title']?></span>
		</h3>
	<?php } ?>
	
	<div class='text_widget_content'>
		<?=$setting['text']; ?>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        pluginInit();
    });
</script>
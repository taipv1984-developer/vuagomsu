<?php
    $videoPath = str_replace("watch?v=", 'embed/', $setting['video']);
?>

<div class='widget_content youtube_random_widget <?=$setting['class']?>'>
	<?php if($setting['show_title']){?>
		<h3 class='widget_title youtube_random_widget_title'>
            <span><?=$setting['title']?></span>
		</h3>
	<?php } ?>
	<div class='youtube_random_widget_content'>
        <iframe src='<?=$videoPath?>' style='width:100%; height: 500px; border: 0' $allowfullscreen></iframe>
	</div>
</div>
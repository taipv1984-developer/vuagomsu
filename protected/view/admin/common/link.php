<a id="<?=$params['id'] ?>"
	href="<?=$params['link'] ?>"
	class="<?=$params['class'] ?>">
	<?php if(isset($params['icon'])):?>
    	<i class="<?=$params['icon'] ?>"></i>
    <?php endif;?>
	<?=$params['text'] ?>
</a>
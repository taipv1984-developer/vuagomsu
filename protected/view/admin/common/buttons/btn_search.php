<?php if($params['type'] == 'link'){?>
	<a href="<?=$params['link']?>" class="btn yellow">
	    <?=$params['text']?> <i class="fa fa-search"></i>
	</a>
<?php }elseif($params['type'] == 'button'){?>
	<button id="<?=$params['id']?>" class="btn yellow">
	    <?=$params['text']?> <i class="fa fa-search"></i>
	</button>
<?php }?>
<?php if(Session::havePermission($params['link'])){?>
<a href="<?=$params['link']?>" class="btn btn-success <?=$params['class']?>">
	<?=$params['text']?>
	<i class="fa fa-plus"></i>
</a>
<?php }?>
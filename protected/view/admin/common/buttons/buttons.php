<?php if(Session::havePermission($params['link'])){?>
<a id="<?=$params['id'] ?>"  href="<?=$params['link'] ?>" class="btn blue">
	<?=$params['text'] ?>
    <i class="fa fa-edit"></i>
</a>
<?php }?>
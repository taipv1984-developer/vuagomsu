<?php if(isset($params['linkEdit']) & Session::havePermission($params['linkEdit'])){?>
	<a href="<?=$params['linkEdit']?>" class="btn btn-primary linkEdit" title="Edit">
	    <i class="fa fa-edit"></i>
	</a>
<?php } ?>
<?php if(isset($params['linkEditPopup']) & Session::havePermission($params['linkEditPopup'])){?>
	<a href="<?=$params['linkEditPopup']?>" class="btn btn-primary linkEditPopup popup_action" title="Edit">
	    <i class="fa fa-edit"></i>
	</a>
<?php } ?>
<?php if(isset($params['linkDelete']) & Session::havePermission($params['linkDelete'])){
	//get idDelete from $params['linkDelete']
	$linkDelete = $params['linkDelete'];
	$exp = explode('&', $linkDelete);
	$params = $exp[1];
	$exp = explode('=', $params);
	$itemId = $exp[1];
?>
	<a onclick="if(confirm('Are you sure to delete item #<?=$itemId?>')){window.open('<?=$linkDelete?>', '_parent')}" id="delLink" class="btn btn-icon-only default linkDelete" title="Delete">
	    <i class="fa fa-trash"></i>
	</a>
<?php } ?>
<?php if(isset($params['linkView']) & Session::havePermission($params['linkView'])){?>
	<a href="<?=$params['linkView']?>" class="btn btn-primary linkView" title="View">
	    <i class="fa fa-eye"></i>
	</a>
<?php } ?>
<?php if(isset($params['linkSave']) & Session::havePermission($params['linkSave'])){?>
	<div class="btn btn-primary linkSave" title="Save">
	    <i class="fa fa-floppy-o"></i>
	</div>
<?php } ?>
<?php if(isset($params['linkSend']) & Session::havePermission($params['linkSend'])){?>
	<a href="<?=$params['linkSend']?>" class="btn btn-danger linkSend" title=Send>
	     <i class="fa fa-send"></i>
	</a>
<?php } ?>
<?php if(isset($params['linkViewPopup']) & Session::havePermission($params['linkViewPopup'])){?>
	<a href="<?=$params['linkViewPopup']?>" class="btn btn-primary linkViewPopup popup50" title="View">
		<i class="fa fa-eye"></i>
	</a>
<?php } ?>
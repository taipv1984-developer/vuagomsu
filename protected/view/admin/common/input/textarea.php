<?php include '_params.php'?>
<?php 
	$rows = (isset($params['rows'])) ? $params['rows'] : 5;
?>
<textarea rows="<?=$rows?>"
	name="<?=$params['name']?>" 
	class="input <?="{$params['class']} {$params['name']}"?>"
    <?=$id?>
    placeholder="<?=$params['placeholder']?>"
    <?=$params['attr']?>
><?=$params['value']?></textarea>
		
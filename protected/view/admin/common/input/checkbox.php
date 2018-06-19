<?php include '_params.php'?>
<?php
	$readonly = ($params['readonly'])? "readonly='readonly'" : '';
	if (!is_array($params['value'])) {
		$checked = (isset($params['checked'])) ? $params['checked'] : false;
?>
		<input type="checkbox"
	    	name="<?=$params['name']?>" 
			value="<?=$params['value']?>"
	    	class="input <?="$class {$params['name']}"?>"
		    id="checkbox_<?=$params['name']?>"
		    <?=$required ?>
			<?=$readonly?>
			<?=$attr?>
			<?=($checked) ? "checked='true'" : ''?>
		>
		<label class="checkbox-inline" for="checkbox_<?=$params['name']?>">
			<?=$params['title']?>
		</label>
<?php } else {	//array
		foreach ($params['value'] as $k => $v) {
?>
		<input type="checkbox"
	    	name="<?=$params['name']."[".$k."]"?>" 
			value="<?=$k?>"
	    	class="<?="$class {$params['name']}"?>"
		    <?php if ($params['options'][$k] == $k){echo "checked='true'";}?>
		    <?=$required ?>
			<?=$readonly?>
			id="checkbox_<?=$k?>"
		>
		<label class="checkbox-inline" for="checkbox_<?=$k?>">
			<?=$v?>
		</label>
<?php }
	}
?>
<div class="clear"></div>
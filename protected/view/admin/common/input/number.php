<?php include '_params.php'?>
<?php
    $type = (isset($params['type']))? "type='{$params['type']}'" : "type='text'";
    $placeholder = (isset($params['placeholder']))? "placeholder='{$params['placeholder']}'" : '';
    if($placeholder == ''){
        $placeholder = (isset($params['text']))? "placeholder='{$params['text']}'" : '';
    }
    $readonly = ($params['readonly'])? "readonly='readonly'" : '';
	
	$min = (isset($params['min']))? "min={$params['min']}" : '';
	$max = (isset($params['max']))? "max={$params['max']}" : '';
	$step = (isset($params['step']))? "step={$params['step']}" : '';
?>
<input type="number" <?="$min $max $step"?>
    	name="<?=$params['name']?>" 
		value="<?=$params['value']?>"
    	class="input <?="$class {$params['name']}"?>"
    <?=$id?>
    <?=$required ?>
	<?=$placeholder?>
	<?=$readonly?>
	<?=$title?>
	<?=$attr?>
>
<?php 
	if(isset($params['addElement'])){
		echo $params['addElement'];
	}
?>
<?php include '_params.php'?>
<?php
    $type = (isset($params['type']))? "type='{$params['type']}'" : "type='text'";
    $placeholder = (isset($params['placeholder']))? "placeholder='{$params['placeholder']}'" : '';
    if($placeholder == ''){
        $placeholder = (isset($params['text']))? "placeholder='{$params['text']}'" : '';
    }
    $readonly = ($params['readonly'])? "readonly='readonly'" : '';
?>
<input type="email"
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
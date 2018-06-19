<?php include '_params.php'?>
<?php 
	$value = $params['value'];
	
	//rebuild options array
	if(isset($params['options_map'])){
		$options_map = $params['options_map'];
		$options = array();
		foreach($params['options'] as $v){
			$options[$v->$options_map[0]] = $v->$options_map[1];
		}
	}
	else{
		$options = $params['options'];
	}
?>
<select 
	name="<?=$params['name']?>"
	class="input <?="{$params['class']} {$params['name']}"?>"
	<?=$id?>
	<?=$required?>
	<?=$attr?>
>
	<?php if(isset($params['placeholder'])){?>
		<option value="" selected><?=$params['placeholder'];?></option>
	<?php }?>
	<?php foreach($options as $k => $v){ ?>
		<option value="<?=$k?>"
			<?php
				if(!CTTHelper::isEmptyString($value)){
					if($value == $k){echo 'selected';}
				}
			?>
			<?php 
				if($params['rule_orders']) 
					if($params['value'] == 3 || $params['value'] == 9) echo 'disabled="disabled"';
			?>
		>
            <?=$v?>
		</option>
	<?php } ?>
</select>
<?php 
	if(isset($params['addElement'])){
		echo $params['addElement'];
	}
?>
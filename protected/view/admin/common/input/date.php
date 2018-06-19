<?php include '_params.php'?>
<div <?=$id?> class="date datepicker <?=$class?>" style="width: 140px">
	<input type="text" class="input form-control datepicker_input" 
		name="<?=$params['name']?>"
		value="<?=$params['value']?>"
		placeholder="<?=e($params['placeholder'])?>" style='width: 90px; float: left;'
		>
	<span class="input-group-btn left datepicker_button">
		<button class="btn btn-sm default" type="button">
		<i class="fa fa-calendar"></i>
		</button>
	</span>
</div>
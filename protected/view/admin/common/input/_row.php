<?php
$cols = (isset($params['cols'])) ? $params['cols'] : '2-10';
$rows = (isset($params['rows'])) ? $params['rows'] : '1';
if($rows == 1 || $rows == '1'){
    $exp = explode('-', $cols);
    $col_label = 'col-md-'.$exp[0];
    $col_input = 'col-md-'.$exp[1];
}
else{
    $col_label = 'col-md-12 row-2';
    $col_input = 'col-md-12 row-2';
}

if($params['no_padding']){
    $col_label .= " no_padding";
    $col_input .= " no_padding";
}

$rowType = $params['rowType'];
if($rowType == 'hidden'){
    include "hidden.php";
}
else {
?>
<div class="row my_row <?=$params['row_class']?>">
	<?php if(isset($params['label'])){?>
    <label class='<?=$col_label;?> my_tooltip'>
    	<?=e($params['label']); ?>
    	<?php if(isset($params['help'])){?>
    		<i class="fa fa-question-circle" title="<?=$params['help']?>"></i>
    	<?php }?>
        <?php if($params['required']){?>
        	<span class="required">	* </span>
        <?php }?>
    </label>
    <?php }?>
    <div class='row_value <?=$col_input?>'>
	    <?php include "$rowType.php"?>
		<?php if($params['description']){?>
			<div class='description'><?=e($params['description'])?></div>
		<?php } ?>
		<div class='validate_message'></div>
	</div>
</div>
<?php }?>
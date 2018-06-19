<?php 
	$layoutInfo = $_REQUEST['layoutInfo'];
?>

<div class='option'>
<?php
	//default option (type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]] )
	//add option (class, id, stype, styleRow, required, placeholder, attr, [options, code])
	$settingForm = array(
		'name'	=> array('value' => $layoutInfo->name,),
		'system_header'	=> array('type' => 'select', 'value' => $layoutInfo->systemHeader, 
				'options' => ArrayHelper::get10()),
		'system_footer'	=> array('type' => 'select', 'value' => $layoutInfo->systemFooter, 
				'options' => ArrayHelper::get10()),
	);
	$settingValue = $albumInfo;
	$settingAll = array(
		'required' => true,
	);
	
	//render setting from
	TemplateHelper::renderForm($settingForm, $settingValue, $settingAll);
?>
</div>
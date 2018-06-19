<?php 
	$url = $params['url'];
	$country = $params['country'];
	$state = $params['state'];
	$city = $params['city'];
	$district = $params['district'];
?>
<?php
	TemplateHelper::getTemplate('common/input/select_row.php',array(
		'label'=> e('District'),
		'id' => $district['id'],
		'name' => $district['name'],
		'options'=> AddressHelper::getAllDistrict($country['value'], $state['value'], $city['value']),
		'value' => $district['value'],
		'rows' => 2,
		'class' => $district['class'],
		'attr' => $district['attr'],
	));
?>
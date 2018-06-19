<?php 
	//get data
	$checkoutInfo = $params['checkoutInfo'];
	
	//default option(type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]])
	//add option(class, id, stype, styleRow, required, placeholder, attrAdd, [options, code])
	$settingForm = array(
		'checkout_surcharge_tax_tax'			=> array('label' => 'Tax(%)', 'required' => true),
		'checkout_surcharge_tax_apply_for_shipping'		=> array('label' => 'Apply for shipping', 'type' => 'select', 
				'options' => ArrayHelper::get10()),
		'checkout_surcharge_tax_description'	=> array('label' => 'Description', 'type' => 'textarea', 'class' => 'ckeditor'),
	);
	
	$settingValue = CheckoutExt::getSetting($checkoutInfo->checkoutId);
	
	//render setting from
	TemplateHelper::renderForm($settingForm, $settingValue);
?>
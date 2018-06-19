<?php 
	//get data
	$checkoutInfo = $params['checkoutInfo'];
	$checkoutSetting = CheckoutExt::getSetting($checkoutInfo->checkoutId);

	//default option(type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]])
	//add option(class, id, stype, styleRow, required, placeholder, attrAdd, [options, code])
	$settingForm = array(
		'checkout_shipping_free_total'			=> array('label' => 'Total', 'required' => true, 'class' => 'price',
				'help' => 'Sub-Total amount needed before the free shipping module becomes available.'),
		'checkout_shipping_free_cost'			=> array('label' => 'Cost', 'required' => true, 'class' => 'price', 
				'help' => 'Cost added to every orders if the orders value less than total'),
		'checkout_shipping_free_description'	=> array('label' => 'Description', 'type' => 'textarea', 'class' => 'ckeditor'),
	);
	
	//render setting from
	TemplateHelper::renderForm($settingForm, $checkoutSetting);
?>
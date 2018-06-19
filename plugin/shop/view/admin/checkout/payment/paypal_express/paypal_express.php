<?php 
	//get data
	$checkoutInfo = $params['checkoutInfo'];

	//default option(type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]])
	//add option(class, id, stype, styleRow, required, placeholder, attrAdd, [options, code])
	$settingForm = array(
		'checkout_payment_paypal_express_mode'				=> array('label' => 'Mode', 'required' => true),
		'checkout_payment_paypal_express_api_username'		=> array('label' => 'Api username', 'required' => true),
		'checkout_payment_paypal_express_api_password'		=> array('label' => 'Api password', 'required' => true),
		'checkout_payment_paypal_express_api_signature'	=> array('label' => 'Api signature', 'required' => true),
		'checkout_payment_paypal_express_currency_code'	=> array('label' => 'Currency code', 'required' => true),
		
		'checkout_payment_paypal_express_description'	=> array('label' => 'Description', 'type' => 'textarea', 'class' => 'ckeditor'),
	);
	
	$settingValue = CheckoutExt::getSetting($checkoutInfo->checkoutId);
	
	//render setting from
	TemplateHelper::renderForm($settingForm, $settingValue);
?>
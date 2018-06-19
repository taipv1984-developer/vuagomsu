<?php 
	//get data
	$checkoutInfo = $params['checkoutInfo'];

	//default option(type[text], cols[3-9], rows[1], label[$key], name[$key], value[$setting[$k]])
	//add option(class, id, stype, styleRow, required, placeholder, attrAdd, [options, code])
	$settingForm = array(
		'checkout_payment_credit_card_email'		=> array('label' => 'Stripe - Email'),
		'checkout_payment_credit_card_secret_key'	=> array('label' => 'Stripe - Secret key', 'required' => true),
		'checkout_payment_credit_card_public_key'	=> array('label' => 'Stripe - Public key', 'required' => true),
		'checkout_payment_credit_card_description'	=> array('label' => 'Description', 'type' => 'textarea', 'class' => 'ckeditor'),
	);
	
	$settingValue = CheckoutExt::getSetting($checkoutInfo->checkoutId);
	
	//render setting from
	TemplateHelper::renderForm($settingForm, $settingValue);
?>
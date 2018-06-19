<?php
	//get data
	$checkoutInfo = $params['checkoutInfo'];
	$checkoutSetting = CheckoutExt::getSetting($checkoutInfo->checkoutId);
	$currencySymbol = CurrencyExt::getSymbol();
?>

<?php
	$settingForm = array(
		'checkout_shipping_surface_weight_up_to'			=> array('label' => 'Weight up to (kg)', 'required' => true, 'type' => 'number',
				'help' => 'If weight of orders less (Weight up to) then apply this price'),
		'checkout_shipping_surface_price_up_to'			=> array('label' => "Price up to $currencySymbol", 'required' => true, 'class' => 'price', 
				'help' => 'If weight of orders less (Weight up to) then apply this price'),
		'checkout_shipping_surface_rate_after'			=> array('label' => "Rate after $currencySymbol", 'required' => true, 'class' => 'price',
				'help' => 'Every 1kg thereafter up to (Weigh max)'),
		'checkout_shipping_surface_weight_max'			=> array('label' => 'Weight max (kg)', 'required' => true, 'type' => 'number',
				'help' => 'Every 1kg thereafter up to (Weigh max)'),
		'checkout_shipping_surface_description'	=> array('label' => 'Description', 'type' => 'textarea', 'class' => 'ckeditor'),
	);
	
	TemplateHelper::renderForm($settingForm, $checkoutSetting);
?>
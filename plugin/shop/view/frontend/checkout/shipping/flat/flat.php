<?php
	//set data
	$pluginCode 	= CheckoutExt::getPluginCode();
	$checkoutType 	= 'shipping';
	$checkoutCode 	= 'flat';
	$checkoutSettingKey = "checkout_{$checkoutType}_{$checkoutCode}_";
	$description = CheckoutExt::getValue($checkoutSettingKey."description", false);
	echo $description;

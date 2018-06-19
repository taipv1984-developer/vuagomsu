<?php
	//set data
	$pluginCode 	= CheckoutExt::getPluginCode();
	$checkoutType 	= 'payment';
	$checkoutCode 	= 'bank_transfer';
	$checkoutSettingKey = "checkout_{$checkoutType}_{$checkoutCode}_";
	$description = CheckoutExt::getValue($checkoutSettingKey."description", false);
	echo $description;
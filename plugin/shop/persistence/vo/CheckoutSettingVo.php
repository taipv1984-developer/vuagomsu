<?php
class CheckoutSettingVo extends BaseVo{
	public $table_map = array(
		'checkout_setting_id' => 'checkoutSettingId',
		'checkout_id' => 'checkoutId',
		'setting' => 'setting',
		'value' => 'value',
		'serialized' => 'serialized',
	);

	public $checkoutSettingId;
	public $checkoutId;
	public $setting;
	public $value;
	public $serialized;
}
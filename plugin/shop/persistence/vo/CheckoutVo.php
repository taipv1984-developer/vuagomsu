<?php
class CheckoutVo extends BaseVo{
	public $table_map = array(
		'checkout_id' => 'checkoutId',
		'checkout_type' => 'checkoutType',
		'checkout_code' => 'checkoutCode',
		'checkout_name' => 'checkoutName',
		'order' => 'order',
		'default' => 'default',
		'status' => 'status',
		'is_del' => 'isDel',
	);

	public $checkoutId;
	public $checkoutType;
	public $checkoutCode;
	public $checkoutName;
	public $order;
	public $default;
	public $status;
	public $isDel;
}
<?php
class OrderSurchargeVo extends BaseVo{
	public $table_map = array(
		'order_surcharge_id' => 'orderSurchargeId',
		'order_id' => 'orderId',
		'code' => 'code',
		'name' => 'name',
		'value' => 'value',
	);

	public $orderSurchargeId;
	public $orderId;
	public $code;
	public $name;
	public $value;
}
<?php
class OrderShippingVo extends BaseVo{
	public $table_map = array(
		'order_shipping_id' => 'orderShippingId',
		'order_id' => 'orderId',
		'code' => 'code',
		'name' => 'name',
		'data' => 'data',
		'value' => 'value',
		'status' => 'status',
	);

	public $orderShippingId;
	public $orderId;
	public $code;
	public $name;
	public $data;
	public $value;
	public $status;
}
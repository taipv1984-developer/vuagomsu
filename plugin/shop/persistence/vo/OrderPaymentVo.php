<?php
class OrderPaymentVo extends BaseVo{
	public $table_map = array(
		'order_payment_id' => 'orderPaymentId',
		'order_id' => 'orderId',
		'code' => 'code',
		'name' => 'name',
		'data' => 'data',
		'status' => 'status',
	);

	public $orderPaymentId;
	public $orderId;
	public $code;
	public $name;
	public $data;
	public $status;
}
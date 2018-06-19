<?php
class OrderDataVo extends BaseVo{
	public $table_map = array(
		'order_data_id' => 'orderDataId',
		'order_id' => 'orderId',
		'data' => 'data',
	);

	public $orderDataId;
	public $orderId;
	public $data;
}
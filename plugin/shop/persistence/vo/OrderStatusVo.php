<?php
class OrderStatusVo extends BaseVo{
	public $table_map = array(
		'order_status_id' => 'orderStatusId',
		'name' => 'name',
		'description' => 'description',
		'order' => 'order',
		'is_system' => 'isSystem',
	);

	public $orderStatusId;
	public $name;
	public $description;
	public $order;
	public $isSystem;
}
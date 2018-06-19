<?php
class OrderHistoryVo extends BaseVo{
	public $table_map = array(
		'order_history_id' => 'orderHistoryId',
		'order_id' => 'orderId',
		'content' => 'content',
		'comment' => 'comment',
		'crt_by' => 'crtBy',
		'crt_date' => 'crtDate',
	);

	public $orderHistoryId;
	public $orderId;
	public $content;
	public $comment;
	public $crtBy;
	public $crtDate;
}
<?php
class ProductSearchVo extends BaseVo{
	public $table_map = array(
		'product_search_id' => 'productSearchId',
		'key' => 'key',
		'count' => 'count',
		'status' => 'status',
		'order' => 'order',
		'crt_date' => 'crtDate',
		'mod_date' => 'modDate',
	);

	public $productSearchId;
	public $key;
	public $count;
	public $status;
	public $order;
	public $crtDate;
	public $modDate;
}
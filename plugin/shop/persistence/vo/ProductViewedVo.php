<?php
class ProductViewedVo extends BaseVo{
	public $table_map = array(
		'product_viewed_id' => 'productViewedId',
		'product_id' => 'productId',
		'customer_id' => 'customerId',
		'crt_date' => 'crtDate',
	);

	public $productViewedId;
	public $productId;
	public $customerId;
	public $crtDate;
}
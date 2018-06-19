<?php
class ProductBestSellerVo extends BaseVo{
	public $table_map = array(
		'product_best_seller_id' => 'productBestSellerId',
		'product_id' => 'productId',
		'order' => 'order',
		'status' => 'status',
	);

	public $productBestSellerId;
	public $productId;
	public $order;
	public $status;
}
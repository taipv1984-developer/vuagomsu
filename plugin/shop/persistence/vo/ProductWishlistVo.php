<?php
class ProductWishlistVo extends BaseVo{
	public $table_map = array(
		'product_wishlist_id' => 'productWishlistId',
		'product_id' => 'productId',
		'customer_id' => 'customerId',
		'crt_date' => 'crtDate',
	);

	public $productWishlistId;
	public $productId;
	public $customerId;
	public $crtDate;
}
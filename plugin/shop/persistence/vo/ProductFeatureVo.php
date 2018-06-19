<?php
class ProductFeatureVo extends BaseVo{
	public $table_map = array(
		'product_feature_id' => 'productFeatureId',
		'product_id' => 'productId',
		'order' => 'order',
		'status' => 'status',
	);

	public $productFeatureId;
	public $productId;
	public $order;
	public $status;
}
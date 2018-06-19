<?php
class ProductImageVo extends BaseVo{
	public $table_map = array(
		'product_image_id' => 'productImageId',
		'product_id' => 'productId',
		'image' => 'image',
	);

	public $productImageId;
	public $productId;
	public $image;
}
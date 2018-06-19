<?php
class ProductTagMapVo extends BaseVo{
	public $table_map = array(
		'product_tag_map_id' => 'productTagMapId',
		'product_tag_id' => 'productTagId',
		'product_id' => 'productId',
	);

	public $productTagMapId;
	public $productTagId;
	public $productId;
}
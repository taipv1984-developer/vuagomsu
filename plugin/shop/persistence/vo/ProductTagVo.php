<?php
class ProductTagVo extends BaseVo{
	public $table_map = array(
		'product_tag_id' => 'productTagId',
		'name' => 'name',
		'description' => 'description',
	);

	public $productTagId;
	public $name;
	public $description;
}
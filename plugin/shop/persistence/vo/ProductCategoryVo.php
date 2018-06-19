<?php
class ProductCategoryVo extends BaseVo{
	public $table_map = array(
		'product_id' => 'productId',
		'category_id' => 'categoryId',
		'is_primary' => 'isPrimary',
	);

	public $productId;
	public $categoryId;
	public $isPrimary;
}
<?php
class ProductExtensionVo extends BaseVo{
	public $table_map = array(
		'product_extension_id' => 'productExtensionId',
		'product_id' => 'productId',
		'key' => 'key',
		'value' => 'value',
	);

	public $productExtensionId;
	public $productId;
	public $key;
	public $value;
}
<?php
class AttributeMapVo extends BaseVo{
	public $table_map = array(
		'attribute_map_id' => 'attributeMapId',
		'product_id' => 'productId',
		'attribute_id' => 'attributeId',
		'attribute_value_id' => 'attributeValueId',
	);

	public $attributeMapId;
	public $productId;
	public $attributeId;
	public $attributeValueId;
}
<?php
class AttributeValueVo extends BaseVo{
	public $table_map = array(
		'attribute_value_id' => 'attributeValueId',
		'attribute_id' => 'attributeId',
		'value' => 'value',
		'description' => 'description',
		'image' => 'image',
		'image_list' => 'imageList',
	);

	public $attributeValueId;
	public $attributeId;
	public $value;
	public $description;
	public $image;
	public $imageList;
}
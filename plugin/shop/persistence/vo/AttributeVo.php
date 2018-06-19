<?php
class AttributeVo extends BaseVo{
	public $table_map = array(
		'attribute_id' => 'attributeId',
		'name' => 'name',
		'description' => 'description',
		'image' => 'image',
		'type' => 'type',
	);

	public $attributeId;
	public $name;
	public $description;
	public $image;
	public $type;
}
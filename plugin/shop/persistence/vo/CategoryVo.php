<?php
class CategoryVo extends BaseVo{
	public $table_map = array(
		'category_id' => 'categoryId',
		'name' => 'name',
		'description' => 'description',
		'parent_id' => 'parentId',
		'image' => 'image',
		'icon' => 'icon',
	);

	public $categoryId;
	public $name;
	public $description;
	public $parentId;
	public $image;
	public $icon;
}
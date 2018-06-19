<?php
class MenuItemVo extends BaseVo{
	public $table_map = array(
		'menu_item_id' => 'menuItemId',
		'menu_id' => 'menuId',
		'parent_id' => 'parentId',
		'title' => 'title',
		'link' => 'link',
		'type' => 'type',
		'table_id' => 'tableId',
		'params' => 'params',
		'class' => 'class',
		'icon' => 'icon',
		'level' => 'level',
		'order' => 'order',
	);

	public $menuItemId;
	public $menuId;
	public $parentId;
	public $title;
	public $link;
	public $type;
	public $tableId;
	public $params;
	public $class;
	public $icon;
	public $level;
	public $order;
}
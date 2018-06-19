<?php
class NavLinkVo extends BaseVo{
	public $table_map = array(
		'nav_link_id' => 'navLinkId',
		'parent_id' => 'parentId',
		'title' => 'title',
		'link' => 'link',
		'icon' => 'icon',
		'order' => 'order',
		'plugin_code' => 'pluginCode',
	);

	public $navLinkId;
	public $parentId;
	public $title;
	public $link;
	public $icon;
	public $order;
	public $pluginCode;
}
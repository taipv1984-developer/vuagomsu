<?php
class WidgetVo extends BaseVo{
	public $table_map = array(
		'widget_id' => 'widgetId',
		'widget_cat_id' => 'widgetCatId',
		'name' => 'name',
		'controller' => 'controller',
		'description' => 'description',
		'icon' => 'icon',
		'plugin_code' => 'pluginCode',
		'status' => 'status',
	);

	public $widgetId;
	public $widgetCatId;
	public $name;
	public $controller;
	public $description;
	public $icon;
	public $pluginCode;
	public $status;
}
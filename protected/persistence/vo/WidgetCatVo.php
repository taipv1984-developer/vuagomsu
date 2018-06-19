<?php
class WidgetCatVo extends BaseVo{
	public $table_map = array(
		'widget_cat_id' => 'widgetCatId',
		'name' => 'name',
		'description' => 'description',
	);

	public $widgetCatId;
	public $name;
	public $description;
}
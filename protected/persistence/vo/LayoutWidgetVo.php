<?php
class LayoutWidgetVo extends BaseVo{
	public $table_map = array(
		'layout_widget_id' => 'layoutWidgetId',
		'layout_id' => 'layoutId',
		'layout_row_id' => 'layoutRowId',
		'widget_id' => 'widgetId',
		'widget_controller' => 'widgetController',
		'type' => 'type',
		'setting' => 'setting',
		'order' => 'order',
		'status' => 'status',
	);

	public $layoutWidgetId;
	public $layoutId;
	public $layoutRowId;
	public $widgetId;
	public $widgetController;
	public $type;
	public $setting;
	public $order;
	public $status;
}
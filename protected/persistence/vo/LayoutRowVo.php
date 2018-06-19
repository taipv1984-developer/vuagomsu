<?php
class LayoutRowVo extends BaseVo{
	public $table_map = array(
		'layout_row_id' => 'layoutRowId',
		'layout_id' => 'layoutId',
		'group' => 'group',
		'cols' => 'cols',
		'order' => 'order',
		'layout_widget_list' => 'layoutWidgetList',
		'setting' => 'setting',
		'status' => 'status',
	);

	public $layoutRowId;
	public $layoutId;
	public $group;
	public $cols;
	public $order;
	public $layoutWidgetList;
	public $setting;
	public $status;
}
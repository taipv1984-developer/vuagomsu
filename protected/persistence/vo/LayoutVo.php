<?php
class LayoutVo extends BaseVo{
	public $table_map = array(
		'layout_id' => 'layoutId',
		'name' => 'name',
		'dispatch' => 'dispatch',
		'system_header' => 'systemHeader',
		'system_footer' => 'systemFooter',
		'layout_style' => 'layoutStyle',
		'layout_script' => 'layoutScript',
		'plugin_code' => 'pluginCode',
		'order' => 'order',
		'status' => 'status',
	);

	public $layoutId;
	public $name;
	public $dispatch;
	public $systemHeader;
	public $systemFooter;
	public $layoutStyle;
	public $layoutScript;
	public $pluginCode;
	public $order;
	public $status;
}
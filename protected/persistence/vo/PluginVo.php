<?php
class PluginVo extends BaseVo{
	public $table_map = array(
		'plugin_id' => 'pluginId',
		'plugin_code' => 'pluginCode',
		'info' => 'info',
		'priority' => 'priority',
		'file_list' => 'fileList',
		'status' => 'status',
	);

	public $pluginId;
	public $pluginCode;
	public $info;
	public $priority;
	public $fileList;
	public $status;
}
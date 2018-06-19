<?php
class SettingVo extends BaseVo{
	public $table_map = array(
		'setting_name' => 'settingName',
		'setting_value' => 'settingValue',
		'setting_type' => 'settingType',
		'order' => 'order',
		'setting_group_id' => 'settingGroupId',
		'value_type' => 'valueType',
		'function' => 'function',
		'status' => 'status',
		'required' => 'required',
	);

	public $settingName;
	public $settingValue;
	public $settingType;
	public $order;
	public $settingGroupId;
	public $valueType;
	public $function;
	public $status;
	public $required;
}
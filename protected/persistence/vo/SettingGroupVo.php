<?php
class SettingGroupVo extends BaseVo{
	public $table_map = array(
		'setting_group_id' => 'settingGroupId',
		'setting_type' => 'settingType',
		'name' => 'name',
		'order' => 'order',
		'status' => 'status',
	);

	public $settingGroupId;
	public $settingType;
	public $name;
	public $order;
	public $status;
}
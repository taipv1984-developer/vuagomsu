<?php
class RoleVo extends BaseVo{
	public $table_map = array(
		'role_id' => 'roleId',
		'role_name' => 'roleName',
		'role_type' => 'roleType',
	);

	public $roleId;
	public $roleName;
	public $roleType;
}
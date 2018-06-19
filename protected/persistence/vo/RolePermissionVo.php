<?php
class RolePermissionVo extends BaseVo{
	public $table_map = array(
		'role_permission_id' => 'rolePermissionId',
		'role_id' => 'roleId',
		'permission' => 'permission',
		'status' => 'status',
	);

	public $rolePermissionId;
	public $roleId;
	public $permission;
	public $status;
}
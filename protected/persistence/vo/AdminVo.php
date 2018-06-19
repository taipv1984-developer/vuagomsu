<?php
class AdminVo extends BaseVo{
	public $table_map = array(
		'admin_id' => 'adminId',
		'role_id' => 'roleId',
		'username' => 'username',
		'password' => 'password',
		'email' => 'email',
		'language_code' => 'languageCode',
		'crt_date' => 'crtDate',
		'crt_by' => 'crtBy',
		'mod_date' => 'modDate',
		'mod_by' => 'modBy',
		'status' => 'status',
		'login_false' => 'loginFalse',
		'active_code' => 'activeCode',
	);

	public $adminId;
	public $roleId;
	public $username;
	public $password;
	public $email;
	public $languageCode;
	public $crtDate;
	public $crtBy;
	public $modDate;
	public $modBy;
	public $status;
	public $loginFalse;
	public $activeCode;
}
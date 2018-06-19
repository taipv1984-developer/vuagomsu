<?php
class CustomerVo extends BaseVo{
	public $table_map = array(
		'customer_id' => 'customerId',
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
		'active_code' => 'activeCode',
		'reset_password_code' => 'resetPasswordCode',
		'oauth_provider' => 'oauthProvider',
		'oauth_id' => 'oauthId',
	);

	public $customerId;
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
	public $activeCode;
	public $resetPasswordCode;
	public $oauthProvider;
	public $oauthId;
}
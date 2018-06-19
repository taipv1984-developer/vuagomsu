<?php
class AdminDetailVo extends BaseVo{
	public $table_map = array(
		'admin_detail_id' => 'adminDetailId',
		'admin_id' => 'adminId',
		'name' => 'name',
		'phone' => 'phone',
		'address' => 'address',
		'image' => 'image',
		'gender' => 'gender',
		'birthday' => 'birthday',
	);

	public $adminDetailId;
	public $adminId;
	public $name;
	public $phone;
	public $address;
	public $image;
	public $gender;
	public $birthday;
}
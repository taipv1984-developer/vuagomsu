<?php
class CustomerDetailVo extends BaseVo{
	public $table_map = array(
		'customer_detail_id' => 'customerDetailId',
		'customer_id' => 'customerId',
		'first_name' => 'firstName',
		'last_name' => 'lastName',
		'phone' => 'phone',
		'image' => 'image',
		'gender' => 'gender',
		'birthday' => 'birthday',
		'receive_email' => 'receiveEmail',
	);

	public $customerDetailId;
	public $customerId;
	public $firstName;
	public $lastName;
	public $phone;
	public $image;
	public $gender;
	public $birthday;
	public $receiveEmail;
}
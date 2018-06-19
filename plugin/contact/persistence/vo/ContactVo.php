<?php
class ContactVo extends BaseVo{
	public $table_map = array(
		'contact_id' => 'contactId',
		'customer_id' => 'customerId',
		'name' => 'name',
		'email' => 'email',
		'phone' => 'phone',
		'address' => 'address',
		'subject' => 'subject',
		'message' => 'message',
		'status' => 'status',
		'crt_date' => 'crtDate',
		'crt_by' => 'crtBy',
		'mod_date' => 'modDate',
		'mod_by' => 'modBy',
	);

	public $contactId;
	public $customerId;
	public $name;
	public $email;
	public $phone;
	public $address;
	public $subject;
	public $message;
	public $status;
	public $crtDate;
	public $crtBy;
	public $modDate;
	public $modBy;
}
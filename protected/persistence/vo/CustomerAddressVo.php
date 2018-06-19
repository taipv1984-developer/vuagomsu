<?php
class CustomerAddressVo extends BaseVo{
	public $table_map = array(
		'customer_address_id' => 'customerAddressId',
		'customer_id' => 'customerId',
		'title' => 'title',
		'address' => 'address',
		'default_shipping' => 'defaultShipping',
		'default_billing' => 'defaultBilling',
		'country_id' => 'countryId',
		'state_id' => 'stateId',
		'city_id' => 'cityId',
		'district_id' => 'districtId',
		'post_code' => 'postCode',
	);

	public $customerAddressId;
	public $customerId;
	public $title;
	public $address;
	public $defaultShipping;
	public $defaultBilling;
	public $countryId;
	public $stateId;
	public $cityId;
	public $districtId;
	public $postCode;
}
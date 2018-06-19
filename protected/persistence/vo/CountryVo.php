<?php
class CountryVo extends BaseVo{
	public $table_map = array(
		'country_id' => 'countryId',
		'name' => 'name',
		'country_code' => 'countryCode',
		'order' => 'order',
	);

	public $countryId;
	public $name;
	public $countryCode;
	public $order;
}
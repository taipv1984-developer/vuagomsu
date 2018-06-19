<?php
class CityVo extends BaseVo{
	public $table_map = array(
		'city_id' => 'cityId',
		'name' => 'name',
		'order' => 'order',
		'country_id' => 'countryId',
		'state_id' => 'stateId',
	);

	public $cityId;
	public $name;
	public $order;
	public $countryId;
	public $stateId;
}